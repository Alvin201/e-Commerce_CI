<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Side Menu  -->                
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                   
        <div class="single-sidebar">
                        <h2 class="sidebar-title">Discount</h2>
                        <?php
                        if(sizeof($productsale)>0):
                        foreach ($productsale as $key => $value) {
                        ?>
                        <div class="thubmnail-recent">
                            <img src="<?php echo base_url();?>upload/product/<?php echo $value->picture_product;?>" class="recent-thumb" alt="">
                            <h2><?php 
                                    echo anchor('welcome/singleproduct/'.$value->slug_product,$value->name_product,  array('style' => 'font-size:20px;color:blue;' ));
                                    ?></h2>
                            <div class="product-sidebar-price">
                                <ins><?php echo rupiah($value->after_price_discount,1);?></ins> <del><?php echo rupiah($value->price_product,1);?></del>
                            </div>                             
                        </div>
                        <?php
                        }
                        endif;
                        ?>
                       
                    </div>

                   
                    
               
    <!-- End Side Menu  -->
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="<?php echo base_url('welcome');?>">Home</a>
                            <a href="#"><?php echo $productid->name_product;?></a>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                <?php $hemat = $productid->price_product - $productid->after_price_discount ;?>
                                <?php if(empty($hemat)):
                                 echo "";?>
                                <?php else: ?>
                                <div class="ribbon-wrapper-blue" style="left: 140px;">
                                <div class="ribbon-blue">- <?php echo rupiah($hemat,1) ?>
                                </div>
                                </div>
                                <?php endif;?>    
                                        <img src="<?php echo base_url();?>upload/product/<?php echo $productid->picture_product;?>" alt="" style="width: 100%;">
                                    </div>
                                    
                                   
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?php echo $productid->name_product;?></h2>
                                    <div class="product-inner-price">
                                        <ins><?php echo rupiah($productid->after_price_discount,1);?></ins> 
                                        
                                        <?php if($productid->price_product == $productid->after_price_discount):
                                        echo "";?>
                                        <?php else: ?>
                                        <del>
                                        <?php echo rupiah($productid->price_product,1);?>
                                        </del>
                                        <?php endif;?> 

                                   
                                    </div>    
                                    
                                    <a href="<?php echo base_url();?>welcome/buy/<?php echo $productid->id_product;?>" class="add_to_cart_button" ><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                    

                                    <div class="product-inner-category">
                                        
                                    </div> 
                                    
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active" style="margin-right: 60%;"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                           
                                           
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>  
                                                <p><?php echo $productid->description_product;?>.</p>

            
                                            </div>
                                           
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <?php $this->load->view('selectproduct/bestsell');?>

                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>


    