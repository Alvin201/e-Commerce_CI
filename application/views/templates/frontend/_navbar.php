<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<script>
function ajaxSearch()
{
    var input_data = $('#search_data').val();

    if (input_data.length === 0)
    {
        $('#suggestions').hide();
    }
    else
    {

        var post_data = {
            'search_data': input_data,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            };

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>welcome/search_product",
            data: post_data,
            success: function (data) {
                // return success
                if (data.length > 0) {
                    $('#suggestions').show();
                    $('#autoSuggestionsList').addClass('auto_list');
                    $('#autoSuggestionsList').html(data);
                }
            }
         });

     }
 }
</script>


 <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                        
                           <li><a href="#"><i class="fa fa-question-circle"></i> FAQ</a></li>    

                            <?php if ($this->session->userdata('username')): ?>
                            
                            <img  class="img-circle" height="30" width="40" alt="" src="<?php echo base_url();?>/upload/user/<?php echo $this->session->userdata('username') ?>/<?php echo $this->session->userdata('user_pic') ?>">    
                            <a style="cursor:pointer" data-toggle="dropdown"> <?php echo ('<strong>'.$this->session->userdata('username').'</strong>'); ?>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('welcome/myorder');?>"><i class="fa fa-file-text-o"></i> History Order</a></li>  
                                <li><a href="<?php echo base_url('welcome/changeprofile');?>"><i class="fa fa-user"></i> Change Profile</a></li>
                                <li><a href="<?php echo base_url('welcome/userlogout');?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                                 
                            <?php else:?>
                            
                            <li><a href="<?php echo base_url('welcome/userlogin');?>"><i class="fa fa-sign-in"></i> Login</a></li>
                            <li><a href="<?php echo base_url('welcome/userregister');?>"><i class="fa fa-rocket"></i> Register</a></li>

                            <?php endif;?> 
                                               
                        </ul>
                    </div>
                </div>

                </div>
                </div>
                </div>



                <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="<?php echo base_url('welcome');?>"><img src="<?php echo base_url();?>assets/coffee/img/logo.png" style="width: 30%;"></a></h1>
                    </div>
                </div>

                <?php $i = 1; ?>
                <?php foreach ($this->cart->contents() as $items): ?>
                <!--hitung subtotal-->
                <?php $total = 0; ?>
                <?php endforeach; ?>
                <?php foreach ($this->cart->contents() as $items):?>
                <?php
                $items['qty'] = 1+ 
                $subtotal= $items['qty']*$items['price'];
                $total=$total+$subtotal;
                ?>
                <?php endforeach; ?>
    

                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="<?php echo base_url('welcome/cart');?>">Cart - <span class="cart-amunt">
                        <?php
                        if(empty($total)){
                        echo 'Rp.0';
                        }else{
                        echo 'Rp. '.number_format($total,0,",",".");
                        }?>   
                        </span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $this->cart->total_items(); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->

      <input name="search_data" id="search_data" type="text" onkeyup="ajaxSearch();" placeholder="Search products..." class="search-box">
                           <label for="search-box"><span class="glyphicon glyphicon-search search-icon"></span></label>       
                           <div id="suggestions">
                            <div id="autoSuggestionsList"></div>
                           </div>
                                                

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url('welcome/allproduct');?>"> All Product</a></li>
                        <li><a href="<?php echo base_url('welcome/allproductsale');?>"> Sale</a></li>
    
            <?php
            if(sizeof($brandmenu)>0):
            foreach ($brandmenu as $key => $value)   
            { 
            echo '<li>';
            
            echo anchor('welcome/categoryproducts/'.$value->slug_brand,$value->name_brand).'</li>';
           }
            endif;
            ?>   
                        </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->



    