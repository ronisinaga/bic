@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal
                <small>Cari Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Cari Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Cari Proposal Content
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
                                <span class="caption-subject bold uppercase"> Cari Proposal</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="modal-body">
                                <div class="row">
                                    <div clas="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="control-label col-md-3">Nomor Proposal</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="nomorProposal" name="nomorProposal" class="form-control"/>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <label class="control-label col-md-3">Nama Inovator</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="namaInovator" class="form-control"/>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <label class="control-label col-md-3">Judul Proposal</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="judulProposal" class="form-control"/>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <label class="control-label col-md-3">Keyword</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="keywordProposal" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div clas="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="control-label col-md-3">Status Proposal</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" id="selStatusProposal" name="selStatusProposal">
                                                        <option value="0">-- All --</option>
                                                        @foreach($proposalStatus as $item)
                                                            <option value="{{$item->id}}">{{$item->status}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="btnCari" name="btnCari"><i class="fa fa-search"></i> Cari</button>
                            </div>
                            <div style="display: block" id="divResult" name="divResult">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet-title">
                                                <div class="caption font-green">
                                                    <i class="icon-pin font-green"></i>
                                                    <span class="caption-subject bold uppercase"> Hasil Pencarian</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="result">
                                    <thead>
                                    <tr>
                                        <th width="20px"> No </th>
                                        <th width="100px"> Inovator </th>
                                        <th width="50px"> Status </th>
                                        <th width="20px"> Proposal# </th>
                                        <th width="400px"> Judul </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/cari.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop