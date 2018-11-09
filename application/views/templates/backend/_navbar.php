<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('dashboard');?>">Ecommerce - UStore </a>
    </div>

 <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('dashboard/changeprofile');?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('dashboard/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->



    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <br/> 
                <center>
                <img  class="img-circle" height="100" width="100" alt="" src="<?php echo base_url();?>/upload/user/<?php echo $this->session->userdata('username') ?>/<?php echo $this->session->userdata('user_pic') ?>">
                </center>

                <br/> 
                <li>
                    <a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard fa-fw"></i> DASHBOARD</a>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-shopping-cart"></i> Customer<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo base_url().'dashboard/orderlistconfirm' ?>">Order Confirmed</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url().'dashboard/orderlistsuccess' ?>">Order Success</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url().'dashboard/orderlistcancel' ?>">Order Cancel</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url().'dashboard/orderlistexpired' ?>">Order Expired</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="<?php echo base_url('dashboard/product');?>"><i class="fa fa-cube fa-fw"></i> PRODUCT</a>
                </li>
                <li>
                    <a href="<?php echo base_url('dashboard/brand');?>"><i class="fa fa-tag fa-fw"></i> BRAND</a>
                </li>

                <li>
                    <a href="<?php echo base_url('dashboard/shipping');?>"><i class="fa fa-home fa-fw"></i> SHIPPING COST</a>
                </li>

                <li>
                    <a href="<?php echo base_url('dashboard/contactadmin');?>"><i class="fa fa-user fa-fw"></i> DATA ADMIN</a>
                </li>

                <li>
                    <a href="<?php echo base_url().'welcome' ?>" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> See A Website</a>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>