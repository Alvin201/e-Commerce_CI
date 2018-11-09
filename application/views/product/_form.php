<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if($this->session->flashdata('msg')) : ?>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('msg');?>
		</div>
	</div>
<?php endif;?>

<?php echo validation_errors(); ?>


<?php echo form_open_multipart ('dashboard/updateproduct', 'class="form-horizontal" id="form-save-package"', array('id_product'=>$product->id_product));?>

   				<div class="form-group">
                      <label class="col-sm-2 control-label">Upload</label>
                      <div class="col-sm-10"> 
                      <img  class="img-circle" height="80" width="80" alt="" src="<?php echo base_url();?>upload/product/<?php echo $product->picture_product;?>">
                      <button class="btn btn-info btn-md" type="button" href="#myModal" data-toggle="modal" title="upload"><i class="fa fa-upload fa-lg"></i></button>
                      <code>Lewati proses ini jika anda tidak mengubah upload gambar</code>
                </div>
                </div>
                      
					 <div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="name_product" placeholder="" value="<?= $product->name_product ?>">
						  <code>Jika kata terdapat spasi berikan tanda strip "-" </code>
						</div>
					  </div>
					  
					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Price</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="price_product" placeholder="" value="<?= $product->price_product ?>">
						</div>
					  </div>

                      <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Discount</label>
						<div class="col-sm-10">
						  <input type="number" class="form-control" name="discount" placeholder="" value="<?= $product->discount ?>">
						</div>
					  </div>

					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Qty</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="quantity_product" placeholder="" value="<?= $product->quantity_product ?>">
						</div>
					  </div>
					  

					  <div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
						  <textarea class="form-control" name="description_product"><?= $product->description_product ?></textarea>
						</div>
					  </div>
					  
					

	  <div class="form-group">
                      <label class="col-sm-2 control-label">Brand</label>
                      <div class="col-sm-10">
                      <select required="required" name="id_brand" class="form-control">
                           <?php
                             foreach($brand as $key => $value) {
                              $selected=($product->id_brand==$value->id_brand)?"selected":"";
                              echo "<option ".$selected." value='".$value->id_brand."'>".$value->name_brand."</option>";
                            }
                            ?>        
                      </select>
                      </div>
                </div>

	<div class="form-group">
		<?php echo form_label('','action', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<button class="btn btn-sm btn-default" type="reset">
				<i class="fa fa-refresh"></i>
				Cancel
			</button>
			<button class="btn btn-sm btn-success" type="submit">
				<i class="fa fa-save"></i>
				Save
			</button>
		</div>
	</div>

<?php echo form_close();?>

  <!-- Modal UPLOAD -->     
      <form class="form-horizontal style-form" action="<?php echo base_url(). 'dashboard/updatefotoproduct'; ?>" method="post" enctype="multipart/form-data">
        
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                  <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Upload Item</h4>
                  </div>
                  <div class="modal-body">
                            <p style="color:black;">Upload Item (max size: 10MB)</p>
                            <input type="hidden" name="id_product" value="<?php echo $product->id_product ?>">
                            <input type="hidden" name="filelama" class="form-control" value="<?php echo $product->picture_product;?>">

                            <input id="image" type="file" name="filebaru" class="image"  accept="image/*" data-maxfilesize="100000">        
                  </div>
                              
                              <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <button class="btn btn-theme" type="submit">Upload</button>
                              </div>

                  </div>
              </div>
              </div>
              </form>
              <!-- modal -->

<script type="text/javascript">
$(function(){
	$('#sandbox-container .input-daterange').datepicker({
		format: "yyyy-mm-dd"
    });
})
</script>

<script>
CKEDITOR.replace( 'description_product' );
</script>