<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- /.row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            	<?php echo $title;?>
            </div>
            <div class="panel-body">
	            <?php $this->load->view('shipping/_form');?>
            </div>
        </div>
    </div>
</div>