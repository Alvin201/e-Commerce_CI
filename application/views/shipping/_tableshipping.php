<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- /.row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $title;?>
            </div>
             <br>
             &nbsp;&nbsp;<a href="<?php echo base_url('dashboard/addshipping');?>" class="btn btn-success btn-sm">
             <i class="fa fa-pencil"></i>
             Add
             </a>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="table-list-member">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>City</th>
                            <th>Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if(sizeof($shipping)>0):
                        foreach ($shipping as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $value->nama_kota;?></td>
                            <td><?php echo rupiah($value->ongkos_kirim, 1);?></td>
                            <td>
                                <a href="<?php echo base_url();?>dashboard/editshipping/<?php echo $value->id_kota;?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                               
                                <a class="btn btn-danger btn-sm" type="button" onclick="hapus('<?php echo $value->nama_kota;?>', '<?php echo $value->id_kota;?>')" data-toggle="tooltip" title="delete"><i class="fa fa-trash-o "></i></a>
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
    function hapus(nama_kota, id_kota)
    {
        var link = '<?php echo base_url();?>dashboard/deleteproduct/' + id_kota;
        $('.modal-body').html('Yakin ingin menghapus Data dengan Field :  <strong style="color:blue;">' + nama_kota+ '</strong> '); //modal-body
        $('#link-hapus').attr('href', link); //link tampil delete/numberid
        $('#modal-hapus').modal('show')      // by id small modal
    }
</script>