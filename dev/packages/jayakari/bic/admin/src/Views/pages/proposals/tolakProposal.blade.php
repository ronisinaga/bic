@extends('jayakari.bic.admin::layouts.reviewer')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal
                <small>Perbanding nilai juri</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Perbandingan nilai juri</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Perbandingan nilai juri Content
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
                                <span class="caption-subject bold uppercase"> Perbandingan nilai juri</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><b>Topik: Judul Inovasi yang diberikan oleh inovator (Ditolak)</b></h4>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Juri </th>
                                        <th> Originalitas </th>
                                        <th> Reka Ulang </th>
                                        <th> Daya Tarik </th>
                                        <th> Nilai Tambah </th>
                                        <th> P. Pengembangan </th>
                                        <th> P. Ekspansi </th>
                                        <th> Potensi Bisnis </th>
                                        <th> Resiko Bisnis </th>
                                        <th> Rekomendasi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td> Dewan Juri 1 </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 2 </td>
                                        <td> Dewan Juri 2 </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 3 </td>
                                        <td> Dewan Juri 3 </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 4 </td>
                                        <td> Dewan Juri 4 </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 5 </td>
                                        <td> Dewan Juri 5 </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 6 </td>
                                        <td> Dewan Juri 6 </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 7 </td>
                                        <td> Dewan Juri 7 </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                        <td>
                                            <b>3</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/scripts/listproposalreviewer.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop