<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- /.row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $title;?>  
            </div>
             <br>
             &nbsp;&nbsp;<a href="<?php echo base_url('dashboard/addbrand');?>" class="btn btn-success btn-sm">
             <i class="fa fa-pencil"></i>
             Add
             </a>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="table-list-member">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Brand Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if(sizeof($brand)>0):
                        foreach ($brand as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $value->name_brand;?></td>
                            <td>
                                <a href="<?php echo base_url();?>dashboard/editbrand/<?php echo $value->id_brand;?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                                 <a href="<?php echo base_url();?>dashboard/detailbrand/<?php echo $value->id_brand;?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-info"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                        <?php
                        $no++;
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
    $('#table-list-member').DataTable({
        responsive: true
    });
})
</script>