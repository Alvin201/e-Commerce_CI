<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * ***************************************************************
 * Script :
 * Version :
 * Author : Julio Notodiprodyo
 * Email : njulioiyoo@gmail.com
 * Company : Anone Indonesia
 * Website : http://www.anone.id
 * ***************************************************************
 */
 
class LoginModel extends CI_Model 
{
  private $table_name = 'ac_admin';
  private $pkey = 'id_admin';
  public $id_admin, $username, $password,$id_kota,$alamat,$user_pic;

  function __construct()
  {
    parent::__construct();

  }

  public function validate()
  {
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
  }

  public function uservalidate()
  {
    
    $this->form_validation->set_rules('id_kota', 'ID', 'required');
  }


   function findAll($where = array())
  {
    $model = $this->_queryAll($where);
    return $model->result('LoginModel');
  }

  private function _queryAll($where)
  {
    $fields = 'ac_admin.id_admin as id_admin,ac_admin.username as username,ac_admin.id_kota as id_kota, ac_admin.alamat as alamat, ac_admin.user_pic as user_pic, ac_shipping.id_kota as kota, ac_shipping.nama_kota as nama_kota, ac_shipping.ongkos_kirim as ongkos_kirim';

    $this->db->select($fields);
    $this->db->join('ac_shipping', 'ac_admin.id_kota = ac_shipping.id_kota','left');
    
    if(sizeof($where)>0) $this->db->where($where);
    return $this->db->get($this->table_name);
  }
  
  function update($data) {
     extract($data);
     $this->db->where('id_admin', $this->session->userdata('id_admin'));
       $this->db->update($this->table_name, array('id_kota' => $id_kota));

     return true;
  }

  
  function updatefoto($data,$where){
  extract($data); 
       $this->db->where($where, $this->session->userdata('username'));
       $this->db->update($this->table_name, $data);
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




  function select_by_id() {  
    
    $id_admin = $this->session->userdata('id_admin');

    $this->db->select('*');    
    $this->db->from('ac_admin');
    $this->db->join('ac_shipping', 'ac_admin.id_kota = ac_shipping.id_kota','left');

    $this->db->where(array('id_admin'=>$id_admin));
    $query = $this->db->get();
    return $query ->result();
  }

 
}
