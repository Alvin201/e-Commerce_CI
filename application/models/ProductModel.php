<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class ProductModel extends CI_Model
{
	private $table_name = 'ac_product';
	private $pkey = 'id_product';
	public $id_product, $name_product, $price_product, $quantity_product, $picture_product, $description_product, $dibeli, $id_brand, $created_at;

	function __construct()
	{
		parent::__construct();

	}

	function validate()
	{
		$this->form_validation->set_rules('name_product', 'Product Name', 'required');
		$this->form_validation->set_rules('price_product', 'Product Price', 'required');
		$this->form_validation->set_rules('discount', 'Discount', 'required');
		$this->form_validation->set_rules('quantity_product', 'Quantity', 'required');
		$this->form_validation->set_rules('description_product', 'Description', 'required');
		$this->form_validation->set_rules('id_brand', 'Brand', 'required');
	}

	function updatevalidate()
	{
		$this->form_validation->set_rules('name_product', 'Product Name', 'required');
		$this->form_validation->set_rules('price_product', 'Product Price', 'required');
		$this->form_validation->set_rules('discount', 'Discount', 'required');
		$this->form_validation->set_rules('quantity_product', 'Quantity', 'required');
		$this->form_validation->set_rules('description_product', 'Description', 'required');
		$this->form_validation->set_rules('id_brand', 'Brand', 'required');
	}

    
    function findAll() {
	$fields = 'ac_product.id_product AS id_product, ac_product.name_product AS name_product, ac_product.price_product AS price_product, ac_product.quantity_product AS quantity_product, ac_product.description_product AS description_product, ac_product.picture_product AS picture_product, ac_product.dibeli AS dibeli, ac_brand.name_brand AS id_brand';
	$this->db->select($fields);    
    $this->db->from($this->table_name);
    $this->db->join('ac_brand', 'ac_product.id_brand = ac_brand.id_brand','left');
    $query = $this->db->get();
    return $query ->result();
	}
        

	function select_by_id($id_product) {	
		$this->db->select('*');    
		$this->db->from($this->table_name);
		
		$this->db->where(array('id_product'=>$id_product));
		$query = $this->db->get();
		return $query ->row();
	}

	function insert($data) {
		extract($data);
		date_default_timezone_set("Asia/Jakarta");
		$created_at = date('Y-m-d H:i:s');
		$data = array
		(    
		  'name_product' => $name_product,
		  'slug_product' => slug($name_product),
		  'price_product' => $price_product,
		  'discount' => $discount,
		  'after_price_discount' => $after_price_discount,
		  'quantity_product' => $quantity_product,
		  'picture_product' => $picture_product,
		  'description_product' => $description_product,
		  'dibeli' => '0',
		  'id_brand' => $id_brand,
		  'created_at' => $created_at
		);
		$this->db->insert($this->table_name,$data);
		 return true;
	}

	function update($data) {
		 extract($data);
		 $this->db->where('id_product', $id_product);
     	 $this->db->update($this->table_name, array('name_product' => $name_product, 'slug_product' => slug($name_product),'price_product' => $price_product, 'discount' => $discount,
		  'after_price_discount' => $after_price_discount,'quantity_product' => $quantity_product,'description_product' => $description_product,'id_brand' => $id_brand, 'created_at' => date('Y-m-d H:i:s') ));

		 return true;
	}

	function get_update($data,$where){
	extract($data);	
       $this->db->where($where);
       $this->db->update($this->table_name, $data);
       return TRUE;
    }

    //fungsi delete ke database
  	function get_delete($where){
       $this->db->where($where);
       $this->db->delete($this->table_name);
       return TRUE;
    
    }
 
//fungsi untuk menampilkan data per satuan dari tabel database
    function get_byimage($where) {
        $this->db->from($this->table_name);
        $this->db->where($where);
        $query = $this->db->get();
 
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }

   

} // END class 