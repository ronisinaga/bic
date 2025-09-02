@extends('sch')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Pengguna
                <small>Cari Pengguna</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Pengguna</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Cari Pengguna</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Cari Pengguna Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="form_control_1">
                                        <label for="form_control_1">Nama Pengguna</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="form_control_1">
                                        <label for="form_control_1">Username</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue">Cari</button>
                                    <button type="button" class="btn default">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <h2>Hasil Pencarian</h2><hr>
                                </div>
                                <div class="form-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Username </th>
                                            <th> Nama </th>
                                            <th> Email </th>
                                            <th> No Telp </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td> 1 </td>
                                            <td> dragonif01 </td>
                                            <td> Roni Sinaga </td>
                                            <td>
                                                <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                            </td>
                                            <td> 081322395655 </td>
                                        </tr>
                                        <tr>
                                            <td> 2 </td>
                                            <td> dragonif01 </td>
                                            <td> Roni Sinaga </td>
                                            <td>
                                                <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                            </td>
                                            <td> 081322395655 </td>
                                        </tr>
                                        <tr>
                                            <td> 3 </td>
                                            <td> dragonif01 </td>
                                            <td> Roni Sinaga </td>
                                            <td>
                                                <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                            </td>
                                            <td> 081322395655 </td>
                                        </tr>
                                        <tr>
                                            <td> 4 </td>
                                            <td> dragonif01 </td>
                                            <td> Roni Sinaga </td>
                                            <td>
                                                <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                            </td>
                                            <td> 081322395655 </td>
                                        </tr>
                                        <tr>
                                            <td> 5 </td>
                                            <td> dragonif01 </td>
                                            <td> Roni Sinaga </td>
                                            <td>
                                                <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                            </td>
                                            <td> 081322395655 </td>
                                        </tr>
                                        <tr>
                                            <td> 6 </td>
                                            <td> dragonif01 </td>
                                            <td> Roni Sinaga </td>
                                            <td>
                                                <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                            </td>
                                            <td> 081322395655 </td>
                                        </tr>
                                        <tr>
                                            <td> 7 </td>
                                            <td> dragonif01 </td>
                                            <td> Roni Sinaga </td>
                                            <td>
                                                <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                            </td>
                                            <td> 081322395655 </td>
                                        </tr>
                                        <tr>
                                            <td> 8 </td>
                                            <td> dragonif01 </td>
                                            <td> Roni Sinaga </td>
                                            <td>
                                                <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                            </td>
                                            <td> 081322395655 </td>
                                        </tr>
                                        </tbody>
                                    </table>
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        var host= "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/scripts/actions.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop
