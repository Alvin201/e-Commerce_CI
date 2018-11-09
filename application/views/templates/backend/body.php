<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

	<div id="wrapper">

		<?php $this->load->view('templates/backend/_navbar');?>

		<div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo isset($header) ? $header : "Dashboard";?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<?php echo $this->breadcrumbs->show(); ?>
			<?php echo isset($body) ? $body : "";?>

		</div>

	</div>
