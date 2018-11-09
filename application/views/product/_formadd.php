<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php if($this->session->flashdata('msg')) : ?>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('msg');?>
		</div>
	</div>
<?php endif;?>

<?php echo validation_errors(); ?>

<form class="form-horizontal style-form" action="<?php echo base_url(). 'dashboard/saveproduct'; ?>" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
		<?php echo form_label('Name Product','name_product', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<input type="text" name="name_product" class="form-control" >
		</div>
	</div>

	<div class="form-group">
		<?php echo form_label('Price Product','price_product', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<input type="number" name="price_product" class="form-control" >
		</div>
	</div>

	<div class="form-group">
		<?php echo form_label('Discount Product','discount', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<input type="number" name="discount" class="form-control" >
		</div>
	</div>

	<div class="form-group">
		<?php echo form_label('Qty Product','quantity_product', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<input type="number" name="quantity_product" class="form-control" >
		</div>
	</div>
    
    <div class="form-group">
		<?php  echo form_label('Picture Product','picture_product', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<input type="file" name="picture_product" class="form-control"  accept="image/*" data-maxfilesize="100000" >
		</div>
	</div>

	 <div class="form-group">
		<?php echo form_label('Description Product','description_product', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<textarea type="text" name="description_product" class="form-control"> </textarea>
		</div>
	</div>

    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Brand</label>
        <div class="col-sm-2">
        <select  name="id_brand" class="form-control">
        <option value="" disabled="disabled" selected="selected">Choose a type</option>
        <?php
        foreach ($brand as $value) {
         ?>
         <option value="<?php  echo $value->id_brand; ?>">
         <?php  echo $value->name_brand; ?>
         </option>
        <?php
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

</form>

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