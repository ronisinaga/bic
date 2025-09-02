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
            <h3 class="page-title"> Manajemen Kata Kunci Teknologi
                <small>Manajemen jumlah Kata Kunci Teknologi</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Kata Kunci Teknologi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List Kata Kunci Teknologi</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Kata Kunci Teknologi Content
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
                                <span class="caption-subject bold uppercase"> Daftar Kata Kunci Teknologi</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="new" name="new" class="btn sbold green"> Tambah Kata Kunci Teknologi
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
                                    <th> Type </th>
                                    <th> Level </th>
                                    <th> Level 1 </th>
                                    <th> Level 2 </th>
                                    <th> Level 3 </th>
                                    <th> Kata Kunci Teknologi </th>
                                    <th> Parent </th>
                                    <th width="20%"> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $id = 1;
                                ?>
                                @foreach($katakunciteknologi as $data)
                                    <tr>
                                        <td> {{$id}} </td>
                                        <td>
                                            <?php
                                                echo $data->tipeTeknologi->kode;
                                            ?>

                                        </td>
                                        <td>{{$data->level}} </td>
                                        <td>{{$data->level1}} </td>
                                        <td>{{$data->level2}} </td>
                                        <td>{{$data->level3}} </td>
                                        <td>{{$data->kata_kunci}} </td>
                                        <td>
                                            <?php
                                                $num = count($katakunci);
                                                $found = false;
                                                for($i=0;$i<$num&&!$found;$i++){
                                                    if ($data->parent == $katakunci[$i]->id){
                                                        echo $katakunci[$i]->kata_kunci;
                                                    }
                                                }
                                                if (!$found){
                                                    echo '-';
                                                }
                                            ?>
                                        </td>
                                        <td width="20%">
                                            <a href="<?php echo env('APP_URL'); ?>/admin/katakunci/{{$data->id}}/edit" class="btn blue">
                                                <i class="fa fa-pencil"></i> Edit </a>
                                            <a href="<?php echo env('APP_URL'); ?>/admin/katakunci/{{$data->id}}/delete" class="btn red">
                                                <i class="fa fa-trash"></i> Delete </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $id = $id+1;
                                    ?>
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
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/katakunciteknologi/scripts/index.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop