<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php if($this->session->flashdata('msg')) : ?>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('msg');?>
		</div>
	</div>
<?php endif;?>
<div id="error-message"></div>
<?php echo form_open('dashboard/updateadmin', 'class="form-horizontal" id="form-save-admin"', array('id_admin'=>$admin->id_admin));?>

	<div class="form-group">
		<?php echo form_label('User Name','username', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php echo form_input('username', $admin->username, 'class="form-control"');?>
		</div>
	</div>

	<div class="form-group">
		<?php echo form_label('Password','password', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<input type="password" name="password" placeholder="Isi kembali Password Jika Data diubah" class="form-control" >
		</div>
	</div>

	

	<div class="form-group">
		<?php echo form_label('','action', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<button class="btn btn-sm btn-default" type="reset" data-dismiss="modal">
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

<?php if(isset($ajax)):?>
<script type="text/javascript">
$('#form-save-admin').submit(function(e){
	e.preventDefault();
	var $form = $(this),
		$data = $form.serialize();
	$.post($form.attr('action'), $data, function(res){
		if(res.error){
			$('#error-message').html(res.msg);
			return;
		}
		$('button[type="reset"]').trigger('click');
		location.reload();
	});
});
</script>
<?php endif;?>