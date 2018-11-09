<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class ProductbrandModel extends CI_Model
{
	private $table_name = 'ac_product';
	private $pkey = 'id_product';
	public $id_product, $id_brand;

	function __construct()
	{
		parent::__construct();

	}

    function findAll_limit() { 
	$fields = 'ac_product.id_product AS id_product, ac_product.name_product AS name_product,  ac_product.slug_product AS slug_product, ac_product.price_product AS price_product, ac_product.discount AS discount, ac_product.after_price_discount AS after_price_discount,ac_product.description_product AS description_product, ac_product.picture_product AS picture_product, ac_brand.name_brand AS id_brand';
	$this->db->select($fields);    
    $this->db->from($this->table_name);
    $this->db->join('ac_brand', 'ac_product.id_brand = ac_brand.id_brand','left');
    $this->db->order_by('created_at','desc');
    $this->db->limit(10);
    $query = $this->db->get();
    return $query ->result();
	}

	function findAll() { 
	$fields = 'ac_product.id_product AS id_product, ac_product.name_product AS name_product,  ac_product.slug_product AS slug_product, ac_product.price_product AS price_product, ac_product.discount AS discount, ac_product.after_price_discount AS after_price_discount, ac_product.description_product AS description_product, ac_product.picture_product AS picture_product, ac_brand.name_brand AS id_brand';
	$this->db->select($fields);    
    $this->db->from($this->table_name);
    $this->db->join('ac_brand', 'ac_product.id_brand = ac_brand.id_brand','left');
    $this->db->order_by('created_at','desc');
    $query = $this->db->get();
    return $query ->result();
	}
        
    //menampilkan single produk yang dipilih
	function select_by_nameproduct($name_product= NULL, $slug_product= NULL) {	
		$this->db->select('*');    
		$this->db->from($this->table_name);
		$this->db->join('ac_brand', 'ac_brand.id_brand = ac_product.id_brand','left');
		$this->db->where(array('name_product'=>$name_product));
		$this->db->or_where(array('slug_product'=>$name_product));
		$query = $this->db->get();
		return $query ->row();
	}

//menampilkan produk sesuai categori yang dipilih  
  function select_byproductbrands($id_brand= NULL,  $slug_brand= NULL)
    {

    $fields = 'ac_product.id_product AS id_product, ac_product.name_product AS name_product,  ac_product.slug_product AS slug_product, ac_product.price_product AS price_product, ac_product.discount AS discount, ac_product.after_price_discount AS after_price_discount, ac_product.description_product AS description_product, ac_product.picture_product AS picture_product, ac_brand.name_brand AS id_brand, ac_brand.slug_brand AS slug_brand';

    $this->db->select($fields);  
    $this->db->from('ac_product');
    $this->db->join('ac_brand', 'ac_brand.id_brand = ac_product.id_brand','left');
    $this->db->where(array('ac_product.id_brand'=>$id_brand));
    $this->db->or_where(array('ac_brand.slug_brand'=>$id_brand));
    $this->db->order_by('created_at','desc');
    $query = $this->db->get();
    
    return $query->result();
  
    }


	//menampilkan produk best sell
	  function best_sell_limit()
  	{
  	$this->db->select('*');    
    $this->db->from('ac_product');
    $this->db->where('ac_product.dibeli >= 10'); //minimal 10
    $this->db->order_by('created_at','desc');
    $this->db->limit(10);
    $query = $this->db->get();
    return $query ->result();
   	}

   	function sale()
  	{
  	$this->db->select('*');    
	  $this->db->from('ac_product');
	  $this->db->where('ac_product.discount != 0'); //minimal 10
	  $this->db->order_by('created_at','desc');
    $query = $this->db->get();
    return $query ->result();

   	}

   	function sale_limit()
  	{
  	$this->db->select('*');    
	  $this->db->from('ac_product');
	  $this->db->where('ac_product.discount != 0'); //minimal 10
	  $this->db->order_by('created_at','desc');
	  $this->db->limit(10);
    $query = $this->db->get();
    return $query ->result();

   	}

    //tampil semua data
	function findAllBrand() {
		return $this->db->get('ac_brand')->result();
	}

    //select product by id_brand
    function select_by_idbrand($id_brand) {		
	 $fields = 'ac_product.id_product AS id_product, ac_product.name_product AS name_product,  ac_product.slug_product AS slug_product, ac_product.price_product AS price_product, ac_product.discount AS discount, ac_product.after_price_discount AS after_price_discount, ac_product.description_product AS description_product, ac_product.picture_product AS picture_product, ac_brand.name_brand AS id_brand, ac_brand.slug_brand AS slug_brand';

    $this->db->select($fields);  
    $this->db->from('ac_product');
    $this->db->join('ac_brand', 'ac_brand.id_brand = ac_product.id_brand','left');
    $this->db->where(array('ac_product.id_brand'=>$id_brand));
    $this->db->or_where(array('ac_brand.slug_brand'=>$id_brand));
    $this->db->order_by('created_at','desc');
    $query = $this->db->get();
    
    return $query->row();
	}

    //search AJAX
	  public function get_autocomplete($search_data)
    {
    $this->db->select('name_product,slug_product,picture_product');
    $this->db->like('name_product', $search_data);

    return $this->db->get('ac_product', 10)->result();
    }
	  

} // END class 