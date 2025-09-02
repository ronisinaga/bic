@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/isibuku/css/add.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Video
                <small>Video buku</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Video</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Video Buku</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Video Buku Content
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
                                <span class="caption-subject bold uppercase"> Video buku</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{$isibuku->judul_singkat}}" disabled>
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$isibuku->id}}">
                                        <label for="form_control_1">Judul Singkat</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="youtube" name="youtube">
                                        <label for="form_control_1">Youtube URL</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="form_control_1">Keterangan Video</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan">Simpan</button>
                                    <button type="button" class="btn default" id="btnBatal" name="btnBatal">Batal</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover" id="tblResult" name="tblResult">
                                        <thead>
                                        <tr>
                                            <th> No </th>
                                            <th style="display: none"> ID Video </th>
                                            <th> Buku </th>
                                            <th> URL Youtube </th>
                                            <th> Keterangan </th>
                                            <th> Aksi </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $index = 1 ?>
                                        @foreach($isibuku->video as $item)
                                            <tr>
                                                <td>{{$index}}</td>
                                                <td style="display: none">{{$item->id}}</td>
                                                <td>{{$item->isiBuku->judul_singkat}}</td>
                                                <td>{{$item->youtube_url}}</td>
                                                <td>{{$item->keterangan}}</td>
                                                <td><button type="button" class="btn red" id="hapus" name="hapus"><i class="fa fa-trash"></i> Hapus</button></td>
                                            </tr>
                                            <?php $index++ ?>
                                        @endforeach
                                        </tbody>
                                    </table>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
        var save = '{{route('admin.buku.inreview.savevideo')}}';
        var deleteData = '{{route('admin.buku.inreview.deletevideo')}}';
        var back = '{{route('admin.buku.inreview.video',['id'=>$isibuku->id])}}';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/buku/scripts/video.js" type="text/javascript"></script>
@stop