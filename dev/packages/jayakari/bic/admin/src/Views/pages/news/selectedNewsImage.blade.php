@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Berita
                <small>Tambah gambar-gambar berita</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Berita</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Tambah Gambar - Gambar Berita</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Tambah Gambar-Gambar Berita Content
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
                                <span class="caption-subject bold uppercase"> Tambah Gambar-Gambar Berita</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <label for="form_control_1">Judul berita: </label>
                                        <label id="form_control_1">Ini judul berita 1</label>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <form id="fileupload" action="../assets/global/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
                                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                            <div class="row fileupload-buttonbar">
                                                <div class="col-lg-7">
                                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                                    <span class="btn green fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span> Add files... </span>
                                            <input type="file" name="files[]" multiple=""> </span>
                                                    <button type="submit" class="btn blue start">
                                                        <i class="fa fa-upload"></i>
                                                        <span> Start upload </span>
                                                    </button>
                                                    <button type="reset" class="btn warning cancel">
                                                        <i class="fa fa-ban-circle"></i>
                                                        <span> Cancel upload </span>
                                                    </button>
                                                    <button type="button" class="btn red delete">
                                                        <i class="fa fa-trash"></i>
                                                        <span> Delete </span>
                                                    </button>
                                                    <input type="checkbox" class="toggle">
                                                    <!-- The global file processing state -->
                                                    <span class="fileupload-process"> </span>
                                                </div>
                                                <!-- The global progress information -->
                                                <div class="col-lg-5 fileupload-progress fade">
                                                    <!-- The global progress bar -->
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                                                    </div>
                                                    <!-- The extended global progress information -->
                                                    <div class="progress-extended"> &nbsp; </div>
                                                </div>
                                            </div>
                                            <!-- The table listing the files available for upload/download -->
                                            <table role="presentation" class="table table-striped clearfix">
                                                <tbody class="files"> </tbody>
                                            </table>
                                        </form>
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/news/scripts/addnews.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/scripts/form-fileupload.min.js" type="text/javascript"></script>
@stop
