<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Controller {

	/**
	 * Index Page for Invoice controller
	 *
	 */
	public function index()
	{
		$templateData = array();

		// dates array
		$templateData['dates'] = array(
			0 => '--Select Date--',
			1 => 'Last Month to Date',
			2 => 'This Month',
			3 => 'This Year',
			4 => 'Last Year'
		);

		// Products array
		$templateData['products'] = array(
			0 => '--Choose Product--'
		);

		// Load Model
		$this->load->model('client_model');

		// Clients array
		$templateData['clients'] = $this->client_model->getClientsData();

		$this->load->view('invoice', $templateData);
	}

	/**
	 * Controller to get product by cient
	 * 
	 */
	public function getProducts()
	{
		$json = array();

		// Load Model
		$this->load->model('product_model');

		// Clients array
		$json['products'] = $this->product_model->getProductsData($this->input->post());
		
		$this->output->set_output(json_encode($json));
	}

	/**
	 * Controller for result of Invoice records
	 * 
	 */
	public function result()
	{
		$json = array();

		// Load Model
		$this->load->model('product_model');

		// Clients array
		$json['data'] = $this->product_model->getResultData($this->input->post());


		$this->output->set_output(json_encode($json));
	}
}

/* End of file invoice.php */
/* Location: ./application/controllers/invoice.php */