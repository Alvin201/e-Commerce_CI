<?php
/**
*
*/
class Authentication
{
    protected $CI;
    function __construct()
    {
        $this->CI =& get_instance();
    }

    public function authenticate()
    {
        if($this->CI->session->userdata('username') === NULL){
            redirect(site_url('dashboard/login'));
        }
    }
}
