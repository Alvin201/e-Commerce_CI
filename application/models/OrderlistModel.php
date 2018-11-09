<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class OrderlistModel extends CI_Model
{
	private $table_name = 'invoices';
	private $pkey = 'id';
	public $id, $data, $due_date,$date_confirm, $user_id, $status, $totalbayar, $alamat;

	function __construct()
	{
		parent::__construct();

	}


	public function findAllexpired()
	{
		$fields = 'invoices.id as id, invoices.data as data, invoices.due_date as due_date, invoices.date_confirm as date_confirm, invoices.status as status, invoices.totalbayar as totalbayar';

        $this->db->select($fields);    
        $this->db->from('invoices');
        $this->db->where(array('status'=>'expired'));
        $query = $this->db->get();
        return $query ->result();
	}

	public function findAllcancel()
	{
		$fields = 'invoices.id as id, invoices.data as data, invoices.due_date as due_date, invoices.date_confirm as date_confirm, invoices.status as status, invoices.totalbayar as totalbayar';

        $this->db->select($fields);    
        $this->db->from('invoices');
        $this->db->where(array('status'=>'canceled'));
        $query = $this->db->get();
        return $query ->result();
	}

	public function findAllsuccess()
	{
		$fields = 'invoices.id as id, invoices.data as data, invoices.due_date as due_date, invoices.date_confirm as date_confirm, invoices.status as status, invoices.totalbayar as totalbayar';

        $this->db->select($fields);    
        $this->db->from('invoices');
        $this->db->where(array('status'=>'paid'));
        $query = $this->db->get();
        return $query ->result();
	}

	public function findAllconfirm()
	{
		$fields = 'invoices.id as id, invoices.data as data, invoices.due_date as due_date, invoices.date_confirm as date_confirm, invoices.status as status, invoices.totalbayar as totalbayar';

        $this->db->select($fields);    
        $this->db->from('invoices');
        $this->db->where(array('status'=>'confirmed'));
        $this->db->or_where(array('status'=>'unpaid'));
        $query = $this->db->get();
        return $query ->result();
	}

	

    public function get_user_id_by_session()
	{ 
		$username = $this->session->userdata('username');
		$gry = $this->db->where('username',$username)
						->select('id_admin')
						->limit(1)
						->get('ac_admin');
				if($gry->num_rows() > 0 )
					{
							return $gry->row()->id_admin;
					}else{
						
							return 0;
						 }	
	}

	public function process()
	{ 
		date_default_timezone_set("Asia/Jakarta");
		$items = $this->cart->contents();

		//here for create new invoice
		$invoice = array(
						'id' => $this->input->post('id'),
						'data'		=>	date('Y-m-d H:i:s'),
						'due_date'	=>	date('Y-m-d H:i:s',mktime(date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
						'date_confirm'		=>	'0000-00-00 00:00:00',
						'user_id'	=> $this->get_user_id_by_session(),
						'status'	=>	'unpaid',
						'totalbayar' => $this->input->post('totalbayar'),
						'id_kota' => $this->session->userdata('id_kota'),
						'alamat' => $this->input->post('alamat')
						);
		$this->db->insert('invoices',$invoice);
		$invoice_id = $this->input->post('id');

		//here for put ordered items in orders table
		foreach ($items as $item)
		{
			$data = array(
						'invoice_id'		=> $invoice_id,
						'product_id'		=> $item['id'],
						'product_type'		=> $item['name'],
						'qty'				=> $item['qty'],
						'price'				=> $item['price']
						
						 );

			//update pengurangan stock di tb produk
			/*if($this->db->insert('orders',$data)){
			$sql="UPDATE ac_product set quantity_product = quantity_product - {$item['qty']} WHERE id_product = {$item['id']}";
			$this->db->query($sql);
			}*/
			$this->db->insert('orders',$data);	
		}
		return TRUE;
	}

	public function get_shopping_history($user)
		{// get all invoices identified by $user
			$get_it =  $this->db->select('i.*,SUM(o.qty) AS total','totalbayar')
								->from('invoices i, ac_admin u,orders o')
								->where('u.username',$user)
								->where('u.id_admin = i.user_id')
								->where('o.invoice_id = i.id')
								->group_by('o.invoice_id')
								->get();
								
			if($get_it->num_rows() > 0 )
			{
				return $get_it->result();
			}else{
					return FALSE; //if there are no matching records
				}
		}

	public function mark_invoice_paid_confirmed($invoice_id,$amount)
		{//check the invoice
			date_default_timezone_set("Asia/Jakarta");
			$ret = TRUE ;
			$is_invoice = $this->db->where('id',$invoice_id)->limit(1)->get('invoices');
			if($is_invoice->num_rows() == 0  )
			{
					$ret = $ret && FALSE;
			}else{//check the amount
					$total = $this->db->select('SUM(qty * price) AS total')
									  ->where('invoice_id',$invoice_id)
									  ->get('orders');
									  
					if($total->row()->total > $amount )
					{
							$ret = $ret && FALSE ;
					}else{
							$this->db->where('id',$invoice_id)->update('invoices',array('status'=>'confirmed', 'date_confirm'=>	date('Y-m-d H:i:s') ));
						}
						
				 }
			return $ret;
		}


		public function get_invoice_by_id($invoice_id)
	{
		
		$fields = 'ac_shipping.id_kota as id_kota, ac_shipping.nama_kota as nama_kota, ac_shipping.ongkos_kirim as ongkos_kirim, invoices.id as id, invoices.data as data,invoices.due_date as due_date,invoices.date_confirm as date_confirm,invoices.status as status,invoices.totalbayar as totalbayar, invoices.alamat as alamat, invoices.id_kota as id_kota';

        $get_invoice_by = $this->db->select($fields)->from('invoices')
							        ->join('ac_shipping', 'invoices.id_kota = ac_shipping.id_kota','left')
							        ->where('invoices.id',$invoice_id)->limit(1)
							        ->get();

		if($get_invoice_by->num_rows() > 0 ) {
					return $get_invoice_by->result();
			} else {
					 return FALSE;
					}
	}

		public function cek_invoice($invoice_id) //cek invoice
	{
	
        $get_invoice_by = $this->db->select('*')->from('invoices')
							        ->where('invoices.id',$invoice_id)->limit(1)
							        ->get();

		if($get_invoice_by->num_rows() > 0 ) {
					return $get_invoice_by->result();
			} else {
					 return FALSE;
					}
	}
	
	public function get_orders_by_invoice($invoice_id)
	{
		$fields = 'orders.invoice_id, orders.product_id, orders.product_type, orders.qty, orders.price, orders.options, invoices.id as id, invoices.data as data, invoices.due_date as due_date,invoices.date_confirm as date_confirm, invoices.status as status, invoices.totalbayar as totalbayar, invoices.id_kota as id_kota,  ac_shipping.id_kota as id_kota, ac_shipping.nama_kota as nama_kota, ac_shipping.ongkos_kirim as ongkos_kirim';

		 $get_orders_by = $this->db->select($fields)
		                            ->from('invoices')
							        ->join('ac_shipping', 'invoices.id_kota = ac_shipping.id_kota','left')
							        ->join('orders','orders.invoice_id = invoices.id','left')
							        ->where('invoices.id',$invoice_id)
							        ->get();

		if($get_orders_by->num_rows() > 0 ) {
					return $get_orders_by->result();
			} else {
					 return FALSE;
					}
	}


	//=======================================================================================
	public function get_orders_by_invoice_row($invoice_id)
	{
		$fields = 'orders.invoice_id, orders.product_id, orders.product_type, orders.qty, orders.price, orders.options, invoices.id as id, invoices.data as data, invoices.due_date as due_date,invoices.date_confirm as date_confirm, invoices.status as status, invoices.totalbayar as totalbayar, invoices.id_kota as id_kota, invoices.alamat as alamat, ac_shipping.id_kota as id_kota, ac_shipping.nama_kota as nama_kota, ac_shipping.ongkos_kirim as ongkos_kirim, ac_admin.username as user_id';

		 $get_orders_by = $this->db->select($fields)
		                            ->from('invoices')
		                            ->join('ac_admin', 'invoices.user_id = ac_admin.id_admin','left')
							        ->join('ac_shipping', 'invoices.id_kota = ac_shipping.id_kota','left')
							        ->join('orders','orders.invoice_id = invoices.id','left')
							        ->where('invoices.id',$invoice_id)
							        ->get();

		if($get_orders_by->num_rows() > 0 ) {
					return $get_orders_by->row();
			} else {
					 return FALSE;
					}
	}

	
	function updatestatus($data) {
		 extract($data);
		 $this->db->where('id', $id);
     	 $this->db->update('invoices', array('status' => $status));
		 return true;
	}

	function updatekurangstok() {
	$this->db->query("UPDATE ac_product,orders SET ac_product.quantity_product=ac_product.quantity_product-orders.qty WHERE ac_product.id_product=orders.product_id and orders.invoice_id='$_POST[invoice_id]'");
	}

    function updatedibelitambah() {
	$this->db->query("UPDATE ac_product,orders SET ac_product.dibeli=ac_product.dibeli+orders.qty WHERE ac_product.id_product=orders.product_id and orders.invoice_id='$_POST[invoice_id]'");
	}
    //=======================================================================================
    public function total_rows_success() {
		$data = $this->db->select ('status')
		                 ->from('invoices')
		                 ->where(array('status'=>'paid'))
		                 ->get(); 
		return $data->num_rows();
	}
    
    public function total_rows_pending() {
		$data = $this->db->select ('status')
		                 ->from('invoices')
		                 ->where(array('status'=>'canceled'))
		                 ->get(); 
		return $data->num_rows();
	}

    public function total_rows_expired() {
		$data = $this->db->select ('status')
		                 ->from('invoices')
		                 ->where(array('status'=>'expired'))
		                 ->get(); 
		return $data->num_rows();
	}

	function kodeunik_transaksi() {
    $kode = '11';
    $tahun = date("y");

    $query = $this->db->query("SELECT MAX(id) as max_id FROM invoices"); 
    $row = $query->row_array();
    $max_id = $row['max_id']; 
    $get_id =substr($max_id,7);
    $id = $get_id +1;
    $maxid_transaksi = $kode.$tahun.sprintf("%04s",$id);
    return $maxid_transaksi;
    }
  
	
} // END class 


