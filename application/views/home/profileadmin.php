<!-- /.row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $title;?>
            </div>

						<div class="panel-body" width="100px">
							<div class="col-md-12">
								<br/>
								<div class="col-md-3"><?php if($this->session->flashdata('msg')) : ?>
													  <?php echo $this->session->flashdata('msg');?>
								<?php endif;?>
								<?php echo validation_errors(); ?>
								</div>


								
							<div class="col-md-6">
							<form class="form-horizontal" action="<?php echo base_url('dashboard/updateprofile') ?>" method="POST" enctype="multipart/form-data">

                  <div class="form-group">
                      <label>Profile Kamu</label>
                      <br/>
                      <img  class="img-circle" height="100" width="100" alt="" src="<?php echo base_url();?>/upload/user/<?php echo $this->session->userdata('username') ?>/<?php echo $this->session->userdata('user_pic') ?>">
                      <button class="btn btn-info btn-xs" type="button" href="#myModal" data-toggle="modal" title="upload"><i class="fa fa-upload fa-lg"></i></button>
                      <code>Lewati proses ini jika anda tidak mengubah upload gambar</code>
                </div>


              	<div class="form-group">
                					<label for="invoice_input">Kota : </label>

									  <select name="id_kota" class="form-control select2" aria-describedby="sizing-addon2" style="width: 200px;">
								       <option value="">--Pilih Kota--</option>
								             <?php
								            foreach ($comboshipping as $shipping) {
								              ?>
								              <option value="<?php echo $shipping->id_kota; ?>" <?php if($shipping->id_kota == $this->session->userdata('id_kota')){echo "selected='selected'";} ?>><?php echo $shipping->nama_kota; ?></option>
								              <?php
								            }
								            ?>
								      </select>
								<br/>   
								<div class="form-group">
								<div class="col-md-8">
								<?=  anchor('welcome/myorder','Back to history',['class'=>'btn btn-default']) ?>
										
								</div>
								<div class="col-md-2">
									<button type="submit" class="btn btn-info btn-sm">Confirm</button>
								</div>
								</div>
							</div>
							</form>
							</div>
							</div>
							</div>
							</div>
							</div>
							</div>



 <!-- Modal UPLOAD -->     
      <form class="form-horizontal style-form" action="<?php echo base_url(). 'dashboard/updatefotoprofile'; ?>" method="post" enctype="multipart/form-data">
        
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                  <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Upload Photo Profile</h4>
                  </div>
                  <div class="modal-body">
                            <p style="color:black;">Change Photo Profile (max size: 10MB)</p>
                            <input type="hidden" name="id_admin" value="<?php echo $this->session->userdata('id_admin') ?>">
                            <input type="hidden" name="filelama" class="form-control" value="<?php echo $this->session->userdata('user_pic') ?>">

                            <input id="image" type="file" name="user_pic" class="image"  accept="image/*" data-maxfilesize="100000">        
                  </div>
                              
                              <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <button class="btn btn-default btn-xs" type="submit">Upload</button>
                              </div>

                  </div>
              </div>
              </div>
              </form>
              <!-- modal -->
