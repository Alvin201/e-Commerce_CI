<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class ShippingModel extends CI_Model
{
	private $table_name = 'ac_shipping';
	private $pkey = 'id_kota';
	public $id_kota, $nama_kota, $ongkos_kirim;

	function __construct()
	{
		parent::__construct();

	}

	

	function validate()
	{
		$this->form_validation->set_rules('nama_kota', 'Nama Kota', 'required');
		$this->form_validation->set_rules('ongkos_kirim', 'Ongkos Kirim', 'required');
	}


	function findAll() {
		return $this->db->get($this->table_name)->result();
	}

	function select_by_id($id_kota) {		
		$this->db->select('*');    
		$this->db->from($this->table_name);
		
		$this->db->where(array('id_kota'=>$id_kota));
		$query = $this->db->get();
		return $query ->row();
	}
	
	function insert($data) {
		extract($data);
		$data = array
		( 
		  'nama_kota' => $nama_kota,   
		  'ongkos_kirim' => $ongkos_kirim
		);
		$this->db->insert($this->table_name,$data);
		 return true;
	}

	function update($data) {
		 extract($data);
		 $this->db->where('id_kota', $id_kota);
     	 $this->db->update($this->table_name, array('ongkos_kirim' => $ongkos_kirim));

		 return true;
	}

	function delete($id_kota) {
      $this->db->where('id_kota', $id_kota);
      $this->db->delete($this->table_name);
      return true;
 	}


} // END class 