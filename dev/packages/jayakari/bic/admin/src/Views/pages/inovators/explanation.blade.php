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
            <h3 class="page-title"> Penjelasan Proposal
                <small>Petunjuk pengisian proposal khususnya untuk abstrak, deskripsi, keunggulan teknologi dan potensi aplikasi</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Petunjuk Pengisian Proposal</span>
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
                                <span class="caption-subject bold uppercase"> Petunjuk Pengisian abstrak, deskripsi, keunggulan teknologi dan potensi aplikasi pada proposal</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <table class="table table-striped table-bordered table-hover" id="tblProposal">
                                        <tbody>
                                            <tr>
                                                <td><a href="{{route('inovator.proposal.type',['name'=>'laboratorium'])}}">Proposal sampai  Tahapan Inovasi  SKALA LABORATORIUM</a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{route('inovator.proposal.type',['name'=>'lapangan'])}}">Proposal sampai Tahapan Inovasi  UJI LAPANGAN</a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{route('inovator.proposal.type',['name'=>'ekonomi'])}}">Proposal sampai Tahapan Inovasi  KELAYAKAN EKONOMI / SIAP DITERAPKAN</a></td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{route('inovator.proposal.type',['name'=>'komersil'])}}">Proposal sampai Tahapan Inovasi TELAH DIKOMERSIALKAN</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
