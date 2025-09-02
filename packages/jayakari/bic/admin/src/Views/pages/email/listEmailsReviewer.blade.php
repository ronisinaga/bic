@extends('jayakari.bic.admin::layouts.reviewer')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Email Manajemen
                <small>List email masuk</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Email Manajemen</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List Email Masuk</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> List Email Masuk Content
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
                                <span class="caption-subject bold uppercase"> Daftar Email Masuk</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="new_email" class="btn sbold green"> Kirim Email
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
                                    <th> Dari </th>
                                    <th> Judul </th>
                                    <th> Isi Email </th>
                                    <th> Status </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> Nama Inovator 1 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> New Email </td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> Nama Inovator 2 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> New Email </td>
                                </tr>
                                <tr>
                                    <td> 3 </td>
                                    <td> Nama Inovator 3 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> Read </td>
                                </tr>
                                <tr>
                                    <td> 4 </td>
                                    <td> Nama Inovator 4 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> Read </td>
                                </tr>
                                <tr>
                                    <td> 5 </td>
                                    <td> Nama Inovator 5 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> Read </td>
                                </tr>
                                <tr>
                                    <td> 6 </td>
                                    <td> Nama Inovator 6 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> Read </td>
                                </tr>
                                <tr>
                                    <td> 7 </td>
                                    <td> Nama Inovator 7 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> Read </td>
                                </tr>
                                <tr>
                                    <td> 8 </td>
                                    <td> Nama Inovator 8 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> Read </td>
                                </tr>
                                <tr>
                                    <td> 9 </td>
                                    <td> Nama Inovator 9 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> Read </td>
                                </tr>
                                <tr>
                                    <td> 10 </td>
                                    <td> Nama Inovator 10 </td>
                                    <td>
                                        <a href="<?php echo  env('APP_URL'); ?>/admin/email/isiEmailReviewer">Ini judul inovasi yang dibuat oleh inovator</a>
                                    </td>
                                    <td>Isi email yang dikirimkan oleh inovator kepada reviewer. Isi email yang dikirimkan oleh inovator kepada reviewer...</td>
                                    <td> Read </td>
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
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/emails/scripts/actions.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop