<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class AdminModel extends CI_Model
{
	private $table_name = 'ac_admin';
	private $pkey = 'id_admin';
	public $id_admin, $username, $password;

	function __construct()
	{
		parent::__construct();

	}

	function validate()
	{
		$this->form_validation->set_rules('username', 'Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
	}


	function findAll() {
		return $this->db->get($this->table_name)->result();
	}
    
    function select_by_id($id_admin) {		
		$this->db->select('*');    
		$this->db->from($this->table_name);
		
		$this->db->where(array('id_admin'=>$id_admin));
		$query = $this->db->get();
		return $query ->row();
	}

	function insert($data) {
		extract($data);
		$data = array
		(    
		  'username' => $username,
		  'password' => $password
		);
		$this->db->insert($this->table_name,$data);
		 return true;
	}

	function update($data) {
		 extract($data);
		 $this->db->where('id_admin', $id_admin);
     	 $this->db->update($this->table_name, array('username' => $username,'password' => $password));

		 return true;
	}
} // END class 