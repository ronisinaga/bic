@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/arn/css/create.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Assign Proposal
                <small>Assign proposal ke topik</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Assign Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Assign proposal ke topik</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Assign Proposal Content
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
                                <span class="caption-subject bold uppercase"> Assign proposal ke topik</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="menu">Batch</label>
                                        <select class="form-control" id="selBatch" name="selBatch">
                                            <option value="0" selected>-- Pilih Batch --</option>
                                            @foreach($batch as $item)
                                                <option value="{{$item->id}}">{{$item->batch}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus dipilih*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Proposal</label>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <select class="form-control" id="selProposal" name="selProposal">
                                                    <option value="0" selected>-- Pilih Proposal --</option>
                                                    @foreach($proposal as $item)
                                                        <option value="{{$item->id}}">{{$item->judul}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block">Harus dipilih*</span>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn purple" id="btnView" name="btnView" disabled><i class="fa fa-eye"></i> Lihat Proposal</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Topik</label>
                                        <select class="form-control" id="selTnpik" name="selTopik">
                                            <option value="0" selected>-- Pilih Topik --</option>
                                        </select>
                                        <span class="help-block">Harus dipilih*</span>
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
    <!-- popup proposal -->
    <div class="modal fade" id="popupViewProposal" tabindex="-1" name="popupViewProposal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h3 class="modal-title" id="view">Detail Proposal</h3>
                </div>
                <div class="modal-body">
                    <div class="keterangan" id="viewBody">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal"><i class="fa fa-close"></i> Tutup</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('footer_page')
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js,yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/proposalCreate.js" type="text/javascript"></script>
@stop
