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
                        
                    <h3>Order Success :</h3> 
          </div>

          <div class="panel-body" width="100px">
                    <div class="col-md-12">

          <strong>Silahkan lakukan pembayaran ke No. Rek BNI atas nama U-Store : 02102901921209</strong><br/>
          <strong>Atau ke No. Rek BRI atas nama U-Store : 098a901921209</strong><br/>
          </div>
          
         <br/>
          


          <br/>
          <hr/>
          <!-- Message error captcha -->
          </div>  

                  
                        
                        
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