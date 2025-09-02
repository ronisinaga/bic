@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Buku
                <small>Manajemen buku</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Buku</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List Buku</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Buku Content
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
                                <span class="caption-subject bold uppercase"> {{$buku->judul}}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th> No Proposal</th>
                                    <th width="500px"> Proposal </th>
                                    <th width="220px"> Buku </th>
                                    <th width="380px"> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $id = 1;
                                ?>
                                @foreach($proposal as $data)
                                    <tr>
                                        <td> {{$id}} </td>
                                        <td> {{$data->id}} </td>
                                        <td width="500px">{{$data->judul}} </td>
                                        <?php
                                        if ($data->isiBuku == null){
                                            echo '<td width="220px">Belum dibuat</td>';
                                        }else{
                                            echo '<td width="220px">'.$data->isiBuku->judul_singkat.'</td>';
                                        }
                                        ?>
                                        <?php
                                        if ($data->isiBuku == null){
                                            if ($activeCategory == 7 || $activeCategory == 9){
                                                echo '<td><a href="'.route('admin.buku.inreview.buatisibuku',['id_buku'=>$buku->id,'id_proposal'=>$data->id]).'" class="btn blue"><i class="fa fa-plus"></i> Isi Buku </a></td>';
                                            }else{
                                                echo '<td><a href="'.route('admin.buku.inreview.buatisibuku',['id_buku'=>$buku->id,'id_proposal'=>$data->id]).'" class="btn red"><i class="fa fa-view"></i> Isi Buku </a></td>';
                                            }
                                        }else{
                                            if ($activeCategory == 7 || $activeCategory == 9){
                                                echo '<td width="380px">';
                                                echo '<a href="'.route('admin.buku.inreview.editisibuku',['id_isi_buku'=>$data->isiBuku->id]).'" class="btn blue"><i class="fa fa-pencil"></i> Edit </a>';
                                                echo '<a href="'.route('admin.buku.inreview.file',['id_isi_buku'=>$data->isiBuku->id]).'" class="btn green"><i class="fa fa-plus"></i> File </a>';
                                                //echo '<a href="'.env('APP_URL').'/admin/buku/'.$data->isiBuku->id.'/ebook" class="btn yellow"><i class="fa fa-plus"></i> Ebook </a>';
                                                echo '<a href="'.route('admin.buku.inreview.video',['id_isi_buku'=>$data->isiBuku->id]).'" class="btn purple"><i class="fa fa-plus"></i> Video </a>';
                                                //echo '<a href="'.env('APP_URL').'/admin/buku/'.$data->isiBuku->id.'/draft" class="btn red"><i class="fa fa-file"></i> Draft </a>';
                                                echo '</td>';
                                            }else{
                                                echo '<td><a href="'.env('APP_URL').'/admin/buku/'.$data->isiBuku->id.'/editisibuku" class="btn red"><i class="fa fa-view"></i> Isi Buku </a></td>';
                                            }
                                        }
                                        ?>
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
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/buku/scripts/index.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop