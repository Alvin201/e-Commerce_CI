
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
								<h3>Payment :</h3>  
						</div>
						<div class="panel-body" width="100px">
							<div class="col-md-12">
							 <?php foreach ($invoice as $row): ?>     
                <h3 for="invoice_input">No. Order : <span> <?= $row->id ?> </span></h3>
                <br/>
                <h3 for="amount">Amount Transfered : <span> <?= rupiah($row->totalbayar, 1) ?> </span></h3>
                <br/>
                <h3 for="destination">Destination: <span> <?= $row->nama_kota ?> </span> </h3>

                <h3 for="alamat">Address: <span> <?= $row->alamat ?> </span> </h3>
                <br/>
                <?=  anchor('welcome/myorder','Back to history',['class'=>'btn btn-success']) ?>
                                    
        <?php endforeach ; ?>

								
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
