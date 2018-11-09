<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if($this->session->flashdata('msg')) : ?>
  <div class="row">
    <div class="col-sm-12">
      <?php echo $this->session->flashdata('msg');?>
    </div>
  </div>
<?php endif;?>


<!-- /.row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $title;?>
            </div>
             <br>
             &nbsp;&nbsp;<a href="<?php echo base_url('dashboard/addproduct');?>" class="btn btn-success btn-sm">
             <i class="fa fa-pencil"></i>
             Add
             </a>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="table-list-member">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Picture</th>
                            <th>Brand</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Sold out</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if(sizeof($product)>0):
                        foreach ($product as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><img  class="img-circle" height="80" width="80" alt="" src="<?php echo base_url();?>upload/product/<?php echo $value->picture_product;?>"></td>
                            <td><?php echo $value->id_brand;?></td>
                            <td><?php echo $value->name_product;?></td>
                            <td><?php echo rupiah($value->price_product, 1);?></td>
                            <td><?php echo $value->quantity_product;?></td>
                            <td><?php echo $value->dibeli;?></td>
                            <td>
                                <a href="<?php echo base_url();?>dashboard/editproduct/<?php echo $value->id_product;?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                               
                                <a class="btn btn-danger btn-sm" type="button" onclick="hapus('<?php echo $value->name_product;?>', '<?php echo $value->id_product;?>')" data-toggle="tooltip" title="delete"><i class="fa fa-trash-o "></i></a>
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

    <!-- Small modal hapus -->
              <div id="modal-hapus" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
              <div class="modal-content">

              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel2" style="color: black;">Hapus Data</h4>
              </div>

                   <div class="modal-body">
                  <!--modal-body akan diisi oleh function js-->
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a id="link-hapus" class="btn btn-danger" href="#">Delete</a>
                  </div>

              </div>
              </div>
              </div><!-- /modals -->


<script type="text/javascript">
$(function(){
    $('#table-list-member').DataTable({
        responsive: true
    });
})

 //fungsi ini untuk onClick
    function hapus(name_product, id_product)
    {
        var link = '<?php echo base_url();?>dashboard/deleteproduct/' + id_product;
        $('.modal-body').html('Yakin ingin menghapus Data dengan Field :  <strong style="color:blue;">' + name_product+ '</strong> '); //modal-body
        $('#link-hapus').attr('href', link); //link tampil delete/numberid
        $('#modal-hapus').modal('show')      // by id small modal
    }
</script>