<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function index()
	{	
		$data = array();

		$product = $this->db->select('*')
						->from('ac_product')
						->limit(1)
						->get()
						->result();
		$data['model'] = $product;
		
		$data['body'] = $this->load->view('product/index', $data, true);
		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');
	}
}

