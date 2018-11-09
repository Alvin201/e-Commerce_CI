<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductbrandModel');
		$this->load->model('ProductModel');
		$this->load->model('BrandModel');
		$this->load->model('LoginModel');	
	    $this->load->model('OrderlistModel');
	    $this->load->model('ShippingModel');
	    $this->load->helper( array('captcha', 'date_helper','text') );

	    if($this->config->item('system_maintenance') == TRUE) {
         redirect('maintenance');
    	}	
    	
	}

     

	public function index()
	{
		$data = array();
		$data['title'] = 'Ecommerce - U Store';

		$product	= $this->ProductbrandModel->findAll_limit(); //displayAllProduct limit
		$this->data['product'] = $product;

		$brandmenu = $this->ProductbrandModel->findAllBrand();    //displayAllMenu
		$this->data['brandmenu'] = $brandmenu; 
		
		$productsale = $this->ProductbrandModel->sale_limit(); //sale limit
		$this->data['productsale'] = $productsale;

		$productbest = $this->ProductbrandModel->best_sell_limit(); //best selling
		$this->data['productbest'] = $productbest;  
        

		
	
		$data['body'] = $this->load->view('home/index', $this->data, true);

		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');
	}

	//============================================================
    function search_product()
    {
    $search_data = $this->input->post('search_data');

     $result = $this->ProductbrandModel->get_autocomplete($search_data);

     if (!empty($result))
     {
          foreach ($result as $row):
          	  echo "<img src='".base_url().'/upload/product/'.$row->picture_product."' style= 'width:25px; height:20px;'>";
              echo anchor('welcome/singleproduct/'.$row->slug_product,$row->name_product);
              echo "<br/>";
          endforeach;
     }
     else
     {
           echo "<li> <em> Items not found ... </em> </li>";
     }

    }

     function allproduct()
    {
    	$data = array();
        $data['title'] = 'Ecommerce - U Store';
        
        $product	= $this->ProductbrandModel->findAll(); //displayAllProduct
		$brandmenu = $this->ProductbrandModel->findAllBrand();    //displayAllMenu
		
		$this->data['brandmenu'] = $brandmenu; 
		$this->data['product'] = $product;
       
        
        
        $data['body'] = $this->load->view('home/all_product', $this->data, true);


		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');

    }

    function allproductsale()
	{
		$data = array();
		$data['title'] = 'Ecommerce - U Store';

		
		$brandmenu = $this->ProductbrandModel->findAllBrand();    //displayAllMenu
		$this->data['brandmenu'] = $brandmenu; 
		
		$productsale = $this->ProductbrandModel->sale(); //best selling
		$this->data['productsale'] = $productsale; 
        
		$data['body'] = $this->load->view('home/all_productsale', $this->data, true);

		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');
	}

	function categoryproducts($id_brand=null)
  	{ 		
   		$data = array();
		$data['title'] = 'Ecommerce - U Store';
   
      	$brandmenu = $this->ProductbrandModel->findAllBrand();    //displayAllMenu
		$this->data['brandmenu'] = $brandmenu;  //displayAllMenu
	
        
        $productbybrands = $this->ProductbrandModel->select_byproductbrands($id_brand); //displayByBrand
        $this->data['productbybrands'] = $productbybrands;
        
        $brand = $this->ProductbrandModel->select_by_idbrand($id_brand); //title categori
        $this->data['brand'] = $brand;

		$data['body'] = $this->load->view('category/index', $this->data, true);

		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');  
   
  	}
    
    function singleproduct($name_product=null, $slug_product=null)
	{	
	    $data = array();
		$data['title'] = 'Ecommerce - U Store';
   	
		$productid = $this->ProductbrandModel->select_by_nameproduct($name_product, $slug_product); //menampilkan produk yang dipilih
		$this->data['productid'] = $productid;

		$brandmenu = $this->ProductbrandModel->findAllBrand(); //panggil semua brand
		$this->data['brandmenu'] = $brandmenu;

		$productbest = $this->ProductbrandModel->best_sell_limit(); //best selling
		$this->data['productbest'] = $productbest; 

		$productsale = $this->ProductbrandModel->sale_limit(); //sale limit
		$this->data['productsale'] = $productsale; 
		
				
	
		$data['body'] = $this->load->view('selectproduct/index', $this->data, true);
		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');  
	}


 
 //==================================================================================================================================================//

//==================================================================================================================================================//
    
    function cart()
	{
			
		$data = array();
		$data['title'] = 'Cart- U Store';

		$brandmenu = $this->BrandModel->findAll();		
		$this->data['brandmenu'] = $brandmenu; 
		$data['body'] = $this->load->view('cart/index', $this->data, true);

		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');
	}

    
    function buy($id_product)
    {
    
        $product = $this->ProductModel->select_by_id($id_product);
        $this->data['product'] = $product;
         
        $data = array(
        'id'      => $product->id_product,
        'qty'     => 1,
        'picture' => $product->picture_product,
        'price'   => $product->after_price_discount,
        'name'    => $product->name_product,
        'title'	  => $product->description_product
        );
         $this->cart->insert($data);
         redirect(site_url('welcome'));
    }

   
    function delete($rowid)
	{
  		$this->cart->update(array('rowid' =>$rowid, 'qty' => 0));
  		redirect(site_url('welcome/cart'));
	}

	function updatecart()
	{
		$i =1;
      foreach ($this->cart->contents() as $items) {
      $data[] = array(
                                'rowid' =>$items['rowid'], 
                                'qty' => $_POST['qty'.$i]/*,
                                'options'=> $this->input->post('options')*/
                                );
      $i++;
      }
      $this->cart->update($data);
      redirect(site_url('welcome/cart'));
	}


	function empty_cart() 
	{
   	 	$this->cart->destroy();
   	 	redirect('welcome/cart');
  	} 

//==================================================================================================================================================//

//==================================================================================================================================================// 

  	function billing_view()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('welcome/userlogin'));
	    }elseif (empty($this->cart->total()) ){
	    	     redirect(site_url('welcome'));
	    }

		$data = array();
		$data['title'] = 'Cart- U Store';

		$config_captcha = array(
	    'img_path'  => './captcha/',
	    'img_url'  => base_url().'captcha/',
	    'img_width' => 190,
    	'img_height' => 100,
	    'border' => 0,
	    'font_size' => 20, 
	    'font_path' => FCPATH . 'captcha/Font/captcha4.ttf',
	    'expiration' => 7200,
	    'colors'        => array(
                'background' => array(25, 205, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
	   );

        $user	= $this->LoginModel->select_by_id(); //jika kota diubah sesuai session maka ini akan menampilkan data yang diubah

        $id_transaksi =  $this->OrderlistModel->kodeunik_transaksi();
		$this->data['id_transaksi'] = $id_transaksi; //kode transaksi otomatis 


		$brandmenu = $this->BrandModel->findAll();
		
		$this->data['brandmenu'] = $brandmenu; 
		$this->data['user'] = $user;

		 // create captcha image
		 $cap = create_captcha($config_captcha);
		  
		 // store image html code in a variable
		 $this->data['img'] = $cap['image'];
		  
		 // store the captcha word in a session
		 $this->session->set_userdata('mycaptcha', $cap['word']);    
         	
		$data['body'] = $this->load->view('viewshipping', $this->data, true);

		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');

		
			
	} 

  	function save_billing()
	{
		
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('welcome/userlogin'));
	    }

	     $security_code = $this->input->post('security_code');
   		 $mycaptcha = $this->session->userdata('mycaptcha');

   		
         //jika captcha diproses  
  		 if ($this->input->post() && ($security_code == $mycaptcha)) {
  		 	 $is_processed = $this->OrderlistModel->process();
          
            //jika cart diproses  
   		 	 if($is_processed)
		     {
				$this->cart->destroy();
				redirect('welcome/success');
			}else
				$this->session->set_flashdata('error','Failed To Processed Your Order ! , please try again');
				redirect('welcome/myorder');
			  	
   		}else {
    	// pesan akan muncul jika captcha salah
    	$this->session->set_flashdata('error','<p style="color:red;"><b>Captcha salah :( </b></p>');
    	redirect('welcome/billing_view');
   		}
 	 }
		
//==================================================================================================================================================//

//==================================================================================================================================================// 

	function success()
	{	
		$data = array();
		$data['title'] = 'Cart- U Store';



		$brandmenu = $this->BrandModel->findAll();
		
		$this->data['brandmenu'] = $brandmenu; 
	
         	
		$data['body'] = $this->load->view('order_success', $this->data, true);

		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');


	}

	function myorder()
	{
		$data = array();
		$data['title'] = 'Ecommerce - U Store';
		$user=$this->session->userdata('username');

		$brandmenu = $this->ProductbrandModel->findAllBrand();    //displayAllMenu
		$this->data['brandmenu'] = $brandmenu;  //displayAllMenu
		
        $history = $this->OrderlistModel->get_shopping_history($user);
		$this->data['history'] = $history;
	
		$data['body'] = $this->load->view('home/transaction', $this->data, true);

		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');
	}

	function payment_confirmation($invoice_id = 0 )
	{	
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('welcome/userlogin'));
	    }

		$data = array();
		$data['title'] = 'Ecommerce - U Store';
		$brandmenu = $this->ProductbrandModel->findAllBrand();    //displayAllMenu
		$this->data['brandmenu'] = $brandmenu;  //displayAllMenu


	    $orders = $this->OrderlistModel->get_orders_by_invoice($invoice_id);
        $invoice = $this->OrderlistModel->get_invoice_by_id($invoice_id);
		$this->data['orders']	= $orders;
		$this->data['invoice'] = $invoice;
			
	   	$this->form_validation->set_rules('invoice_id_input','Invoice id','required|integer');
		$this->form_validation->set_rules('amount_input','Amount Transfered','required|integer');
		if($this->form_validation->run()	==	FALSE)
		{
			if($this->input->post('invoice_id_input'))
			{
				$this->data['invoice_id'] =set_value('invoice_id_input');
			}else{	
					$this->data['invoice_id'] = $invoice_id;
				}
 
				
			$data['body'] = $this->load->view('home/payment', $this->data, true);
			$this->load->view('templates/frontend/header');
			$this->load->view('templates/frontend/body', $data);
			$this->load->view('templates/frontend/footer');

		}else{
				$is_valid = $this->OrderlistModel->mark_invoice_paid_confirmed(set_value('invoice_id_input'),set_value('amount_input'));

				$is_check = $this->OrderlistModel->cek_invoice($invoice_id);


				if ($is_valid) //jika inputan smua benar
				{       
					   $this->session->set_flashdata('message','Thank you ..... we will check on your payment confirmation');
						redirect('welcome/myorder');
				}elseif ($is_valid >= $is_check){  //jika kurang dari pembayaran
				
					  $this->session->set_flashdata('error','Your payment is less than transaction ');
						redirect('welcome/payment_confirmation/'.set_value('invoice_id_input'));
						
				}else{  //jika inputan tidak sama
						$this->session->set_flashdata('error','Wrong amount or invoice id.... ! please try again ');
						redirect('welcome/payment_confirmation/'.set_value('invoice_id_input'));
					}
					
			 }
	}
    

    function success_pay($invoice_id = 0 )
	{	
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('welcome/userlogin'));
	    }

		$data = array();
		$data['title'] = 'Ecommerce - U Store';
		$brandmenu = $this->ProductbrandModel->findAllBrand();    //displayAllMenu
		$this->data['brandmenu'] = $brandmenu;  //displayAllMenu


	    $orders = $this->OrderlistModel->get_orders_by_invoice($invoice_id);
        $invoice = $this->OrderlistModel->get_invoice_by_id($invoice_id);
		$this->data['orders']	= $orders;
		$this->data['invoice'] = $invoice;
					
		$data['body'] = $this->load->view('home/success_pay', $this->data, true);
		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');

		
	}

//==================================================================================================================================================//

//==================================================================================================================================================// 

	function changeprofile()
	{	
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('welcome/userlogin'));
	    }

		$data = array();
		$data['title'] = 'Ecommerce - U Store';
		$brandmenu = $this->ProductbrandModel->findAllBrand();    //displayAllMenu
		$comboshipping = $this->ShippingModel->findAll();    //displayAllCombo
		$this->data['brandmenu'] = $brandmenu;
		$this->data['comboshipping'] = $comboshipping;



					
		$data['body'] = $this->load->view('home/profileuser', $this->data, true);
		$this->load->view('templates/frontend/header');
		$this->load->view('templates/frontend/body', $data);
		$this->load->view('templates/frontend/footer');

		
	}
    
    function updateprofile()
	{	
		$this->LoginModel->uservalidate();

    	
    	$id_kota = $this->input->post('id_kota');
    
	  	if ($this->form_validation->run() === false) 
	     {
	        redirect(site_url('Welcome/changeprofile'));
	     }else { 
			
		$data = array(
			'id_kota' => $id_kota
			);
   
    	$this->LoginModel->update($data,'ac_admin');
    	$this->session->set_userdata($data);

		$this->session->set_flashdata('msg', $this->errMsg());
		redirect('Welcome/changeprofile');
		}
    }

    function updatefotoprofile(){
     	
     	$nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        
        $path   = './upload/user/'.$this->session->userdata('username').'/'; //path folder
        $config['upload_path'] = $path; //variabel path untuk config upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '100000'; //maksimum besar file 10M
        $config['max_width']  = '1288'; //lebar maksimum 1288 px
        $config['max_height']  = '768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);

        $idgbr      = $this->input->post('id_admin'); /* variabel id gambar */
        $filelama   = $this->input->post('filelama'); /* variabel file gambar lama */

        if($_FILES['user_pic']['name'])
        {
            if ($this->upload->do_upload('user_pic'))
            {
                $gbr = $this->upload->data();
                
                $data = array(
                  'user_pic' =>$gbr['file_name']

                );
                @unlink($path.$filelama);//menghapus gambar lama, variabel dibawa dari form
                
                $where =array('id_admin'=>$idgbr); 
                $this->LoginModel->updatefoto($data,$where); //akses model untuk menyimpan ke database
                $this->session->set_userdata($data);
                $this->session->set_flashdata('msg', $this->errMsg());
                redirect('Welcome/changeprofile'); //jika berhasil maka akan ditampilkan view vupload

            }else{  /* jika upload gambar gagal maka akan menjalankan skrip ini */
                $msg= '<div role="alert" class="alert alert-danger alert-dismissible fade in">
								<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
								</button>
								<strong>'.$this->upload->display_errors().'</strong>
								</div>';

                $this->session->set_flashdata('msg', $msg);
                 redirect('Welcome/changeprofile'); //jika gagal maka akan ditampilkan form upload
            }
        }
    }
    
//==================================================================================================================================================//

//==================================================================================================================================================// 

    	function userregister()
	{
		$assets = $this->assets();
		$_css = array($assets['css']['bootstrap'], $assets['css']['font_awesome'], $assets['css']['metis'], $assets['css']['sb_admin'], $assets['css']['dataTables'],);
		$_js_top = array($assets['js']['jquery'], $assets['js']['bootstrap']);
		$_js_bottom = array($assets['js']['dataTables'], $assets['js']['metis'], $assets['js']['sb_admin']);

		$this->data['asset_css'] = implode("\n", $_css);
		$this->data['asset_js_top'] = implode("\n", $_js_top);
		$this->data['asset_js_bottom'] = implode("\n", $_js_bottom);
			
		$this->data['title'] = "Ecommerce - Register";
		$this->data['header'] = "Silahkan Register";

		$config_captcha = array(
	    'img_path'  => './captcha/',
	    'img_url'  => base_url().'captcha/',
	    'img_width' => 190,
    	'img_height' => 60,
	    'border' => 0,
	    'font_size' => 20, 
	    'font_path' => FCPATH . 'captcha/Font/captcha4.ttf',
	    'expiration' => 90,
	    'colors'        => array(
                'background' => array(25, 205, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
	   );

		$comboshipping = $this->ShippingModel->findAll();    //displayAllCombo
		$this->data['comboshipping'] = $comboshipping;

		// create captcha image
		 $cap = create_captcha($config_captcha);

		 $datamasuk = array(
				'captcha_time' => $cap['time'],
				'ip_address' => $this->input->ip_address(),
				'word' => $cap['word']
				);
		 
		 $expiration = time()-900;
		 $this->db->query("DELETE FROM ac_captcha WHERE captcha_time < ".$expiration);
		 $query = $this->db->insert_string('ac_captcha', $datamasuk);
		 $this->db->query($query);
		  
		 $this->data['gbr_captcha'] = $cap['image']; 
         //End Captcha

		$this->data['body'] = $this->load->view('login/userregister', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('login/userregister', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function submitregister()
	{
	        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[20]|is_unique[ac_admin.username]|xss_clean');
	        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|xss_clean');
	    
    		$expiration = time()-900;
			$this->db->query("DELETE FROM ac_captcha WHERE captcha_time < ".$expiration);
			
			$sql = "SELECT COUNT(*) AS count FROM ac_captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
			$binds = array($this->input->post('security_code'), $this->input->ip_address(), $expiration);
			$query = $this->db->query($sql, $binds);
			$row = $query->row();

    //jika captcha dbenar   
    if ($this->input->post() && ($row->count == TRUE) && $this->form_validation->run() == TRUE) {
  

        if ($this->form_validation->run() == FALSE)
        {   
        	$msg = '<div class="alert alert-danger" style="text-align: center">
                            Register Failed!
                        </div>';
			 $this->session->set_flashdata('msg', $msg); 
        	redirect('welcome/userregister');
        }
        else
        
        	$username = $this->input->post('username');
        	$data = array(
		        'username'		=> $this->input->post('username'),
		        'password'		=> md5($this->input->post('password')),
		        'id_kota'		=> $this->input->post('id_kota'),
		        'ip_address'	=> $this->input->ip_address(),
		        'user_agent'	=> $this->input->user_agent()
			);

			mkdir('./upload/user/'.$username, 0777, TRUE);
			$this->db->insert('ac_admin', $data);

			$sql_hapus  = "delete FROM ac_captcha";
			$query = $this->db->query($sql_hapus);

			$msg = '<div class="alert alert-success" style="text-align: center">
                           Success Register Account U Store.
                        </div>';
			 $this->session->set_flashdata('msg', $msg); 
			 redirect('welcome/userregister');
        
        }else {
    	// pesan akan muncul jika captcha salah
    	$this->session->set_flashdata('error','<p style="color:red;"><b>Captcha salah :( </b></p>');
    	redirect('welcome/userregister');
   		}
	}

//==================================================================================================================================================//

//==================================================================================================================================================// 

	function userlogin()
	{
		$assets = $this->assets();
		$_css = array($assets['css']['bootstrap'], $assets['css']['font_awesome'], $assets['css']['metis'], $assets['css']['sb_admin'], $assets['css']['dataTables'],);
		$_js_top = array($assets['js']['jquery'], $assets['js']['bootstrap']);
		$_js_bottom = array($assets['js']['dataTables'], $assets['js']['metis'], $assets['js']['sb_admin']);

		$this->data['asset_css'] = implode("\n", $_css);
		$this->data['asset_js_top'] = implode("\n", $_js_top);
		$this->data['asset_js_bottom'] = implode("\n", $_js_bottom);


		if ($this->session->userdata('username') == '') {
				$this->data['body'] = $this->load->view('login/userlogin', $this->data, true);
		} else {
				redirect('welcome');
		}
			
		$this->data['title'] = "Ecommerce - Login";
		$this->data['header'] = "Silahkan Login";

		$this->data['body'] = $this->load->view('login/userlogin', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('login/userlogin', $this->data);
		$this->load->view('templates/backend/footer');
	} 

	function uservalidate()
	{
		$this->LoginModel->validate();

		if ($this->form_validation->run() == FALSE){
			$msg = validation_errors();
			$this->session->set_flashdata('msg', $msg);

			redirect(site_url('welcome/userlogin')); 
		}else {

			$where = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			);

			$model = $this->LoginModel->findAll($where);

			$count = sizeof($model);

			if($count === 1){
				$session = [];

				foreach ($model as $key => $value) {
					$session['id_admin'] = $value->id_admin;        
					$session['username'] = $value->username; 
					$session['password'] = $value->password;
					$session['id_kota'] = $value->id_kota;
					$session['alamat'] = $value->alamat; 
					$session['user_pic'] = $value->user_pic; 
					$session['ongkos_kirim'] = $value->ongkos_kirim; 
					$session['nama_kota'] = $value->nama_kota; 
					$session['ip_address'] = $value->ip_address;
					$session['user_agent'] = $value->user_agent;
				}

					//update ip address & user agent
					$this->db->where('id_admin',$value->id_admin);	
            		$this->db->update('ac_admin', array('ip_address' => $this->input->ip_address(),'user_agent' =>  $this->input->user_agent() ));
            		
				$this->session->set_userdata($session);
				redirect(site_url('welcome/index'));
			}else{
			
			$msg = '<div class="alert alert-danger" style="text-align: center">
                            Access Denied!
                        </div>';
			 $this->session->set_flashdata('msg', $msg); 
			 redirect(site_url('welcome/userlogin'));
			 /*echo "<pre>";
			 var_dump($model);
			 echo "</pre>";*/
			}
		}
	} 

	function userlogout()
	{   
		//update ip address & user agent
		$this->db->where(array('id_admin' => $this->session->has_userdata('id_admin')));	
        $this->db->update('ac_admin', array('ip_address' => '','user_agent' =>  '' ));

		$this->session->sess_destroy();
		redirect(site_url('welcome'));
	}

//==================================================================================================================================================//

//==================================================================================================================================================// 

}
