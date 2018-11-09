    <!-- Page Content -->
    <div class="container">

<br/>
        <!-- /.row -->
        <div class="row">
                        <!-- body items -->
            <!-- load products from table -->
             <div class="col-md-12">

                <div class="panel panel-default">
                    <?php if($history != FALSE):?>
					<?= $this->session->flashdata('message')?>
					<div class="panel-heading">
						
							<h3>My History : </h3> 
                    </div>
					
                    <div class="panel-body" width="100px">
						<div class="col-md-12">
							<hr>
								<div class="col-md-2">
								<h3>Invoice No.</h3>
								</div>
								<div class="col-md-2">
								<h3>Invoice Date</h3>
								</div>
								<div class="col-md-2">
								<h3>Due Date</h3>
								</div>
								<div class="col-md-2">
								<h3>Qty Total</h3>
								</div>
								<div class="col-md-2">
								<h3>Payment</h3>
								</div>
								<div class="col-md-1">
								<h3>Status</h3>
								</div>
								
								
								
						</div>  
						
						<?php foreach ($history as $row): ?>
						<div class="col-md-12">
							<hr>
							<div class="col-md-2">
								<?= $row->id ?>
							</div>
							<div class="col-md-2">
								<?= tgl_indo_timestamp($row->data) ?>
							</div>
							<div class="col-md-2">
								<?= tgl_indo_timestamp($row->due_date) ?>
							</div>
							<div class="col-sm-2">
								<?= $row->total ?>
							</div>
							<div class="col-md-2">
								<?= rupiah($row->totalbayar, 1) ?>
							</div>
					
					      
							<div class="col-md-1">
								
								<?php
                                $today = date("Y-m-d H:i:s");
                            	$date = $row->due_date;  
								
								if(($date < $today) and ($row->status == 'unpaid')):?>
								<code><?= $row->status ?></code>
								<br/>
							   	<br/>
								<?php  
								echo "<span class='btn btn-round btn-info btn-xs'>Sorry your order was expired</span>"; ?>

							    <?php elseif($row->status == 'expired'):?>
                               	<code><?= $row->status ?></code>
                               	
							   	<?php elseif($row->status == 'unpaid'):?>
                               	<code><?= $row->status ?></code>
                               	 <?= anchor('welcome/payment_confirmation/'.$row->id,'Confirm Payment',array('class'=>'btn btn-default btn-xs')) ?>
							   	

							   	<?php elseif($row->status == 'paid'):?>
							   	 <code><?= $row->status ?></code>
							   	<br/>
							   	<br/>
								<?= anchor('welcome/success_pay/'.$row->id,'Detail',array('class'=>'btn btn-default btn-xs')) ?>

								<?php elseif($row->status == 'canceled'):?>
							     <code><?= $row->status ?></code>
							     <?= anchor('welcome/payment_confirmation/'.$row->id,'Confirm Payment Canceled',array('class'=>'btn btn-default btn-xs')) ?>
							    
							    <?php elseif($row->status == 'confirmed'):?>
							   	 <code><?= $row->status ?></code>
							   	 <br/>
							   	 <br/>
								<?= anchor('welcome/success_pay/'.$row->id,'Detail',array('class'=>'btn btn-default btn-xs')) ?>
								<?php endif;?>
							</div>
							
							
							
						</div> 
						<?php endforeach;?>
						
						<div class="col-md-12">
							<hr/>
							</div>
							<div class="col-md-2">
							<?=  anchor(base_url(),'Back to Home',['class'=>'btn btn-default','role'=>'button']) ?>
							</div>
						</div>
					
                    </div>
					<?php else : ?>
					<div class="panel-heading">
						
							<h3>My History :  </h3> 
                    </div>
					<div class="col-md-12">
							<hr>	
						<div class="col-md-3"></div>
						<div class="col-md-6"><h3>There Are No Shopping History For You !</h3></div>
						<div class="col-md-3"><?=  anchor(base_url(),'Shopping Now',['class'=>'btn btn-primary','role'=>'button']) ?></div>
					</div>
					<?php endif?>
                </div>
            </div>  
			
        </div>
        <!-- /.row -->

        <!-- Features Section -->

        <!-- /.row -->
