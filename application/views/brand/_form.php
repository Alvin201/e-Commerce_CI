<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if($this->session->flashdata('msg')) : ?>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('msg');?>
		</div>
	</div>
<?php endif;?>
<?php echo form_open('dashboard/updatebrand', 'class="form-horizontal" id="form-save-package"', array('id_brand'=>$brand->id_brand));?>

	<div class="form-group">
		<?php echo form_label('Name Brand','name_brand', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php echo form_input('name_brand', $brand->name_brand, 'class="form-control"');?>
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



<script type="text/javascript">
$(function(){
	$('#sandbox-container .input-daterange').datepicker({
		format: "yyyy-mm-dd"
    });
})
</script>