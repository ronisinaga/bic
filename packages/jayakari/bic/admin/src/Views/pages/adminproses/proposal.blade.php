@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal
                <small>Daftar proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Daftar Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Daftar Proposal Content
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
                                <span class="caption-subject bold uppercase"> Daftar Proposal</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group">
                                            <button id="new" name="new" class="btn sbold green"> Tambah Proposal
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button id="sebaranProposal" name="sebaranProposal" class="btn purple"> Sebaran Proposal
                                            <i class="fa fa-external-link"></i>
                                        </button>
                                    </div>
                                </div>
                            </div><hr>
                            <table class="table table-striped table-bordered table-hover" id="tblProposal">
                                <thead>
                                <tr>
                                    <th> Batch </th>
                                    <th> Topik </th>
                                    <th> Kode </th>
                                    <th> Proposal </th>
                                    <th width="200px"> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($proposal as $item)
                                    <?php
                                            if (!is_null($item->id_proposal)){
                                    ?>
                                    <tr>
                                        <td>{{$item->topik->batch->batch}}</td>
                                        <td>{{$item->topik->topik}}</td>
                                        <td>{{$item->proposal->id}}</td>
                                        <td><a href="<?php echo  env('APP_URL'); ?>/admin/reviewer/proposal/{{$item->id_proposal}}/6/masuk" id="showDetail" name="showDetail">{{$item->proposal->judul}}</a></td>
                                        <td width="200px">
                                            <a href="<?php echo  env('APP_URL'); ?>/admin/adminproses/proposal/{{$item->id_proposal}}/edit" class="btn blue">
                                                <i class="fa fa-edit"></i> Edit </a>
                                            <a href="<?php echo  env('APP_URL'); ?>/admin/adminproses/proposal/{{$item->id}}/delete" class="btn red">
                                                <i class="fa fa-trash"></i> Delete </a>
                                        </td>
                                    </tr>
                                    <?php
                                            } ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
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
    <div class="modal fade" id="popupViewSebaranProposal" tabindex="-1" name="popupViewSebaranProposal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h3 class="modal-title" id="view">Detail Sebaran Proposal</h3>
                </div>
                <div class="modal-body">
                    <div class="keterangan" id="viewBody">
                        <table class="table table-striped table-bordered table-hover" id="tblSebaranProposal">
                            <thead>
                            <tr>
                                <th> Batch </th>
                                <th> Topik </th>
                                <th> Jumlah Proposal </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($batch as $item)
                                @foreach($item->topik as $data)
                                    <tr>
                                        <td>{{$item->batch}}</td>
                                        <td>{{$data->topik}}</td>
                                        <td><?php echo count($data->topikProposal) ?></td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/proposal.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop