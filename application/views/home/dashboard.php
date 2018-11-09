    <div class="container-fluid">
        <div class="row">
            <!-- /.col-lg-12 -->
            <div class="col-sm-12">
                <div class="alert alert-info" role="alert" style="text-align: center">
                    SELAMAT DATANG DI HALAMAN ADMINISTRATOR PENGELOLAHAN DATA WEBSITE ANDA.
                </div>
            </div>

<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-smile-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $total_success; ?></div>
                                    <div>Total Order Success</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url('dashboard/orderlistsuccess') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-meh-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $total_pending; ?></div>
                                    <div>Total Order Cancel</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url('dashboard/orderlistcancel') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-frown-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $total_expired; ?></div>
                                    <div>Total Order Expired</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url('dashboard/orderlistexpired') ?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
<!-- /.row -->

        <!-- Bug -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Fitur yang belum ditambahkan : DiskonHarga, Validasi antara Stok dan jumlah beli agar tidak minus stok, login yang msih satu dengan admin</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Report For Buggs</a>
                </div>
            </div>
        </div>


</div>
</div>
<!-- end container-fluid -->




