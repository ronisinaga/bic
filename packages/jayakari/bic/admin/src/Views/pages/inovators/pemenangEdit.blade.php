@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/arn/css/edit.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal Pemenang
                <small>Edit Proposal Pemenang</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal Pemenang</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Proposal Pemenang</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Proposal Pemenang Content
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
                                <span class="caption-subject bold uppercase"> Edit Proposal Pemenang</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$proposal->id}}">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="menu">Abstrak</label>
                                        <textarea class="ckeditor form-control"  id="abstrak" name="abstrak" rows="6" value="{{$proposal->abstrak}}"><?php echo $proposal->abstrak ?></textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Deskripsi</label>
                                        <textarea class="ckeditor form-control"  id="deskripsi" name="deskripsi" rows="6" value="{{$proposal->deskripsi}}"><?php echo $proposal->deskripsi ?></textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keunggulan Teknologi</label>
                                        <textarea class="ckeditor form-control"  id="keunggulan_teknologi" name="keunggulan_teknologi" rows="6" value="{{$proposal->keunggulan_teknologi}}"><?php echo $proposal->keunggulan_teknologi ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Potensi Aplikasi</label>
                                        <textarea class="ckeditor form-control"  id="potensi_aplikasi" name="potensi_aplikasi" rows="6" value="{{$proposal->potensi_aplikasi}}"><?php echo $proposal->potensi_aplikasi ?></textarea>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan"><i class="fa fa-edit"></i> Update</button>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
        var save = '{{route('inovator.pemenang.update')}}';
        var back = '{{route('inovator.pemenang')}}';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/inovators/scripts/pemenangEdit.js" type="text/javascript"></script>
@stop
