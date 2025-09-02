@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/buku/css/edit.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Buku
                <small>Update Folder Buku</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Buku</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Update Folder Buku</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Folder Buku Content
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
                                <span class="caption-subject bold uppercase"> Update Folder Buku</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{$buku->id}}">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{$buku->judul}}" disabled>
                                        <label for="menu">Judul Buku</label>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="folder" name="folder" value="{{$buku->folder_final or ''}}">
                                        <label for="menu">Nama Folder Buku</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan"><i class="fa fa-floppy-o"></i> Simpan</button>
                                    <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
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
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
        var folder = 'Folder buku harus diisi';
        var back = host+'/admin/buku';
        var save = host+'/admin/buku/final/folder/save';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/buku/scripts/folder.js" type="text/javascript"></script>
@stop