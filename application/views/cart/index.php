
    <!-- Page Content -->
    <div class="container">
<br/>
        <!-- /.row -->
        <div class="row">
                        <!-- body items -->
            <!-- load products from table -->
             <div class="col-md-12">

          <div class="panel panel-default">
            <div class="panel-heading">
                <h3>My Cart :</h3>  
            </div>
            <div class="panel-body" width="100px">
              <div class="col-md-12">
                <div class="col-md-3"><?= validation_errors() ?>
                            <?= $this->session->flashdata('error') ?>
                </div>
                
              <div class="col-md-6">
              <?php echo form_open('welcome/updatecart', array('id' => 'update-title')); ?>
            

              <!-- Start -->
              <table class="container" style="margin-left: -55%;">
             <!--  <thead>

              <tr>      
              <th>Option</th>
              <th>Qty</th>
              <th>Description</th>
              <th>Item Description</th>
              <th>Price</th>
              <th>Sub-total</th>
              </tr>
               
              </thead> -->

              <tbody>
     
              <?php $i = 1; ?>

                
              <?php foreach ($this->cart->contents() as $items): ?>
               
              <input type="hidden" id="<?php echo $i ?>.rowid" name="rowid" value="<?php echo $items['rowid']?>"/>
              <tr>
              
              <!--button Cancel-->
              <td>
              <?php echo anchor('welcome/delete/'.$items['rowid'], 
              '<button class="btn btn-info btn-sm" type="button">Cancel</button>'); ?> 
              </td> <!--End-->

              <td>
              <input type="number"  min="1" class="form-control"  name="<?php echo 'qty'.$i ?>"  value="<?php echo $items['qty'] ?>" style="width:70px; ">
              </td>
              <td><!--image -->
              <img src="<?php echo base_url();?>upload/product/<?php echo $items['picture']; ?>" width="90px;"/>
              </td><!--end image -->
              <td>
              <?php echo $items['name']; ?>
              <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?> 
              <p>
              <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
              <strong><?php echo $option_name; ?>:</strong> 
              <?php echo $option_value; ?><br />

              <?php endforeach; ?>
              </p>
              <?php endif; ?>

              </td>


            <td style="padding-left:5px;"><?php echo 'Rp. '.$this->cart->format_number($items['price']); ?></td>

            <!--hitung subtotal-->
              <?php
              $total = 0; 
              $subtotal=$items['qty']*$items['price'];
              ?>
              
              
              <td style="padding-left:5px;"> <?php  echo 'Rp. '.$this->cart->format_number($subtotal); ?> </td>

              </tr>

            <?php $i++; ?>

            <?php endforeach; ?>

 
      </tbody>


              </table>
              <!-- end -->
              <?php form_close();?>
              </div>
                  
              <?php //start keranjang masih kosong
              if (empty($items)) {
              echo "<h2 style='margin-right:25%;' >Your cart is empty, please shop.</h2> <a class='btn btn-primary ' type='button' href='".base_url('welcome')."'> Continue Shopping</a>";
              }
              else {
              ?>           
              </div>
     
              

              <!-- Total -->
              <strong style="margin-left: 800px;">Total</strong><span> (sudah termasuk Ppn) : </span>

              <?php foreach ($this->cart->contents() as $items){ ?>
              
              <?php
              $items['qty'] = 1+ 
              $subtotal= $items['qty']*$items['price'];
              $total=$total+$subtotal ;
              }
              ?>

              
              <?php
              if(empty($total)){
              echo $this->cart->format_number($this->cart->total()); 
              }else{
              echo'<label>';   
              echo 'Rp.' .$this->cart->format_number($total);
              echo '</label>';
              }
              ?>
              <!-- End Total --> 

              <div class="form-group">
                    <a class="btn btn-primary" type="button"  href='<?php echo base_url('welcome');?>' >Back</a>
                    <a class="btn btn-warning" href="<?php echo base_url('welcome/empty_cart');?>">Clear Cart</a>
                    <a class="btn btn-primary" onclick="return update();">Update Cart</a>
                    <a class="btn btn-success" href="<?php echo base_url('welcome/billing_view');?>">Checkout</a>
              </div>       
              
              <?php } ?> 
              
          </div>
          </div>  
      
      </div>
        </div>
        </div>

<script type="text/javascript">
function update()
{
   document.getElementById('update-title').submit();
}  
</script>
