<div class="related-products-wrapper">
                            <h2 class="related-products-title">Best selling products</h2>

                            <div class="related-products-carousel">
                       

                        <?php
                        if(sizeof($productbest)>0):
                        foreach ($productbest as $key => $value) {
                        ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <?php $hemat = $value->price_product - $value->after_price_discount ;?>
                                        <?php if(empty($hemat)):
                                         echo "";?>
                                        <?php else: ?>
                                        <div class="ribbon-wrapper-blue">
                                        <div class="ribbon-blue">- <?php echo rupiah($hemat,1) ?>
                                        </div>
                                        </div>
                                        <?php endif;?> 


                                        <img src="<?php echo base_url();?>upload/product/<?php echo $value->picture_product;?>" alt="" style= "width:195px; height:190px;" >
                                        <div class="product-hover">
                                            <a href="<?php echo base_url();?>welcome/buy/<?php echo $value->id_product;?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            
                                        </div>
                                    </div>

                                    <?php 
                                    echo anchor('welcome/singleproduct/'.$value->slug_product,$value->name_product,  array('style' => 'font-size:20px;color:blue;' ));
                                    ?>

                                    <div class="product-carousel-price">
                                        <ins><?php echo rupiah($value->after_price_discount,1);?></ins> 
                                        <del><?php echo rupiah($value->price_product,1);?></del>
        
                                    </div> 
                                </div>

                      
                         <?php
                        }
                        endif;
                        ?>
                          

                            </div>
                        </div>
                          
                         <br/> 
                         <center><a href="<?php echo base_url('welcome/allproductsale');?>"  class="btn btn-default form-control" style="width: 100%;"> Look at all the best selling products</a> </center>