<div class="slider-area">
            <!-- Slider -->
            <div class="block-slider block-slider4">
                <ul class="" id="bxslider-home4">
                    <li>
                        <img src="<?php echo base_url();?>assets/coffee/img/h4-slide.png" alt="Slide">
                        <div class="caption-group">
                            <h2 class="caption title">
                                iPhone <span class="primary">6 <strong>Plus</strong></span>
                            </h2>
                            <h4 class="caption subtitle">Dual SIM</h4>
                            <!-- <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a> -->
                        </div>
                    </li>
                    <li><img src="<?php echo base_url();?>assets/coffee/img/h4-slide3.png" alt="Slide">
                        <div class="caption-group">
                            <h2 class="caption title">
                                by one, get one <span class="primary">50% <strong>off</strong></span>
                            </h2>
                            <h4 class="caption subtitle">Apple Store Ipod.*</h4>
                            <!-- <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a> -->
                        </div>
                    </li>
                  
                    <li><img src="<?php echo base_url();?>assets/coffee/img/h4-slide4.png" alt="Slide">
                        <div class="caption-group">
                          <h2 class="caption title">
                                Apple <span class="primary">Store <strong>Ipod</strong></span>
                            </h2>
                            <h4 class="caption subtitle">& Phone</h4>
                            <!-- <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a> -->
                        </div>
                    </li>
                </ul>
            </div>
            <!-- ./Slider -->
    </div> <!-- End slider area -->
    


<div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Delivery by JNE</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->

<div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Products</h2>  <center><a href="<?php echo base_url('welcome/allproduct');?>" class="btn btn-default"> See All</a> </center>

                        <div class="product-carousel">

                        <?php
                        if(sizeof($product)>0):
                        foreach ($product as $key => $value) {
                        ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="<?php echo base_url();?>upload/product/<?php echo $value->picture_product;?>" style= "width:195px; height:190px;" alt="">
                                    <div class="product-hover">
                                        <a href="<?php echo base_url();?>welcome/buy/<?php echo $value->id_product;?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                    </div>
                                </div>
                                
                                <?php 
                                 echo anchor('welcome/singleproduct/'.$value->slug_product,$value->name_product,  array('style' => 'font-size:20px;color:blue;' ));
                                ?>
                                <?php $saving = $value->price_product - $value->after_price_discount ;?>

                                <?php if(empty($saving)):
                                     echo "";?>
                                    <?php else: ?>
                                    <ul class="tags">
                                        <li><a href="#">Saving <?php echo rupiah($saving,1) ?></a></li>
                                    </ul>
                                <?php endif;?>
                                <br/>
                                <br/>    
                                <div class="product-carousel-price">
                                    <ins><?php echo rupiah($value->after_price_discount,1);?></ins>
                                    <?php $saving = $value->price_product - $value->after_price_discount ;?> 
                                    <?php if(empty($saving)):
                                     echo "";?>
                                    <?php else: ?> 
                                    <del><?php echo rupiah($saving,1);?></del>
                                    <?php endif;?>
                                </div> 
                            </div>
                        <?php
                        }
                        endif;
                        ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    



    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sale</h2>  <center><a href="<?php echo base_url('welcome/allproductbest');?>" class="btn btn-default"> See All</a> </center>

                        <div class="product-carousel">

                        <?php
                        if(sizeof($productsale)>0):
                        foreach ($productsale as $key => $value) {
                        ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="<?php echo base_url();?>upload/product/<?php echo $value->picture_product;?>" style= "width:195px; height:190px;" alt="">
                                    <div class="product-hover">
                                        <a href="<?php echo base_url();?>welcome/buy/<?php echo $value->id_product;?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>

                                    </div>
                                </div>
                                
                                 <?php 
                                 echo anchor('welcome/singleproduct/'.$value->slug_product,$value->name_product,  array('style' => 'font-size:20px;color:blue;' ));
                                ?>
                                <?php $saving = $value->price_product - $value->after_price_discount ;?>
                                <?php if(empty($saving)):
                                     echo "";?>
                                    <?php else: ?>
                                    <ul class="tags">
                                        <li><a href="#">Saving <?php echo rupiah($saving,1) ?></a></li>
                                    </ul>
                                <?php endif;?>
                                <br/>
                                <br/>    
                                <div class="product-carousel-price">
                                    <ins><?php echo rupiah($value->after_price_discount,1);?></ins> <del><?php echo rupiah($value->price_product,1);?></del>
                                </div> 
                            </div>
                        <?php
                        }
                        endif;
                        ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
 
 
        <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Best Sell</h2>  <center><a href="<?php echo base_url('welcome/allproductbest');?>" class="btn btn-default"> See All</a> </center>

                        <div class="product-carousel">

                        <?php
                        if(sizeof($productbest)>0):
                        foreach ($productbest as $key => $value) {
                        ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="<?php echo base_url();?>upload/product/<?php echo $value->picture_product;?>" style= "width:195px; height:190px;" alt="">
                                    <div class="product-hover">
                                        <a href="<?php echo base_url();?>welcome/buy/<?php echo $value->id_product;?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>

                                    </div>
                                </div>
                                
                                 <?php 
                                 echo anchor('welcome/singleproduct/'.$value->slug_product,$value->name_product,  array('style' => 'font-size:20px;color:blue;' ));
                                ?>
                                <?php $saving = $value->price_product - $value->after_price_discount ;?>
                                <?php if(empty($saving)):
                                     echo "";?>
                                    <?php else: ?>
                                    <ul class="tags">
                                        <li><a href="#">Saving <?php echo rupiah($saving,1) ?></a></li>
                                    </ul>
                                <?php endif;?>
                                <br/>
                                <br/>    
                                <div class="product-carousel-price">
                                    <ins><?php echo rupiah($value->after_price_discount,1);?></ins> <del><?php echo rupiah($value->price_product,1);?></del>
                                </div> 
                            </div>
                        <?php
                        }
                        endif;
                        ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

     <!-- <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="<?php echo base_url();?>assets/coffee/img/brand1.png" alt="">
                            <img src="<?php echo base_url();?>assets/coffee/img/brand2.png" alt="">
                            <img src="<?php echo base_url();?>assets/coffee/img/brand3.png" alt="">
                            <img src="<?php echo base_url();?>assets/coffee/img/brand4.png" alt="">
                            <img src="<?php echo base_url();?>assets/coffee/img/brand5.png" alt="">
                            <img src="<?php echo base_url();?>assets/coffee/img/brand6.png" alt="">
                                                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --> <!-- End brands area -->
