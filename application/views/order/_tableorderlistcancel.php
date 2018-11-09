<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- /.row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $title;?>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="table-list-order">
                    <thead>
                        <tr>
                            <th width="20px">Invoice</th>
                            <th>Created</th>
                            <th>Due Date</th>
                            <th>Confirmed</th>
                            <th>Status</th>
                            <th width="100px">Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($models)>0):
                        foreach ($models as $key => $value) {
                        ?>
                        <tr>
                            <td width="10px"><?php echo $value->id;?></td>
                            <td>
                            <?php
                            $create_at = $value->data;
                            if(empty($create_at)){
                             echo "";
                            }else{
                             echo tgl_indo_timestamp($create_at);  
                            }
                            ?>
                            </td>
                           <!-- Due Date -->
                            <td>
                            <?php
                            $due_date = $value->due_date;
                            if(empty($due_date)){
                             echo "";
                            }else{
                             echo tgl_indo_timestamp($due_date);  
                            }
                            ?>
                            </td>
                            <!-- Date Confirm -->
                            <td>
                            <?php 
                            $today = date("Y-m-d H:i:s");
                            $due_date = $value->due_date;
                            $status = $value->status;
                            $date_confirm = $value->date_confirm;
                            
                            if(empty($date_confirm)){
                              echo "";
                            }elseif(($due_date < $today) and ($date_confirm) and ($status == 'unpaid') ){
                              echo $date_confirm = "<code> Expired</code>"; 
                            }elseif (($due_date < $today) and ($date_confirm) and ($status == 'expired') ){
                            echo "<code> Expired</code>";  
                            }elseif (($due_date < $today) and ($date_confirm) and ($status == 'paid') ){
                            echo "<small style='color:green;'> ".tgl_indo_timestamp($date_confirm)."</small>";  
                            }elseif (($due_date < $today) and ($date_confirm) and ($status == 'canceled') ){
                            echo "<code> Pending</code>";  
                            }elseif (($date_confirm) and ($status == 'unpaid') ){
                            echo "<small> Waiting Customers Confirmed Order</small>";  
                            }
                            else{
                              echo "<small style='color:blue;'> ".tgl_indo_timestamp($date_confirm)."</small>";  
                            }
                            ?> 
                            </td>
                            
                            <!-- Status -->
                            <td>
                            <?php
                            $today = date("Y-m-d H:i:s");
                            $date = $value->due_date;
                            $status = $value->status;
                             if($status == 'confirmed'){
                             echo $status = "<span class='btn btn-round btn-default btn-xs'> Confirmed By User</span>";
                            } elseif($status == 'paid'){
                             echo $status = "<span class='btn btn-round btn-success btn-xs'> Paid</span>";
                            } elseif($status == 'canceled'){
                            echo $status = "<span class='btn btn-round btn-warning btn-xs'> Cancel</span>";
                            } elseif(($date < $today) and ($status == 'unpaid')){
                              echo  $status = "<span class='btn btn-round btn-danger btn-xs'> Expired</span>"; 

                            }elseif($status == 'unpaid'){
                              echo  $status = "<span class='btn btn-round btn-info btn-xs'> Unpaid</span>"; 

                            }elseif($status == 'expired'){
                            echo $status = "<span class='btn btn-round btn-warning btn-xs'> Expired</span>";
                            }
                            ?>    
                            </td>
                            <!-- Total -->
                            <td><?php echo rupiah($value->totalbayar, 1);?></td>
                            <td>
                            <!-- Action -->
                            <?php
                            $today = date("Y-m-d H:i:s");
                            $date = $value->due_date;
                            $status = $value->status;
                            $date_confirm = $value->date_confirm;
                             
                            if(($date > $today) and ($status == 'unpaid')) {
                            echo  '<code>Waiting Confirmed Order</code><a href="'.base_url('dashboard/detailorderlist/'.$value->id.'"').'"" > <i class="fa fa-eye" aria-hidden="true"></i>

                                </a>'; 
                            }
                             elseif(($date) and ($status == 'confirmed')){
                             echo '<a href="'.base_url('dashboard/checkorder/'.$value->id.'"').'"" class="btn btn-success btn-xs">
                                    <i class="fa fa-edit"></i>
                                    Edit Status
                                </a>';
                            } elseif(($date) and ($status == 'paid')){
                             echo '<a href="'.base_url('dashboard/detailorderlist/'.$value->id.'"').'" class="btn btn-info btn-xs">
                                    Detail Order</a>';
                             } elseif(($date) and ($status == 'canceled')){
                              echo '<a href="'.base_url('dashboard/checkorder/'.$value->id.'"').'"" class="btn btn-success btn-xs">
                                    <i class="fa fa-edit"></i>
                                    Edit Status
                                </a>';
                             }elseif(($date < $today) and ($status == 'unpaid')){
                              echo '<a href="'.base_url('dashboard/checkorder/'.$value->id.'"').'"" class="btn btn-success btn-xs">
                                    <i class="fa fa-edit"></i>
                                    Edit Status
                                </a>';
                             }
                             
                           
                            ?>
                            
                            
                            </td>


                        </tr>
                        <?php
                        }
                        endif;
                        ?>
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