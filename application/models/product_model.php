<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * getClientsData()
     * Get All Clients data
     * @param : $postData
     *
     * return array
     */ 
    function getProductsData($postData = array())
    {
        $products = array(
            0 => '--Choose Product--'
        );

        if (!empty($postData['client'])) {
            //  Select fields
            $this->db->select('product_id, product_description');
            $this->db->where('client_id', $postData['client']);
            $query = $this->db->get('products');
            if ($query->num_rows() > 0) {
                foreach ($query->result() AS $product) {
                    $products[$product->product_id] = $product->product_description;
                }
            }
        }

        return $products;
    }

    /**
     * getResultData()
     * Get result data
     * @param : $postData
     *
     * return array
     */ 
    function getResultData($postData = array())
    {
        
        if (!empty($postData['client'])) {
            //  Select fields
            $this->db->select('i.invoice_num, p.product_description, il.qty, il.price');
            $this->db->select("DATE_FORMAT(i.invoice_date, '%d/%m/%Y') AS invoice_date",  FALSE );
            $this->db->where('p.client_id', $postData['client']);

            if (!empty($postData['product'])) {
                $this->db->where('p.product_id', $postData['product']);
            }
            
            if (!empty($postData['date'])) {
                
                $fromDate = '';
                $toDate = '';

                switch ($postData['date']) {
                    // Last Month to Date
                    case 1:
                        $fromDate = date('Y-m-d', strtotime(date('Y-m')." -1 month"));
                        $toDate = date('Y-m-d');
                        break;
                    
                    // This Month
                    case 2:
                        $fromDate = date('Y-m-1');
                        $toDate = date('Y-m-31');
                        break;
                        
                    // This Year
                    case 3:
                        $fromDate = date('Y-1-1');
                        $toDate = date('Y-12-31');
                        break;
                        
                    // Last Year
                    case 4:
                        $lastYear = date("Y",strtotime("-1 year"));
                        $fromDate = $lastYear .'-1-1';
                        $toDate = $lastYear . '-12-31';
                        break;
                    
                }

                if (!empty($fromDate) && !empty($toDate)) {
                    $this->db->where('i.invoice_date BETWEEN "' . $fromDate . '" and "'. $toDate . '"');
                }

            }

            
            $this->db->from('invoices as i');
            $this->db->join('invoicelineitems as il','il.invoice_num = i.invoice_num');
            $this->db->join('products as p','p.product_id = il.product_id');
            $this->db->order_by('i.invoice_date Desc');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return  $query->result_array();    
            }
            

        }

        return false;
    }

}