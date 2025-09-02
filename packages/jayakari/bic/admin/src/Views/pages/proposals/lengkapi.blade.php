@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal
                <small>Data Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Data Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Data Proposal Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="caption font-green">
                                        <i class="icon-pin font-green"></i>
                                        <span class="caption-subject bold uppercase"> Lengkapi Proposal</span>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                                    <div class="pull-right">
                                        <button class="btn red" id="btnBatal" name="btnBatal"><i class="fa fa-arrow-left"></i> Kembali</button>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <?php
                                if (count($proposal->message) > 0){
                                ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>History Review - {{$proposal->id}} - {{$proposal->judul}}</div>&nbsp;&nbsp;&nbsp;
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label"><b>Perjalanan Review</b></label>
                                                <?php $index = 1; ?>
                                                <table class="table table-striped table-bordered table-hover" id="tblHistory" name="tblHistory">
                                                    <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th style="display: none">ID</th>
                                                        <th>Tanggal</th>
                                                        <th>Dari</th>
                                                        <th>Judul</th>
                                                        <th style="display: none">Message</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($proposal->message()->orderBy('inserted_date','desc')->get() as $item)
                                                        <?php if ($item->id_sender <> 0 || $item->id_receiver <> 0) { ?>
                                                        <tr>
                                                            <td>{{$index}}</td>
                                                            <td style="display: none">{{$item->id}}</td>
                                                            <td><?php $tgl = new DateTime($item->inserted_date); echo $tgl->format("d M Y H:i:s"); ?></td>
                                                            <td>
                                                                <?php
                                                                if ($item->id_receiver == 0){
                                                                    if ($item->user <> null){
                                                                        echo $item->user->fullname;
                                                                    }else{
                                                                        echo '';
                                                                    }
                                                                }else{
                                                                    echo "Reviewer";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><a href="javascript:;" id="detailMessage" name="detailMessage">{{$item->judul}}</a></td>
                                                            <td style="display: none">{{$item->isi}}</td>
                                                        </tr>
                                                        <?php $index++; } ?>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6" id="isi" value="isi">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  } ?>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="reviewProposalAtas" name="reviewProposalAtas"><i class="fa fa-envelope"></i> Mohon Review</button>
                                    <?php
                                    if ($proposal->statusProposal->status == "BARU"){
                                    ?>
                                    <button type="button" class="btn yellow" id="batalProposalAtas" name="batalProposalAtas"><i class="fa fa-close"></i> Batalkan Proposal</button>
                                    <?php
                                    }else{
                                        echo '<button type="button" class="btn yellow" id="batalProposalAtas" name="batalProposalAtas" disabled><i class="fa fa-close"></i> Batalkan Proposal</button>';
                                    }
                                    ?>
                                    <button type="button" class="btn red" id="batalAtas" name="batalAtas"><i class="fa fa-arrow-left"></i> Kembali</button>
                                    <button type="button" class="btn orange" id="explanationAtas" name="explanationAtas"><i class="fa fa-link"></i> Contoh Proposal</button>
                                </div>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>{{$proposal->id}} - {{$proposal->judul}}</div>
                                            <input type="hidden" id="id" name="id" value="{{$proposal->id}}">
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th style="vertical-align: middle">
                                                    <?php
                                                            if ($filled == '1'){
                                                                echo $labels["sudahlengkap"];
                                                            }else{
                                                                echo $labels["lengkapi"];
                                                            }
                                                    ?>
                                                    <?php  ?>
                                                        <!--<h3 style="text-align: justify;">
                                                            Lengkapi seluruh bagian dari proposal ini sehingga status dari setiap bagian (kolom status di bagian kanan) telah berubah dari <b>Kosong</b> menjadi <b>Isi</b> untuk dapat mengirimkan proposal ini dengan menekan tombol <b> Mohon Review</b> yang ada di bagian kiri bawah halaman ini
                                                        </h3>-->
                                                </th>
                                                <th style="vertical-align: middle"> <h3><b>Status</b></h3> </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T1T"]; ?>
                                                    <?php echo $labels["T1D"] ?>
                                                </td>
                                                <td> <a href="<?php echo env('APP_URL'); ?>/admin/inovator/proposal/{{$proposal->id}}/1/edit"><b><p style="font-size: 20px;">Edit</p></b></a> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T1A"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($proposal->abstrak == null){
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T1DK"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($proposal->deskripsi == null){
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T1KT"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($proposal->keunggulan_teknologi == null){
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T1PA"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($proposal->potensi_aplikasi == null){
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T2T"]; ?>
                                                    <?php echo $labels["T2D"]; ?>
                                                </td>
                                                <td> <a href="<?php echo env('APP_URL'); ?>/admin/inovator/proposal/{{$proposal->id}}/2/edit"><b><p style="font-size: 20px;">Edit</p></b></a> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T2TP"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if (($proposal->id_development != null) && ($proposal->id_development != 0)){
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T2H"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if (count($proposal->ipr) > 0){
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T2KKT"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $num = count($proposal->kunciTeknologi);
                                                        if ($num > 0){
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T2KKA"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $num = count($proposal->kunciAplikasi);
                                                        if ($num > 0){
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T2FBR"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (($proposal->id_arn != null) && ($proposal->id_arn != 0)){
                                                        echo 'Isi';
                                                    }else{
                                                        echo '<p style="font-size: 14px;">Kosong</p>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T2K"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $num = count($proposal->kataKunciKolaborasi);
                                                        if ($num > 0){
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T2DI"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        //$num = count($proposal->instansi);
                                                        if ($proposal->instansi <> null){
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T3T"]; ?>
                                                    <?php echo $labels["T3D"]; ?>
                                                </td>
                                                <td> <a href="<?php echo env('APP_URL'); ?>/admin/inovator/proposal/{{$proposal->id}}/3/edit"><b><p style="font-size: 20px;">Edit</p></b></a> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T3DP"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if (count($proposal->inovasiMember) > 0){
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T3F"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if (count($proposal->file) > 0){
                                                            echo '<p style="font-size: 14px;">Isi</p>';
                                                        }else{
                                                            echo '<p style="font-size: 14px;">Kosong</p>';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><hr>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="reviewProposal" name="reviewProposal"><i class="fa fa-envelope"></i> Mohon Review</button>
                                    <?php
                                        if ($proposal->statusProposal->status == "BARU"){
                                    ?>
                                    <button type="button" class="btn yellow" id="batalProposal" name="batalProposal"><i class="fa fa-close"></i> Batalkan Proposal</button>
                                    <?php
                                        }else{
                                            echo '<button type="button" class="btn yellow" id="batalProposal" name="batalProposal" disabled><i class="fa fa-close"></i> Batalkan Proposal</button>';
                                    }
                                    ?>
                                    <button type="button" class="btn red" id="batal" name="batal"><i class="fa fa-arrow-left"></i> Kembali</button>
                                    <button type="button" class="btn orange" id="explanation" name="explanation"><i class="fa fa-link"></i> Contoh Proposal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- popup -->
    <div class="modal fade" id="popupBatal"tabindex="-1" name="popupBatal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Konfirmasi Pembatalan Proposal</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-12">Apakah anda yakin akan membatalkan proposal ini?</label>
                            <div class="col-md-9">
                                <input type="hidden" id="popupProposalID" class="form-control" value="{{$proposal->id}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal"><i class="fa fa-close"></i> Tidak</button>
                    <button type="button" class="btn btn-primary" id="popupBatalProposal"><i class="fa fa-check"></i> Ya</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- end popup-->
@stop
@section('footer_page')
    <script type="application/javascript">
        var filled = "<?php echo $filled; ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/scripts/lengkapiproposal.js" type="text/javascript"></script>
@stop
