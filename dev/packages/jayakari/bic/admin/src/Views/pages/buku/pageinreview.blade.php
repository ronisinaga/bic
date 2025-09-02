@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Buku
                <small>Manajemen buku</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Buku</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List Buku</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Buku Content
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
                                Daftar Buku In Review
                            </div>
                        </div>
                        <div class="portlet-body">
                            @if(count($proposal) > 0)
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> No </th>
                                        <th width="500px"> No Urut </th>
                                        <th width="500px"> Proposal </th>
                                        <th width="220px"> Buku </th>
                                        <th width="220px"> Halaman Ebook </th>
                                        <th width="380px"> Aksi </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $id = 1;
                                    ?>
                                    @foreach($proposal as $data)
                                        <tr>
                                            <td> {{$id}} </td>
                                            <td width="200px">{{$data->orders or $data->id_proposal.'-'}} </td>
                                            <td width="500px">{{$data->judul_lengkap or ''}} </td>
                                            <td width="500px">{{$data->buku_judul or ''}} </td>
                                            <td width="100px">{{$data->page or ''}} </td>
                                            <td width="200px"><a href="{{route('admin.buku.inreview.page.edit',["id"=>$data->id])}}" class="btn blue"><i class="fa fa-pencil"></i> Edit </a></td>
                                        </tr>
                                        <?php
                                        $id = $id+1;
                                        ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>Belum ada data</p>
                            @endif
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
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/buku/scripts/index.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop