<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class BrandModel extends CI_Model
{
	private $table_name = 'ac_brand';
	private $pkey = 'id_brand';
	public $id_brand, $name_brand, $id_product;
	
	function __construct()
	{
		parent::__construct();

	}

	function validate()
	{
		$this->form_validation->set_rules('name_brand', 'Name Brand', 'required');
	
	}

	
	 //when you select id will display data detail by group
    function select_by_brand($id_brand) {
    $fields = 'ac_product.id_product AS id_product, ac_product.name_product AS name_product, ac_product.price_product AS price_product, ac_product.picture_product AS picture_product';

    $this->db->select($fields);
    $this->db->from('ac_product');
    $this->db->join('ac_brand', 'ac_product.id_brand = ac_brand.id_brand','left');
    $this->db->where(array('ac_brand.id_brand'=>$id_brand));
    $query = $this->db->get();
    return $query ->result();
   
    }

    //tampil semua data
	function findAll() {
		return $this->db->get($this->table_name)->result();
	}


	function select_by_id($id_brand) {		
		$this->db->select('*');    
		$this->db->from($this->table_name);
		
		$this->db->where(array('id_brand'=>$id_brand));
		$query = $this->db->get();
		return $query ->row();
	}

	function insert($data) {
		extract($data);
		$data = array
		(    
		  'name_brand' => $name_brand,
		  'slug_brand' => slug($name_brand)
		);
		$this->db->insert($this->table_name,$data);
		 return true;
	}

	function update($data) {
		 extract($data);
		 $this->db->where('id_brand', $id_brand);
     	 $this->db->update($this->table_name, array('name_brand' => $name_brand, 'slug_brand' => slug($name_brand)   ));

		 return true;
	}

} // END class 