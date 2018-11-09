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
                    <form role="form" method="post" action="<?php echo base_url();?>welcome/uservalidate">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="User Name" name="username" type="username" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>  
                        </fieldset>
                    </form>

                    <br/>
                     <a href="<?php echo base_url('welcome/userregister');?>"><i class="fa fa-rocket"></i> You Dont Have Account? Register</a>
                     <br/>
                     <a href="<?php echo base_url('welcome');?>"><i class="fa fa-shopping-cart"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
