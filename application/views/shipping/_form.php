<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if($this->session->flashdata('msg')) : ?>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('msg');?>
		</div>
	</div>
<?php endif;?>
<?php echo form_open('dashboard/updateshipping', 'class="form-horizontal" id="form-save-package"', array('id_kota'=>$shipping->id_kota));?>
   
	<div class="form-group">
		<?php echo form_label('City', 'nama_kota', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php echo form_input('nama_kota', $shipping->nama_kota, 'class="form-control" readonly');?>
		</div>
	</div>

	<div class="form-group">
		<?php echo form_label('Shipping Cost','ongkos_kirim', array('class'=>'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<div class="input-group">
				<span class="input-group-addon">
				Rp.
				</span>
				<?php echo form_input('ongkos_kirim', $shipping->ongkos_kirim, 'class="form-control"');?>
			</div>
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

 
