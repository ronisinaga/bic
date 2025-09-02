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
            <h3 class="page-title"> Manajemen Kategori Berita
                <small>List kategori berita</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Kategori Berita</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List Kategori Berita</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Kategori Berita Content
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
                                <span class="caption-subject bold uppercase"> Daftar Kategori Berita</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="new" name="new" class="btn sbold green"> Tambah Kategori Berita
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                            <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Export
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Kategori Berita </th>
                                    <th> Keterangan </th>
                                    <th> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> Inovasi </td>
                                    <td>
                                        Keterangan Berita Inovasi
                                    </td>
                                    <td>
                                        <button type="button" class="btn blue" id="edit" name="edit">Edit</button>
                                        <button type="button" class="btn red" id="delete" name="delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> Teknologi </td>
                                    <td>
                                        Keterangan Berita Teknologi
                                    </td>
                                    <td>
                                        <button type="button" class="btn blue" id="edit" name="edit">Edit</button>
                                        <button type="button" class="btn red" id="delete" name="delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 3 </td>
                                    <td> Bisnis </td>
                                    <td>
                                        Keterangan Berita Bisnis
                                    </td>
                                    <td>
                                        <button type="button" class="btn blue" id="edit" name="edit">Edit</button>
                                        <button type="button" class="btn red" id="delete" name="delete">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 4 </td>
                                    <td> Science </td>
                                    <td>
                                        Keterangan Berita Science
                                    </td>
                                    <td>
                                        <button type="button" class="btn blue" id="edit" name="edit">Edit</button>
                                        <button type="button" class="btn red" id="delete" name="delete">Delete</button>
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/news/scripts/newsgroup.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop