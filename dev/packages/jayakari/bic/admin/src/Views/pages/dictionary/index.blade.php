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
            <h3 class="page-title"> Manajemen Dictionary
                <small>Manajemen dictionary</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Dictionary</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List Dictionary</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Dictionary Content
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
                                <span class="caption-subject bold uppercase"> Daftar Dictionary</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="new" name="new" class="btn sbold green"> Tambah Dictionary
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
                                    <th> No </th>
                                    <th> Kode </th>
                                    <th> Kategori </th>
                                    <th> Value </th>
                                    <th> Keterangan </th>
                                    <th width="150px"> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $id = 1;
                                    foreach($dictionary as $data){
                                        echo '<tr>';
                                        echo '    <td>'.$id.'</td>';
                                        echo '    <td>'.$data->kategoriDictionary->kode.'</td>';
                                        echo '    <td>'.$data->kategoriDictionary->kategori.'</td>';
                                        echo '    <td>';
                                                switch ($data->kategoriDictionary->tipe_input){
                                                    case "TEXT":
                                                        echo $data->isi;
                                                        break;
                                                    case "LINKTEXT":
                                                        echo '<a href="'.$data->public_path.'">'.$data->isi.'</a>';
                                                        break;
                                                    case "IMAGE":
                                                        echo '<a href="'.env('APP_URL').'/admin/dictionary/'.$data->id.'/download">'.$data->isi.'</a>';
                                                        break;
                                                    case "CONTENT":
                                                        echo $data->isi;
                                                        break;
                                                    case "ANGKA":
                                                        echo $data->isi;
                                                        break;
                                                    default:
                                                        echo $data->kategoriDictionary->tipe_input;
                                                        break;
                                                }
                                        echo '    </td>';
                                        echo '    <td>'.$data->keterangan.'</td>';
                                        echo '    <td width="150px">';
                                        echo '        <a href="'.env('APP_URL').'/admin/dictionary/'.$data->id.'/edit" class="btn blue">';
                                        echo '        <i class="fa fa-pencil"></i> Edit </a>';
                                        echo '        <a href="'.env('APP_URL').'/admin/dictionary/'.$data->id.'/delete" class="btn red">';
                                        echo '        <i class="fa fa-trash"></i> Delete </a>';
                                        echo '    </td>';
                                        echo '    </tr>';
                                        $id = $id+1;
                                    }
                                ?>
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/dictionary/scripts/index.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop