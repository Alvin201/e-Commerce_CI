<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"></h3><?php echo $header;?></h3>
                </div>
                <br>
                    <?php echo $this->session->flashdata('msg');?>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo base_url();?>welcome/submitregister" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="User Name" name="username" type="username" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>

                           <div class="form-group">
                            <select name="id_kota" class="form-control select2" aria-describedby="sizing-addon2" style="width: 200px;">
                            <option value="">--Pilih Kota--</option>
                                <?php
                                foreach ($comboshipping as $shipping) {
                                ?>
                                <option value="<?php echo $shipping->id_kota; ?>"><?php echo $shipping->nama_kota; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            </div>  

                             <!-- Message error captcha -->
                              <?php 
                              if($this->session->flashdata('error')){
                                echo $this->session->flashdata('error');
                               }
                              ?>
                              <input type="text" name="security_code" class="form-control" required placeholder="Security" > 
                              <p><?php echo $gbr_captcha; ?></p> 

                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>  
                        </fieldset>
                    </form>
                    <br/>
                     <a href="<?php echo base_url('welcome/userlogin');?>"><i class="fa fa-sign-in"></i> You Have Account? Login</a>
                    <br/>
                     <a href="<?php echo base_url('welcome');?>"><i class="fa fa-shopping-cart"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
