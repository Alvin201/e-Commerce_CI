<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Category 
                            <?php if (empty($brand)){
                                      echo ""; 
                                  } else{ ?> 
                            <?php echo $brand->id_brand; ?>
                            <?php } ?>    
                            </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


 <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

      <?php
      if (empty($productbybrands)) {
      echo "<h4 style='text-align:center;color:black;'>Sorry, Items in this category are not available. <a href=".base_url('welcome')." class='btn btn-primary ' type='button'>Continue Shopping</a></h4>";
      }
      else {
      ?> 
                <?php
                foreach ($productbybrands as $key => $value) {
                ?>
                <div class="col-md-4 col-sm-6">

                   <ul class="catCardList">
                    <li class="catCardList">
                    <div class="catCard"> 
                    <?php if(empty($value->discount)):
                     echo "";?>
                    <?php else: ?>
                    <div class="ribbon-wrapper-blue">
                    <div class="ribbon-blue">Disc <?php echo $value->discount ?> %
                    </div>
                    </div>
                    <?php endif;?> 
                    
                    <img src="<?php echo base_url();?>upload/product/<?php echo $value->picture_product;?>" >
                
                    <div class="lowerCatCard">
            
                    <h3>
                    <?php 
                    echo anchor('welcome/singleproduct/'.$value->slug_product,$value->name_product,  array('style' => 'font-size:20px;color:blue;' ));?>    
                    </h3>
                    
                    <div class="startingPrice">
                    <?php $hemat = $value->price_product - $value->after_price_discount ;?>
                    <?php if(empty($hemat)):
                     echo "";?>
                    <?php else: ?>
                    <del><?php echo rupiah($hemat,1);?></del>
                    <?php endif;?> 

                    <span><?php echo rupiah($value->after_price_discount,1);?></span>
                    </div>

                    

                    <br/>
                    <strong>Spesification:</strong>
                    <?php echo character_limiter($value->description_product,100) ;?>
                    <?php 
                    echo anchor('welcome/singleproduct/'.$value->slug_product, 'Read more',  array('title' => 'Read More' ));?>
                
                    <br/>
                    <a class="add_to_cart_button" href="<?php echo base_url();?>welcome/buy/<?php echo $value->id_product;?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                    </div>
                    </div>
                    </li>

                    </ul>  
                </div>
                
                <?php
                }
                }
                ?>  
                            
            
            </div>
        <center><a href="#" class="btn btn-default form-control"> See All With Ajax (coming soon)</a> </center>
        </div>
    </div>

