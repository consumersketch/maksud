<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class client_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * getClientsData()
     * Get All Clients data
     * return array
     */ 
    function getClientsData()
    {
        $clients = array(
            0 => '--Choose Client--'
        );

        //  Select fields
        $this->db->select('client_id, client_name');
        $query = $this->db->get('clients');
        if ($query->num_rows() > 0) {
            foreach ($query->result() AS $client) {
                $clients[$client->client_id] = $client->client_name;
            }
        }

        return $clients;
    }

}