<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('BrandModel');	
		$this->load->model('AdminModel');	
		$this->load->model('ProductModel');	
		$this->load->model('OrderlistModel');
		$this->load->model('ShippingModel');

		$this->load->helper(array('date_helper','slug_helper'));
		$this->load->library(array('breadcrumbs'));	

		if($this->config->item('system_maintenance') == TRUE) {
         redirect('maintenance');
    	}	
		
	}

	private function template ()
	{
			$assets = $this->assets();
			$_css = array($assets['css']['bootstrap'], $assets['css']['font_awesome'], $assets['css']['metis'], $assets['css']['sb_admin'], $assets['css']['dataTables'],);
			$_js_top = array($assets['js']['jquery'], $assets['js']['bootstrap']);
			$_js_bottom = array($assets['js']['dataTables'], $assets['js']['metis'], $assets['js']['sb_admin']);
			

			$this->data['asset_css'] = implode("\n", $_css);
			$this->data['asset_js_top'] = implode("\n", $_js_top);
			$this->data['asset_js_bottom'] = implode("\n", $_js_bottom);	
	}
//==============================================================================================================
	function index()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	        }

			$this->template();
			$this->data['title'] = "Ecommerce - Dashboard Admin";
			$this->data['header'] = "Dashboard";
   
            $pending = $this->OrderlistModel->total_rows_pending();
            $success = $this->OrderlistModel->total_rows_success();
            $expired = $this->OrderlistModel->total_rows_expired();
			$this->data['total_pending'] = $pending;
			$this->data['total_success'] = $success;
			$this->data['total_expired'] = $expired;

			$this->breadcrumbs->unshift('<i class="fa fa-home" aria-hidden="true"></i> Dashboard', '/');

			$this->data['body'] = $this->load->view('home/dashboard', $this->data, true);
			$this->load->view('templates/backend/header');
			$this->load->view('templates/backend/body', $this->data);
			$this->load->view('templates/backend/footer');
	}

	function login()
	{   
			$this->template();

			if ($this->session->userdata('username') == '') {
				$this->data['body'] = $this->load->view('login/index', $this->data, true);
			} else {
				redirect('dashboard');
			}

			$this->data['title'] = "Ecommerce - Login Admin";
			$this->data['header'] = "Login Admin";

			$this->data['body'] = $this->load->view('login/index', $this->data, true);
			$this->load->view('templates/backend/header');
			$this->load->view('login/index', $this->data);
			$this->load->view('templates/backend/footer');
	}

	function validate()
	{
		$this->LoginModel->validate();

		if ($this->form_validation->run() == FALSE){
			$msg = validation_errors();
			$this->session->set_flashdata('msg', $msg);

			redirect(site_url('dashboard/login')); 
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
				redirect(site_url('dashboard/index'));
			}else{
			
			$msg = '<div class="alert alert-danger" style="text-align: center">
                            Access Denied!
                        </div>';
			 $this->session->set_flashdata('msg', $msg); 
				redirect(site_url('dashboard/login'));
			}
		}
	}

	function logout()
	{
		$this->db->where(array('id_admin' => $this->session->has_userdata('id_admin')));	
        $this->db->update('ac_admin', array('ip_address' => '','user_agent' =>  '' ));

		$this->session->sess_destroy();
		redirect(site_url('dashboard/login'));
	}
	
	//==================================================================================================================================================//

	//==================================================================================================================================================//
	function contactadmin()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	        }
		$this->template();
		$admin	= $this->AdminModel->findAll();
		$this->data['title'] = "Admin";
		$this->data['header'] = "Admin";
		$this->breadcrumbs->unshift('<i class="fa fa-user" aria-hidden="true"></i> Admin', '/');

		$this->data['admin'] = $admin;
		$this->data['body'] = $this->load->view('contact/_tablecontact', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}


	function editadmin($id_admin = false)
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	        }

		$this->template();
		$admin = $this->AdminModel->select_by_id($id_admin);
		
		$this->data['title'] = "Edit Data Admin";
		$this->data['header'] = "Data Admin";
		
		$this->breadcrumbs->push('<i class="fa fa-user" aria-hidden="true"></i> Admin', '/dashboard/contactadmin');
		$this->breadcrumbs->push('Edit Admin', '/dashboard/contactadmin/');
		
		$this->data['admin'] = $admin;

		if($this->input->is_ajax_request()){
			$this->data['ajax'] = true;
			die($this->load->view('contact/_form', $this->data, true));
		}

		$this->data['body'] = $this->load->view('contact/input', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	
	function updateadmin()
	{
	    $this->AdminModel->validate();
	    $created_at = date('Y-m-d H:i:s');

    	$id_admin = $this->input->post('id_admin');
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
	
     	  if ($this->form_validation->run() === false){
        	    redirect(site_url('dashboard/editadmin/'.$id_admin));
      	
      		}else { 
					
					$data = array(
						'id_admin' => $id_admin,
						'username' => $username,
			      		'password' => $password
			    		);
   
		    	$this->AdminModel->update($data,'ac_admin');

				$this->session->set_flashdata('msg', $this->errMsg());
				redirect('dashboard/contactadmin');
			}

	}
	//==================================================================================================================================================//

	//==================================================================================================================================================//
	function product()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }

		$this->template();	
		$product	= $this->ProductModel->findAll();

		$this->data['title'] = "Product";
		$this->data['header'] = "Product";
        $this->breadcrumbs->unshift('<i class="fa fa-cube" aria-hidden="true"></i> Product', '/');


		$this->data['product'] = $product;
		$this->data['body'] = $this->load->view('product/_tableproduct', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function addproduct()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	        }
		$this->template();
	    $brand = $this->BrandModel->findAll(); //combo
		$this->data['brand'] = $brand; //combo

		$this->data['title'] = "Add Data Product";
		$this->data['header'] = "Data Product";
		
		$this->breadcrumbs->push('<i class="fa fa-cube" aria-hidden="true"></i> Product', '/dashboard/product');
		$this->breadcrumbs->push('Add Product', '/dashboard/product/');

		if($this->input->is_ajax_request()){
			$this->data['ajax'] = true;
			die($this->load->view('product/_formadd', $this->data, true));
		}

		$this->data['body'] = $this->load->view('product/inputadd', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function saveproduct()
	{
     	$config['upload_path'] = './upload/product/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 100000;
        $config['remove_spaces'] = TRUE;
        $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time


        $this->upload->initialize($config);
        $this->load->library('upload', $config);
       
       	$this->ProductModel->validate();

       $id_product = $this->input->post('id_product');
       $name_product = $this->input->post('name_product');
       $price_product = (int)$this->input->post('price_product');
       $discount=(int)$this->input->post('discount');
       $quantity_product = $this->input->post('quantity_product');
       $picture_product = $this->input->post('picture_product');
       $description_product=$this->input->post('description_product');
       $id_brand = $this->input->post('id_brand');
              

         //Disc
         $temp_price=round(($price_product*$discount)/100);
         $after_price_discount=round($price_product-$temp_price);     

         if ($this->form_validation->run() === false) {
      					$msg= '<div role="alert" class="alert alert-danger alert-dismissible fade in">
								<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
								</button>
								<strong>'.validation_errors().'</strong>
								</div>';
      					$this->session->set_flashdata('msg', $msg);
                      	redirect(site_url('dashboard/addproduct'));

         }elseif($_POST || $_FILES){   
                    if (!$this->upload->do_upload('picture_product'))
                      {
                          $id_product = $this->input->post('id_product'); 
                          
                          $msg= '<div role="alert" class="alert alert-danger alert-dismissible fade in">
								<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
								</button>
								<strong>'.$this->upload->display_errors().'</strong>
								</div>';

                          $this->session->set_flashdata('msg', $msg);
                          redirect(site_url('dashboard/product'));
                      }   
                    else {
                         $id_product = $this->input->post('id_product');         
                         $file_data = $this->upload->data();
                         $picture_product= $file_data['file_name'];  
                    

                            $data = array(
                             'id_product' => $id_product,
                             'name_product' => $name_product,
                        	 'slug_product' => slug($name_product),
		                     'price_product' => $price_product,
		                     'discount' => $discount,
		                     'after_price_discount' => $after_price_discount,
		                     'quantity_product' => $quantity_product,
		                     'picture_product' => $picture_product,
		                     'description_product' => $description_product,
		                     'dibeli' => '0',
		                     'id_brand' => $id_brand
		                    );
                 
                     		$this->ProductModel->insert($data,'ac_product');
                            $this->session->set_flashdata('msg', $this->errMsg());
                            redirect('dashboard/product');
                        	 /*    echo"<pre>";
                                   var_dump($data);
                                   echo "</pre>";
                             */
                     }
              }     
	}
    


	function editproduct($id_product = false)
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }

		$this->template();
		$product = $this->ProductModel->select_by_id($id_product);
		$brand = $this->BrandModel->findAll();
		
		$this->data['title'] = "Edit Data Product";
		$this->data['header'] = "Data Product";

		$this->breadcrumbs->push('<i class="fa fa-cube" aria-hidden="true"></i> Product', '/dashboard/product');
		$this->breadcrumbs->push('Edit Product', '/dashboard/product/');

		$this->data['product'] = $product;
		$this->data['brand'] = $brand;

		if($this->input->is_ajax_request()){
			$this->data['ajax'] = true;
			die($this->load->view('product/_form', $this->data, true));
		}

		$this->data['body'] = $this->load->view('product/input', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function updateproduct()
	{
     	$created_at = date('Y-m-d H:i:s');

     	$id_product = $this->input->post('id_product');
    	$name_product = $this->input->post('name_product');
    	$price_product = (int)$this->input->post('price_product');
    	$discount=(int)$this->input->post('discount');
    	$quantity_product = $this->input->post('quantity_product');
    	$description_product=$this->input->post('description_product');
		$id_brand = $this->input->post('id_brand');
		
         //Disc
	     $temp_price=round(($price_product*$discount)/100);
	     $after_price_discount=round($price_product-$temp_price);     
         
         $this->ProductModel->updatevalidate(); //cek validasi
 
    
  		if ($this->form_validation->run() === false) 
     	{
     	$msg= '<div role="alert" class="alert alert-danger alert-dismissible fade in">
								<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
								</button>
								<strong>'.validation_errors().'</strong>
								</div>';
      	$this->session->set_flashdata('msg', $msg);
        redirect(site_url('dashboard/editproduct/'.$id_product));
   
   		}else{
     
			$data = array(
					'id_product' => $id_product,
					'name_product' => $name_product,
					'slug_product' => slug($name_product),
		      		'price_product' => $price_product,
		      		'discount' => $discount,
				  	'after_price_discount' => $after_price_discount,
		      		'quantity_product' => $quantity_product,
		      		'description_product' => $description_product,
		      		'id_brand' => $id_brand,
		      		'created_at' => $created_at
			);
		   
		$this->ProductModel->update($data,'ac_product');
		$this->session->set_flashdata('msg', $this->errMsg());
		redirect('dashboard/product');
	
		}
	}
    
    function updatefotoproduct(){
     	
     	$nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $path   = './upload/product/'; //path folder
        $config['upload_path'] = $path; //variabel path untuk config upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '100000'; //maksimum besar file 10M
        $config['max_width']  = '1288'; //lebar maksimum 1288 px
        $config['max_height']  = '768'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);

        $idgbr      = $this->input->post('id_product'); /* variabel id gambar */
        $filelama   = $this->input->post('filelama'); /* variabel file gambar lama */

        if($_FILES['filebaru']['name'])
        {
            if ($this->upload->do_upload('filebaru'))
            {
                $gbr = $this->upload->data();
                $data = array(
                  'picture_product' =>$gbr['file_name']

                );
                @unlink($path.$filelama);//menghapus gambar lama, variabel dibawa dari form

                $where =array('id_product'=>$idgbr); //array where query sebagai identitas pada saat query dijalankan
                $this->ProductModel->get_update($data,$where); //akses model untuk menyimpan ke database

                $this->session->set_flashdata('msg', $this->errMsg());
                redirect(site_url('dashboard/product')); //jika berhasil maka akan ditampilkan view vupload

            }else{  /* jika upload gambar gagal maka akan menjalankan skrip ini */
                $msg= '<div role="alert" class="alert alert-danger alert-dismissible fade in">
								<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
								</button>
								<strong>'.$this->upload->display_errors().'</strong>
								</div>';

                $this->session->set_flashdata('msg', $msg);
                redirect(site_url('dashboard/editproduct/'.$idgbr)); //jika gagal maka akan ditampilkan form upload
            }
        }
    }

    function deleteproduct($id_product)
	{
   	
       /* query menampilkan gambar dibuat dulu agar gambarnya dihapus sebelum dihapus dari database */
       $path= './upload/product/';
       $ardel  = array('id_product'=>$id_product);
       $rowdel = $this->ProductModel->get_byimage($ardel);
 
       /* file gambar dihapus dari folder */
       @unlink($path.$rowdel->picture_product);
 
       /* query hapus dilanjutkan ke model get_delete */
       $this->ProductModel->get_delete($ardel); //karna array where querynya sama, maka saya langsung include saja $ardel
       $msg= '<div role="alert" class="alert alert-danger alert-dismissible fade in">
			<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
			</button>
			<strong>Berhasil hapus data Gambar dan file gambar dari folder</strong>
			</div>';
       $this->session->set_flashdata('msg', $msg); //ini akan dipaste ke view/login
       redirect(site_url('dashboard/product'));
   	
	}
    //==================================================================================================================================================//

	//==================================belum================================================================================================================//
	function brand()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	        }

		$this->template();
		$brand	= $this->BrandModel->findAll();

		$this->data['title'] = "Brand";
		$this->data['header'] = "Brand";
		$this->breadcrumbs->unshift('<i class="fa fa-font-awesome" aria-hidden="true"></i> Brand', '/');

		$this->data['brand'] = $brand;
		$this->data['body'] = $this->load->view('brand/_tablebrand', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');

	}

    function addbrand()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	        }

		$this->template();
		$this->data['title'] = "Add Data Brand";
		$this->data['header'] = "Data Brand";

		$this->breadcrumbs->push('<i class="fa fa-font-awesome" aria-hidden="true"></i> Brand', '/dashboard/brand');
		$this->breadcrumbs->push('Add Brand', '/dashboard/brand/');
		
		if($this->input->is_ajax_request()){
			$this->data['ajax'] = true;
			die($this->load->view('brand/_formadd', $this->data, true));
		}

		$this->data['body'] = $this->load->view('brand/inputadd', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function savebrand()
	{
		$this->BrandModel->validate();
      
    	$id_brand = $this->input->post('id_brand');
    	$name_brand = $this->input->post('name_brand');
    
	  	if ($this->form_validation->run() === false){
	        redirect(site_url('dashboard/addbrand/'));
	     }else {
		  		$data = array(
					'id_brand' => $id_brand,
					'name_brand' => $name_brand,
					'slug_brand' => slug($name_brand)
					);
   
    	$this->BrandModel->insert($data,'ac_brand');
		$this->session->set_flashdata('msg', $this->errMsg());
		redirect('dashboard/brand');
		}

	}

	function editbrand($id_brand = false)
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }
		$this->template();
		$brand = $this->BrandModel->select_by_id($id_brand);
		
		$this->data['title'] = "Edit Data Brand";
		$this->data['header'] = "Data Brand";

		$this->breadcrumbs->push('<i class="fa fa-font-awesome" aria-hidden="true"></i> Brand', '/dashboard/brand');
		$this->breadcrumbs->push('Edit Brand', '/dashboard/brand/');

		$this->data['brand'] = $brand;

		if($this->input->is_ajax_request()){
			$this->data['ajax'] = true;
			die($this->load->view('brand/_form', $this->data, true));
		}

		$this->data['body'] = $this->load->view('brand/input', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function updatebrand()
	{
     
     	$this->BrandModel->validate();

    	$id_brand = $this->input->post('id_brand');
    	$name_brand = $this->input->post('name_brand');
    
  		if ($this->form_validation->run() === false){
        	redirect(site_url('dashboard/editbrand/'.$id_brand));
      	} else { 
		
		$data = array(
			'id_brand' => $id_brand,
			'name_brand' => $name_brand,
			'slug_brand' => slug($name_brand)
			);
   
    	$this->BrandModel->update($data,'ac_brand');

		$this->session->set_flashdata('msg', $this->errMsg());
		redirect('dashboard/brand');
		}

	}

	function detailbrand($id_brand = false)
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	        }

		$this->template();
		$brand = $this->BrandModel->select_by_id($id_brand);
		$product = $this->BrandModel->select_by_brand($id_brand); //display detail
		
		$this->data['title'] = "List Product ";
		$this->data['header'] = "List Product";

		$this->breadcrumbs->push('<i class="fa fa-font-awesome" aria-hidden="true"></i> Brand', '/dashboard/brand');
		$this->breadcrumbs->push('Detail', '/dashboard/brand/');

		$this->data['brand'] = $brand;
		$this->data['product'] = $product; //display detail

		$this->data['body'] = $this->load->view('brand/_tabledetailbrand', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	//==================================================================================================================================================//

	//==================================================================================================================================================//
	function orderlistsuccess()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }
	        
		$this->template();
        $this->breadcrumbs->unshift('<i class="fa fa-file-text" aria-hidden="true"></i> Order', '/');

		$models = $this->OrderlistModel->findAllsuccess();

		$this->data['title'] = "Order List Customer";
		$this->data['header'] = "Order List";

		$this->data['models'] = $models;
		$this->data['body'] = $this->load->view('order/_tableorderlistsuccess', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}
    
    function orderlistcancel()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	        }
	        
		$this->template();		
        $this->breadcrumbs->unshift('<i class="fa fa-file-text" aria-hidden="true"></i> Order', '/');

		
		$models = $this->OrderlistModel->findAllcancel();

		$this->data['title'] = "Order List Customer";
		$this->data['header'] = "Order List";

		$this->data['models'] = $models;
		$this->data['body'] = $this->load->view('order/_tableorderlistcancel', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function orderlistexpired()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }
	        
		$this->template();
		
        $this->breadcrumbs->unshift('<i class="fa fa-file-text" aria-hidden="true"></i> Order', '/');

		$models = $this->OrderlistModel->findAllexpired();

		$this->data['title'] = "Order List Customer";
		$this->data['header'] = "Order List";

		$this->data['models'] = $models;
		$this->data['body'] = $this->load->view('order/_tableorderlistexpired', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

    function orderlistconfirm()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }        
		
		$this->template();		
        $this->breadcrumbs->unshift('<i class="fa fa-file-text" aria-hidden="true"></i> Order', '/');

		$models = $this->OrderlistModel->findAllconfirm();

		$this->data['title'] = "Order List Customer";
		$this->data['header'] = "Order List";

		$this->data['models'] = $models;
		$this->data['body'] = $this->load->view('order/_tableorderlistconfirm', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}
	
	function detailorderlist($invoice_id = false)
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }

		$this->template();
        $this->breadcrumbs->push('<i class="fa fa-file-text" aria-hidden="true"></i> Order', '/dashboard/orderlist');
		$this->breadcrumbs->push('Detail Order', '/dashboard/orderlist/');
		$this->data['title'] = "Detail Order";
		$this->data['header'] = "Detail Order";
		
       	$orderrow = $this->OrderlistModel->get_orders_by_invoice_row($invoice_id);
        $invoice = $this->OrderlistModel->get_invoice_by_id($invoice_id);       
        $orders = $this->OrderlistModel->get_orders_by_invoice($invoice_id);
        
        $this->data['orders']	= $orders;
		$this->data['orderrow']	= $orderrow;
		$this->data['invoice'] = $invoice;
		
		$this->data['body'] = $this->load->view('order/detail', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function checkorder($invoice_id = false)
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }

		$this->template();        
        $this->breadcrumbs->push('<i class="fa fa-file-text" aria-hidden="true"></i> Order', '/dashboard/orderlist');
		$this->breadcrumbs->push('Detail Order', '/dashboard/orderlist/');

		
		$this->data['title'] = "Detail Order";
		$this->data['header'] = "Detail Order";
		
	    $orderrow = $this->OrderlistModel->get_orders_by_invoice_row($invoice_id);
        $invoice = $this->OrderlistModel->get_invoice_by_id($invoice_id);       
        $orders = $this->OrderlistModel->get_orders_by_invoice($invoice_id);
        
        $this->data['orders']	= $orders;
		$this->data['orderrow']	= $orderrow;
		$this->data['invoice'] = $invoice;
	
		$this->data['body'] = $this->load->view('order/checkorder', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function updateorders()
	{       
    	$id = $this->input->post('id');
    	$status = $this->input->post('status');
    
    //jika status 'cancel,unpaid
        if(($status == 'canceled')){

        	$data = array(
			'id' => $id,
			'status' => $status
			);
      
    	$this->OrderlistModel->updatestatus($data,'invoices');
        redirect('dashboard/orderlistcancel');
        
        }elseif(($status == 'expired')){

        	$data = array(
			'id' => $id,
			'status' => $status
			);
      
    	$this->OrderlistModel->updatestatus($data,'invoices');
        redirect('dashboard/orderlistexpired');

        } else {    //selain itu jika dibayar

		$data = array(
			'id' => $id,
			'status' => $status
			);

    	$this->OrderlistModel->updatestatus($data,'invoices');
    	$this->OrderlistModel->updatedibelitambah('ac_product'); //update best sell
    	$this->OrderlistModel->updatekurangstok('ac_product');   //update kurang stok
    	    	
		$this->session->set_flashdata('msg', $this->errMsg());
		redirect('dashboard/orderlistsuccess');
	   }
	} 
	//==================================================================================================================================================//

	//==================================================================================================================================================//
	function shipping()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }
	        
		$this->template();
		$shipping = (new ShippingModel)->findAll();

		$this->data['title'] = "Shipping Cost";
		$this->data['header'] = "Shipping Cost";

		$this->breadcrumbs->unshift('<i class="fa fa-truck" aria-hidden="true"></i> Shipping', '/');


		$this->data['shipping'] = $shipping;
		$this->data['body'] = $this->load->view('shipping/_tableshipping', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}
    
    function addshipping()
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }

		$this->template();
	    $shipping = $this->ShippingModel->findAll(); //combo
		$this->data['shipping'] = $shipping; //combo

		$this->breadcrumbs->push('<i class="fa fa-truck" aria-hidden="true"></i> Shipping', '/dashboard/shipping');
		$this->breadcrumbs->push('Add Shipping', '/dashboard/shipping/');

		$this->data['title'] = "Add Data Shipping";
		$this->data['header'] = "Data Shipping";
		
		
		if($this->input->is_ajax_request()){
			$this->data['ajax'] = true;
			die($this->load->view('shipping/_formadd', $this->data, true));
		}

		$this->data['body'] = $this->load->view('shipping/inputadd', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function saveshipping()
	{
     
     $this->ShippingModel->validate();
    

    	$id_kota = $this->input->post('id_kota');
    	$nama_kota = $this->input->post('nama_kota');
    	$ongkos_kirim = $this->input->post('ongkos_kirim');
    
	    if ($this->form_validation->run() === false){
	        // validation not ok, send validation errors to the view
	        redirect(site_url('dashboard/addshipping/'));
	     }
			$data = array(
				'id_kota' => $id_kota,
				'nama_kota' => $nama_kota,
	      		'ongkos_kirim' => $ongkos_kirim
				);
    	$this->ShippingModel->insert($data,'ac_shipping');
		$this->session->set_flashdata('msg', $this->errMsg());
		redirect('dashboard/shipping');
	}


	function editshipping($id_kota = false)
	{
		if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }

		$this->template();
		$shipping = $this->ShippingModel->select_by_id($id_kota);
		
		$this->data['title'] = "Edit Data Shipping";
		$this->data['header'] = "Data Shipping";
		$this->data['shipping'] = $shipping;

		$this->breadcrumbs->push('<i class="fa fa-truck" aria-hidden="true"></i> Shipping', '/dashboard/shipping');
		$this->breadcrumbs->push('Edit Shipping', '/dashboard/shipping/');

		if($this->input->is_ajax_request()){
			$this->data['ajax'] = true;
			die($this->load->view('shipping/_form', $this->data, true));
		}

		$this->data['body'] = $this->load->view('shipping/input', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer');
	}

	function updateshipping()
	{
     
     $this->ShippingModel->validate();
     
    	$id_kota = $this->input->post('id_kota');
    	$ongkos_kirim = $this->input->post('ongkos_kirim');
    
    	if ($this->form_validation->run() === false){
        redirect(site_url('dashboard/editshipping/'.$id_kota));
      
      	} else { 
		
		$data = array(
			'id_kota' => $id_kota,
			'ongkos_kirim' => $ongkos_kirim
			);
   
    	$this->ShippingModel->update($data,'ac_shipping');

		$this->session->set_flashdata('msg', $this->errMsg());
		redirect('dashboard/shipping');
	}

} 
	
	 function deleteshipping($id_kota)
	{
   		$this->ShippingModel->delete($id_kota);
		$msg = 'Data Berhasil Dihapus';
		$this->session->set_flashdata('msg', $msg); //ini akan dipaste ke view/login
		redirect(site_url('dashboard/shipping'));
	}
//==================================================================================================================================================//

//==================================================================================================================================================// 

	function changeprofile()
	{	
        if($this->session->userdata('username') === NULL){
	            redirect(site_url('dashboard/login'));
	    }
	        
		$this->template();
		
		$this->data['title'] = "Change Profile";
		$this->data['header'] = "Change Profile";

		$comboshipping = $this->ShippingModel->findAll();
		$this->data['comboshipping'] = $comboshipping;

		$this->breadcrumbs->unshift('<i class="fa fa-user" aria-hidden="true"></i> Change Profile', '/');


		$this->data['body'] = $this->load->view('home/profileadmin', $this->data, true);
		$this->load->view('templates/backend/header');
		$this->load->view('templates/backend/body', $this->data);
		$this->load->view('templates/backend/footer'); 
		
	}
    
    function updateprofile()
	{	
		$this->LoginModel->uservalidate();

    	
    	$id_kota = $this->input->post('id_kota');
    
	  	if ($this->form_validation->run() === false) {
	     redirect(site_url('Welcome/changeprofile'));
	    
	     }else{
				
				$data = array(
						'id_kota' => $id_kota
				);
   
    	$this->LoginModel->update($data,'ac_admin');
    	$this->session->set_userdata($data);

		$this->session->set_flashdata('msg', $this->errMsg());
		redirect('dashboard/changeprofile');
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
                redirect('dashboard/changeprofile'); //jika berhasil maka akan ditampilkan view vupload

            }else{  /* jika upload gambar gagal maka akan menjalankan skrip ini */
                $msg= '<div role="alert" class="alert alert-danger alert-dismissible fade in">
								<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
								</button>
								<strong>'.$this->upload->display_errors().'</strong>
								</div>';

                $this->session->set_flashdata('msg', $msg);
                redirect('dashboard/changeprofile'); //jika gagal maka akan ditampilkan form upload
            }
        }
    }   
        
    
//==================================================================================================================================================//

//==================================================================================================================================================// 

	 
}