
    <!-- Page Content -->
    <div class="container">
<br/>
        <!-- /.row -->
        <div class="row">
                        <!-- body items -->
            <!-- load products from table -->
             <div class="col-md-12">

					<div class="panel panel-default">
						<div class="panel-heading">
								<h3>Payment Confirmation :</h3>  
						</div>
						<div class="panel-body" width="100px">
							<div class="col-md-12">
							<h5>Payment for a friend or enter your invoice id ... !</h5>
								<hr>
								<div class="col-md-3"><?= validation_errors() ?>
													  <?= $this->session->flashdata('error') ?>
								</div>
								
							<div class="col-md-6">
							<?= form_open('welcome/payment_confirmation/') ?>
								<div class="form-group">
									<label for="invoice_input">Invoice id : </label>
									<input type="text" class="form-control" name="invoice_id_input" readonly value=<?=( $invoice_id != 0 ? $invoice_id:'')?> >
								</div>
								<div class="form-group">
									<label for="amount">Amount Transfered : </label>
									<input type="text" class="form-control" name="amount_input" >
								</div>
								<div class="form-group">
								<div class="col-md-8">
								<?=  anchor('welcome/myorder','Back to history',['class'=>'btn btn-default']) ?>
										
								</div>
								<div class="col-md-2">
									<button type="submit" class="btn btn-info btn-sm">Confirm My Payment</button>
								</div>
								</div>
							<?= form_close() ?>
							</div>
				

					</div>
					</div>  
			
			</div>
        </div>
        </div>

<!-- /.row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detail Order
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="table-list-order">
                    <thead>
                    <tr>
                    <th>Product id</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>price</th>
                    <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                <!-- load products from table -->
                <?php 
                  $total = 0;
                  $qtytotal = 0;
                  foreach ($orders as $order ) : 
                  $subtotal = $order->qty * $order->price;
                  $qtytotal += $order->qty;
                  $total += $subtotal;
                ?>
                  <tr>
                    <td><?= $order->product_id ?></td>  
                    <td><?= $order->product_type ?></td>
                    <td><?= $order->qty ?></td>
                    <td><?= rupiah($order->price, 1) ?></td>
                    <td><?= rupiah($subtotal, 1) ?></td>
                  
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                     <tr>
                      <td align="right" colspan="5" style="color: blue;">Destination :</td>
                      <td style="color: blue;"><?= $order->nama_kota ?></td>
                    </tr>

                    <tr>
                      <td align="right" colspan="5">Total Quantity :</td>
                      <td><?=$qtytotal?></td>
                    </tr>
                    <tr>
                      <td align="right" colspan="5">Shipping Cost :</td>
                      <td><?= rupiah($order->ongkos_kirim, 1)?></td>
                    </tr>
                    <tr>
                      <td align="right" colspan="5">Payment Total :</td>
                      <td><?=rupiah($total + $order->ongkos_kirim, 1) ?></td>
                    </tr>
                  </tfoot>
                  
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('#table-list-order').DataTable({
        responsive: true
    });
})
</script>
