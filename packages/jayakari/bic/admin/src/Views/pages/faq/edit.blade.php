@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/faq/css/edit.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen ARN
                <small>Tambah ARN</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Frequently Ask Question</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edi Frequently Ask Question</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Frequently Ask Question Content
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
                                <span class="caption-subject bold uppercase"> Edit Frequently Ask Question</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <input type="hidden" id="id" name="id" value="{{$faq->id}}">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <label for="menu">Kategori FAQ</label>
                                        <select class="form-control" id="selFAQType" name="selFAQType">
                                            <option value="0">Pilih Kategori FAQ</option>
                                            <option value="Inovasi Indonesia" {{$faq->faq_type == 'Inovasi Indonesia'?"selected":""}}>Inovasi Indonesia</option>
                                            <option value="Inovator Indonesia" {{$faq->faq_type == 'Inovator Indonesia'?"selected":""}}>Inovator Indonesia</option>
                                            <option value="Proposal Inovasi" {{$faq->faq_type == 'Proposal Inovasi'?"selected":""}}>Proposal Inovasi</option>
                                            <option value="E-Incubator BIC" {{$faq->faq_type == 'E-Incubator BIC'?"selected":""}}>E-Incubator BIC</option>
                                        </select>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="question" name="question" value="{{$faq->question}}">
                                        <label for="menu">Pertanyaan</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <label for="keterangan">Jawaban</label>
                                        <textarea rows="8" id="answer" name="answer" class="ckeditor form-control"><?php echo $faq->answer; ?></textarea>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
        var update = '{{route('admin.faq.update')}}';
        var back = '{{route('admin.faq')}}';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/faq/scripts/edit.js" type="text/javascript"></script>
@stop
