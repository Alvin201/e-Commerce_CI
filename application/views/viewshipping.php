  <br/>
        <!-- Page Content -->
    <div class="container">
        <!-- /.row -->
        <div class="row">
                        <!-- body items -->
            <!-- load products from table -->
             <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
						
					<h3>Shipping :</h3> 
          </div>

      <form action="<?php echo base_url('welcome/save_billing');?>" method="post">       
          <div class="panel-body" width="100px">
					<div class="col-md-12">

<?php foreach ($user as $key => $value): ?>
          <input type="hidden" name="id" value="<?php echo $id_transaksi ?>" >
          <strong>Kota Anda :</strong> <?php echo '<label style="color: blue;">' .$value->nama_kota;?></label><br/>
          <small style="color: red;">(*Jika alamat kota anda ingin diubah , Dapat diakses di menu profile anda atau </small> <a href="<?php echo base_url('welcome/changeprofile');?>" style="text-decoration: underline;"> klik disini </a>
          <br/>  
          <br/>  
          <div id="deliveryaddres" class="shipping_address">        
          <strong>Alamat lengkap :</strong>  
          <?php
          $data = array(
                  'name'          => 'alamat',
                  'id'          => 'alamattext',
                  'style'       => 'width:30%',
                  'class'       => 'form-control',
                  'placeholder'       => 'Alamat lengkap'
              ); 
          ?>
          <?=form_textarea($data)?> 
           </div>
            <p id="shiptobilling" class="form-row">
            Jika alamat sama <input type="checkbox" onclick="SetBilling(this.checked);" /> 
          </p>              
         
         <br/>
          <strong>Biaya kirim :</strong><p>Rp. <?php echo $value->ongkos_kirim;?></p>
<?php endforeach;?>



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
          <br>
          
          <strong>Total yang dibayar :</strong>
          <br/> 
          <?php
          if(empty($total)){
          echo '<td class="right">';
          echo $this->cart->format_number($this->cart->total()); 
          echo '</td>';
          }else{ 
          $total1= $total+$value->ongkos_kirim; 
          echo '<input type="text" name="totalbayar" readonly value="'.$total1.'"  />' ;
          }
          ?>
          <br/>
          <br/>
          <hr/>
          <!-- Message error captcha -->
          <?php 
          if($this->session->flashdata('error')){
            echo $this->session->flashdata('error');
           }
          ?>
          <input type="text" name="security_code" required autocomplete="off" placeholder="Security" >
          <p><?php echo $img; ?></p>
          <br/>
          <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-save"></i>  Save Order</button>
          </div>  

</form>						
						
						
                    </div>
                </div>
            </div>  
			
        </div>





<script type="text/javascript">
 function SetBilling(checked) {
  if (checked) {
        document.getElementById('deliveryaddres').style.display="none";
        document.getElementById('alamattext').value = '<?php echo $this->session->userdata('alamat');?>'; 
  } else {
        document.getElementById('deliveryaddres').style.display="block";
        document.getElementById('alamattext').value = ""; 
  }
}
</script>