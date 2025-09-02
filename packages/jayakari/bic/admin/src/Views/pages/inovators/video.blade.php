@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Video Inovator
                <small>Video Inovator</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Video Inovator</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Video Inovator</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Video Inovator Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        <button id="new" name="new" class="btn sbold green"> Tambah Video
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover" id="sample_1" name="sample_1">
                            <thead>
                            <tr>
                                <th style="display: none"> ID </th>
                                <th> No </th>
                                <th> Inovator </th>
                                <th> Judul Proposal </th>
                                <th> URL Youtube </th>
                                <th> Keterangan </th>
                                <th> Aksi </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $index = 1;
                            ?>
                            @foreach($videos as $item)
                                <tr>
                                    <td style="display:none"> {{$item->id}}</td>
                                    <td> {{$index}} </td>
                                    <td> {{$item->innovator->fullname}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->url_youtube}}</td>
                                    <td><?php echo $item->keterangan; ?></td>
                                    <td width="20%">
                                        <a href="<?php echo env('APP_URL'); ?>/admin/inovator/video/edit/{{$item->id}}" class="btn blue">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                        <a href="javascript:;" class="btn red" id="delete" name="delete">
                                            <i class="fa fa-trash"></i> Delete </a>
                                    </td>
                                </tr>
                                <?php $index++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/inovators/scripts/index.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop