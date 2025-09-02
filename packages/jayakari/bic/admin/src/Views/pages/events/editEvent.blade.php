@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Kegiatan
                <small>Edit kegiatan</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Kegiatan</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Kegiatan</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Kegiatan Content
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
                                <span class="caption-subject bold uppercase"> Edit Kegiatan</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="form_control_1" value="Ini judul kegiatan 1">
                                        <label for="form_control_1">Judul Kegiatan</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Tanggal Mulai</label>
                                        <div class="col-md-10">
                                            <div class="input-group input-medium date date-picker" data-date-format="dd-M-yyyy" data-date-start-date="+0d">
                                                <input type="text" class="form-control" readonly value="13-Jan-2018">
                                                <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                            </div>
                                            <!-- /input-group -->
                                            <span class="help-block"> Select date </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Tanggal Akhir</label>
                                        <div class="col-md-10">
                                            <div class="input-group input-medium date date-picker" data-date-format="dd-M-yyyy" data-date-start-date="+0d">
                                                <input type="text" class="form-control" readonly value="15-Jan-2018">
                                                <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                            </div>
                                            <!-- /input-group -->
                                            <span class="help-block"> Select date </span>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <label for="form_control_1">Keterangan Kegiatan</label>
                                        <textarea class="ckeditor form-control" name="editor1" rows="6" id="form_control_1">
                                            <p>Ini adalah keterangan dari kegiatan 1</p>
                                        </textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan">Simpan</button>
                                    <button type="button" class="btn default" id="btnBatal" name="btnBatal">Batal</button>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/events/scripts/addevent.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/clockface/js/clockface.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
@stop
