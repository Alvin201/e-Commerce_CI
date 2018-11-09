<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class MY_Controller extends CI_Controller
{
	protected $data = array();

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function __construct()
	{
		parent::__construct();

		$this->data['title'] = 'U store';
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	protected function assets()
	{
		return array(
			'css' => array(
				'bootstrap'=>'<link href="'.base_url('assets/sb2/bootstrap/css/bootstrap.min.css').'" rel="stylesheet" />',
				'metis'=>'<link href="'.base_url('assets/sb2/metisMenu/metisMenu.min.css').'" rel="stylesheet" />',
				'sb_admin'=>'<link href="'.base_url('assets/sb2/dist/css/sb-admin-2.css').'" rel="stylesheet" />',
				'font_awesome'=>'<link href="'.base_url('assets/sb2/font-awesome/css/font-awesome.min.css').'" rel="stylesheet" />',
				'morris'=>'<link href="'.base_url('assets/sb2/morrisjs/morris.css').'" rel="stylesheet" />',
				'dataTables'=>'<link href="'.base_url('assets/sb2/datatables-plugins/dataTables.bootstrap.css').'" rel="stylesheet" />'."\n".'<link href="'.base_url('assets/sb2/datatables-responsive/dataTables.responsive.css').'" rel="stylesheet" />',
				'front_end'=>'<link href="'.base_url('assets/salon/css/style.css').'" rel="stylesheet" />',
				'datepicker'=>'<link href="'.base_url('assets/lib/datepicker/css/bootstrap-datepicker.min.css').'" rel="stylesheet" />',
			),
			'js' => array(
				'jquery'=>'<script src="'.base_url('assets/sb2/jquery/jquery.min.js').'"></script>',
				'bootstrap'=>'<script src="'.base_url('assets/sb2/bootstrap/js/bootstrap.min.js').'"></script>',
				'metis'=>'<script src="'.base_url('assets/sb2/metisMenu/metisMenu.min.js').'"></script>',
				'sb_admin'=>'<script src="'.base_url('assets/sb2/dist/js/sb-admin-2.js').'"></script>',
				'morris'=>'<script src="'.base_url('assets/sb2/morrisjs/morris.min.js').'"></script>'."\n".'<script src="'.base_url('assets/sb2/raphael/raphael.min.js').'"></script>',
				'dataTables'=>'<script src="'.base_url('assets/sb2/datatables/js/jquery.dataTables.min.js').'"></script>'."\n".'<script src="'.base_url('assets/sb2/datatables-plugins/dataTables.bootstrap.min.js').'"></script>'."\n".'<script src="'.base_url('assets/sb2/datatables-responsive/dataTables.responsive.js').'"></script>',
				'datepicker'=>'<script src="'.base_url('assets/lib/datepicker/js/bootstrap-datepicker.min.js').'"></script>',
				'clock'=>'<script src="'.base_url('assets/lib/js/clock.js').'"></script>',
				'moment'=>'<script src="'.base_url('assets/lib/js/moment.js').'"></script>',
				'moment_with_locales'=>'<script src="'.base_url('assets/lib/js/moment-with-locales.js').'"></script>',
				'ckeditor'=>'<script src="//cdn.ckeditor.com/4.7.0/basic/ckeditor.js"></script>',
			)
		);
	}

	protected function errMsg($pesan ='', $err = '')
	{
		if($pesan == '' && $err == ''){
			$pesan = 'Saved Successfully';
			$err = 'success';
		}

		$msg = '
			<div role="alert" class="alert alert-'.$err.' alert-dismissible fade in">
			<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
			</button>
			<strong>'.$pesan.'</strong>
			</div>
		';
		return $msg;
	}



} // END class 