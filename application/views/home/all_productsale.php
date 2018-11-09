<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Sale Product</h2>
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
                if(sizeof($productsale)>0):
                foreach ($productsale as $key => $value) {
                ?>
                <div class="col-md-4 col-sm-6">

                    <ul class="catCardList">
                    <li class="catCardList">
                    <div class="catCard"> 
                    
                    <?php $hemat = $value->price_product - $value->after_price_discount ;?>
                    <?php if(empty($hemat)):
                     echo "";?>
                    <?php else: ?>
                    <div class="ribbon-wrapper-blue">
                    <div class="ribbon-blue">- <?php echo rupiah($hemat,1) ?>
                    </div>
                    </div>
                    <?php endif;?>                   
  
          
                    <?php if(empty($value->picture_product)):
                    echo '<img src="../upload/npa.jpg">';?>
                    <?php else: ?>
                    <img src="<?php echo base_url();?>upload/product/<?php echo $value->picture_product;?>" >
                    <?php endif;?>

                    <div class="lowerCatCard">
            
                    <?php if(empty($value->name_product)):
                    echo "";?>
                    <?php else: ?>
                    <h3>
                    <?php 
                    echo anchor('welcome/singleproduct/'.$value->slug_product,$value->name_product,  array('style' => 'font-size:20px;color:blue;' ));?>    
                    </h3>
                    <?php endif;?>
                    
                    <div class="startingPrice">
                    <?php if(empty($value->after_price_discount)):
                    echo "";?>
                    <?php else: ?> 
                    <span><?php echo rupiah($value->after_price_discount,1);?></span>
                    <?php endif;?> 

                    <?php if(empty($value->price_product)):
                    echo "";?>
                    <?php else: ?>
                    <del><?php echo rupiah($value->price_product,1);?></del>
                    <?php endif;?> 
                    </div>

                    <br/>
                    <?php if(empty($value->description_product)):
                    echo "";?>
                    <?php else: ?>
                    <strong>Spesification:</strong>
                    <?php echo character_limiter($value->description_product,100) ;?>
                    <?php 
                    echo anchor('welcome/singleproduct/'.$value->slug_product, 'Baca Selengkapnya',  array('title' => 'Read More' ));?>
                    <?php endif;?>

                    <br/>
                    <?php if(empty($value->id_product)):
                     echo "<h4>Barang Tidak Ditemukan</h4>";
                     ?>
                    <?php else: ?> 
                    <a class="add_to_cart_button" href="<?php echo base_url();?>welcome/buy/<?php echo $value->id_product;?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                    <?php endif;?>
                    </div>
                    </div>
                    </li>

                    </ul>  
                </div>
                
                <?php
                }
                endif;
                ?>  
                            
            
            </div>
        <center><a href="#" class="btn btn-default form-control"> See All With Ajax (coming soon)</a> </center>
        </div>
    </div>

