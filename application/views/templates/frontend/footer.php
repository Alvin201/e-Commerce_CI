<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 
 <footer>
 <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>u<span>Stora</span></h2>
                        <p>Safe, Cheap, and Reliable, Only in U-Stora place ..., Hurry Brush Everything !!!</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                        <li><a href="#"><i class="fa fa-question-circle"></i> FAQ</a></li>
                        
                        <?php if ($this->session->userdata('username')): ?>
                        <li><a href="<?php echo base_url('welcome/myorder');?>"><i class="fa fa-file-text-o"></i> History Order</a></li>  
                        <li><a href="<?php echo base_url('welcome/changeprofile');?>"><i class="fa fa-user"></i> Change Profile</a></li>
                        <li><a href="<?php echo base_url('welcome/userlogout');?>"><i class="fa fa-sign-out"></i> Logout</a></li>

                    <?php else:?>
                            
                        <li><a href="<?php echo base_url('welcome/userlogin');?>"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="<?php echo base_url('welcome/userregister');?>"><i class="fa fa-rocket"></i> Register</a></li>

                    <?php endif;?> 
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
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
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                       <p>&copy; 2017 uCommerce. All Rights Reserved.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </footer>

    
 <!-- Latest jQuery form server -->
    <script src="<?php echo base_url();?>assets/coffee/js/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="<?php echo base_url();?>assets/coffee/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="<?php echo base_url();?>assets/coffee/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>assets/coffee/js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="<?php echo base_url();?>assets/coffee/js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="<?php echo base_url();?>assets/coffee/js/main.js"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/coffee/js/bxslider.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/coffee/js/script.slider.js"></script>


</body>
</html>