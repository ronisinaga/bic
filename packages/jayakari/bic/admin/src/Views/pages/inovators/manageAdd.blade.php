@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Penjelasan Proposal
                <small>Penjelasan proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Penjelasan Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Daftar Penjelasan Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Penjelasan Proposal
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
                                <span class="caption-subject bold uppercase"> Daftar Penjelasan Proposal</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <input type="hidden" id="explanation" name="explanation" value="{{json_encode($explanation)}}"/>
                            <form role="form">
                                <div class="form-body" id="naratif" name="naratif" style="display: block">
                                    <div class="portlet box red">
                                        <div class="portlet-title">
                                            <div class="caption">Tipe Proposal</div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control" id="selProposalType" name="selProposalType">
                                                        <option value="0">Pilih Tipe Proposal</option>
                                                        <option value="laboratorium">Skala Laboraorium</option>
                                                        <option value="lapangan">Uji Lapangan</option>
                                                        <option value="ekonomi">Kelayakan Ekonomi/Siap Diterapkan</option>
                                                        <option value="komersil">Telah Dikomersialkan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="divData" name="divData" style="display: none">
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption">Highlight/Penjelasan Proposal</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea class="ckeditor form-control" id="highlight" name="highlight" rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet box yellow">
                                            <div class="portlet-title">
                                                <div class="caption">Judul Proposal</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="text" id="title" name="title" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet box blue">
                                            <div class="portlet-title">
                                                <div class="caption">Abstrak</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea class="ckeditor form-control" id="abstrak" name="abstrak" rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet box green">
                                            <div class="portlet-title">
                                                <div class="caption">Deskripsi</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea class="ckeditor form-control" id="deskripsi" name="deskripsi" rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet box purple">
                                            <div class="portlet-title">
                                                <div class="caption">Keunggulan Teknologi</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea class="ckeditor form-control" id="teknologi" name="teknologi" rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet box yellow">
                                            <div class="portlet-title">
                                                <div class="caption">Potensi Aplikasi</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea class="ckeditor form-control" id="aplikasi" name="aplikasi" rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="save" name="save"><i class="fa fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
        judul = "Judul proposal harus diisi";
        proposal_type = "Tipe Proposal harus dipilih";
        highlight = "Highlight/Penjelasan proposal harus diisi";
        abstrak = "Abstrak harus diisi";
        deskripsi = "Deskripsi harus diisi";
        keunggulan_teknologi = "Keunggulan teknologi harus diisi";
        potensi_aplikasi = "Potensi aplikasi harus diisi";
        CKEDITOR.replace( 'highlight', {
            customConfig: '/assets/ckeditor/custom/highlight.js'
        });
        CKEDITOR.replace( 'abstrak', {
            customConfig: '/assets/ckeditor/custom/abstrak.js'
        });
        CKEDITOR.replace( 'deskripsi', {
            customConfig: '/assets/ckeditor/custom/deskripsi.js'
        });
        CKEDITOR.replace( 'teknologi', {
            customConfig: '/assets/ckeditor/custom/teknologi.js'
        });
        CKEDITOR.replace( 'aplikasi', {
            customConfig: '/assets/ckeditor/custom/aplikasi.js'
        });
    </script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/inovators/scripts/manage.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop