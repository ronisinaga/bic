@extends('jayakari.bic.admin::layouts.default')
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
            <h3 class="page-title"> Manajemen Inovator
                <small>List inovator</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Inovator</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Inovator</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Inovator Content
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
                                <span class="caption-subject bold uppercase"> Daftar Inovator</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="new_inovator" class="btn sbold green"> Tambah Inovator
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                            <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Export
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Username </th>
                                    <th> Nama </th>
                                    <th> Email </th>
                                    <th> No HP </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> dragonif01 </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> junjun </td>
                                    <td> Junjun Baju </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> jinjin </td>
                                    <td> Abdul Jinjin </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                <tr>
                                    <td> ronisinga </td>
                                    <td> Roni Sinaga </td>
                                    <td>
                                        <a href="mailto:dragonif01@gmail.com"> dragonif01@gmail.com </a>
                                    </td>
                                    <td> 081322395655 </td>
                                </tr>
                                </tbody>
                            </table>
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/inovators/scripts/actions.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop