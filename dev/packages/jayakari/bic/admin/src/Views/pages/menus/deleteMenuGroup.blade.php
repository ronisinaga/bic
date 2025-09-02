@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Kategori Menu
                <small>Hapus kategori menu</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Kategori Menu</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Hapus Kategori Menu</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Hapus Kategori Menu Content
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
                                <span class="caption-subject bold uppercase"> Hapus Kategori Menu</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><b>Apakah anda yakin hapus kategori menu {{$kategori[0]->kategori}}?</b></h4>
                                    <small><font color="red"> catatan: Apabila kategori menu dihapus maka seluruh menu yang merupakan bagian dari kategori ini akan terhapus juga</font></small>
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{$kategori[0]->id}}">
                                    <input type="hidden" class="form-control" id="name" name="name" value="{{$kategori[0]->kategori}}">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn red" id="btnHapus" name="btnHapus"><i class="fa fa-trash-o"></i> Hapus</button>
                                    <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
                                </div>
                            </div>
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
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/menus/scripts/deletemenugroup.js" type="text/javascript"></script>
@stop
