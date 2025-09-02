@extends('jayakari.bic.admin::layouts.default')
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
                <small>Daftar proposal belum dinilai</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Daftar Proposal Belum Dinilai</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Daftar Pendapat Teknis Content
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
                                <span class="caption-subject bold uppercase"> Daftar Proposal Belum Dinilai</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Batch </th>
                                    <th> Topik </th>
                                    <th> Proposal </th>
                                    <th> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proposal as $item)
                                    <tr>
                                        <td>{{$item->topik->batch->batch}}</td>
                                        <td>{{$item->topik->topik}}</td>
                                        <td>{{$item->proposal->judul}}</td>
                                        <td>
                                            <a href="<?php echo env('APP_URL'); ?>/admin/juri/proposal/{{$item->id}}/nilai" class="btn purple">
                                                <i class="fa fa-pencil"></i> Beri Nilai </a>
                                        </td>
                                    </tr>
                                @endforeach
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/pendapat teknis belum dinilai.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop