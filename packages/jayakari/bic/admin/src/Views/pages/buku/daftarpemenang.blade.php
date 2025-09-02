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
                                    <th> Kode </th>
                                    <th> Proposal </th>
                                    <th> Nama </th>
                                    <th> Email </th>
                                    <th> Telp </th>
                                    <th> Tim </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $id = 1;
                                        $num = count($proposal);
                                        for($i=0;$i<$num;$i++){
                                            echo '<tr>';
                                            echo '<td>'.$id.'</td>';
                                            echo '<td>'.$proposal[$i]->id.'</td>';
                                            echo '<td>'.$proposal[$i]->judul.'</td>';
                                            echo '<td>'.$proposal[$i]->user->fullname.'</td>';
                                            $tim = '';
                                            $total = count($inovasiMember[$i]);
                                            $hp = '';
                                            $email = '';
                                            for($j=0;$j<$total;$j++){
                                                if ($j == $total-1){
                                                    $hp .= $inovasiMember[$i][$j]->telp.' ('.$inovasiMember[$i][$j]->jabatan.')';
                                                    $email .= $inovasiMember[$i][$j]->email.' ('.$inovasiMember[$i][$j]->jabatan.')';
                                                    $tim .= $inovasiMember[$i][$j]->name.' ('.$inovasiMember[$i][$j]->jabatan.')';
                                                }else{
                                                    $tim .= $inovasiMember[$i][$j]->name.' ('.$inovasiMember[$i][$j]->jabatan.')'.'<br>';
                                                    $hp .= $inovasiMember[$i][$j]->telp.' ('.$inovasiMember[$i][$j]->jabatan.')'.'<br>';
                                                    $email .= $inovasiMember[$i][$j]->email.' ('.$inovasiMember[$i][$j]->jabatan.')'.'<br>';
                                                }
                                            }
                                            echo '<td><b>'.$proposal[$i]->user->email.' (Uploader)</b><br>'.$email.'</td>';
                                            echo '<td><b>'.$proposal[$i]->user->hp.' (Uploader)</b><br>'.$hp.'</td>';
                                            echo '<td>'.$tim.'</td>';
                                            echo '</tr>';
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