@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="loading"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal
                <small>Pemilihan Pemenang</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Pemilihan Pemenang</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Pemilihan Pemenang Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase"> Daftar Proposal</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="menu">Batch</label>
                                        <select class="form-control" id="selBatch" name="selBatch">
                                            <option value="0" selected>-- Pilih Batch --</option>
                                            @foreach($batch as $item)
                                                <option value="{{$item->id}}">{{$item->batch}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn green" id="btnView" name="btnView"><i class="fa fa-eye"></i> Tampilkan Proposal</button>
                                </div>
                            </form><hr>
                            <div id="result" name="result">
                                <table class="table table-striped table-bordered table-hover" id="tblPemenang">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Judul Proposal</th>
                                        <th>Rata-rata</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table><hr>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan"><i class="fa fa-save"></i> Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo  dnv('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        var statusProposal = [];
        var idx = 0;
        <?php
                $strID = "";
                $strStatus = "";
                $num = count($statusProposal);
                for($i=0;$i<$num;$i++){
                    if ($i == $num-1){
                        $strID .= $statusProposal[$i]->id;
                        $strStatus .= $statusProposal[$i]->status;
                    }else{
                        $strID .= $statusProposal[$i]->id.",";
                        $strStatus .= $statusProposal[$i]->status.",";
                    }
                }
        ?>
        var strID = "<?php echo $strID; ?>";
        var arrID = strID.split(",");
        var strStatus = "<?php echo $strStatus ?>";
        var arrStatus = strStatus.split(",");
        var numID = arrID.length;
        for(var i=0;i<numID;i++){
            var innerStatus = [arrID[i],arrStatus[i]];
            statusProposal.push(innerStatus);
            idx++;
        }
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->r
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/proposalPemenang.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop