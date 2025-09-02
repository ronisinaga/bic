@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="modal"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> CONTOH PROPOSAL
                <small>Contoh Proposal untuk Inovator Pengaju Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Contoh Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Berisikan Penjelasan Proposal
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
                            <div class="caption font-green">
                                <i class="icon-pin font-green"></i>
                                <span class="caption-subject bold uppercase">
                                    @if($name == 'laboratorium')
                                        CONTOH PROPOSAL: TAHAPAN - SKALA LABORATORIUM
                                    @elseif($name == 'lapangan')
                                        CONTOH PROPOSAL: TAHAPAN - UJI LAPANGAN
                                    @elseif($name == 'ekonomi')
                                        CONTOH PROPOSAL: TAHAPAN - KELAYAKAN EKONOMI / SIAP DITERAPKAN
                                    @else
                                        CONTOH PROPOSAL: TAHAPAN - TELAH DIKOMERSIALKAN
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    @if(count($explanation) > 0)
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="dashboard-stat blue">
                                                    <div style="margin-top: 10px;margin:10px">
                                                        <div class="desc"> <?php echo $explanation[0]->highlight; ?>  </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo '<h2>'.$explanation[0]->judul.'</h2>'; ?><br>
                                        <h4><b>Abstrak</b></h4>
                                        <?php echo $explanation[0]->abstrak; ?><br>
                                        <h4><b>Deskripsi</b></h4>
                                        <?php echo $explanation[0]->deskripsi; ?><br>
                                        <h4><b>Keunggulan Teknologi</b></h4>
                                        <?php echo $explanation[0]->keunggulan_teknologi; ?><br>
                                        <h4><b>Potensi Aplikasi</b></h4>
                                        <?php echo $explanation[0]->potensi_aplikasi; ?><br>
                                    @else
                                        <h4>Belum ada penjelasan</h4>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/scripts/judul.js" type="text/javascript"></script>
@stop
