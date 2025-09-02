@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="processing"></div>
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
                                <span class="caption-subject bold uppercase"> Daftar Inovator</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="javascript:;" id="download" name="download"><img src="{{env("APP_URL")}}/public/storage/icon/excel.png"/></a>
                                </div>
                            </div><br>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th style="display: none"> ID User </th>
                                    <th> Kode </th>
                                    <th> Judul </th>
                                    <th> Instansi </th>
                                    <th> Nama </th>
                                    <th> Email </th>
                                    <th> Telp </th>
                                    <th> Status</th>
                                    <th style="display: none"></th>
                                    <th width="300px"> Note </th>
                                    <th> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $id = 1;
                                        $num = count($proposal);
                                        for($i=0;$i<$num;$i++){
                                            $total = count($proposal[$i]->member);
                                            for($j=0;$j<$total;$j++){
                                                echo '<tr>';
                                                echo '<td>'.$id.'</td>';
                                                echo '<td style="display: none">'.$proposal[$i]->member[$j]->id.'</td>';
                                                echo '<td>'.$proposal[$i]->id.'</td>';
                                                echo '<td>'.$proposal[$i]->judul.'</td>';
                                                echo '<td>'.$proposal[$i]->member[$j]->institusi.'</td>';
                                                echo '<td>'.$proposal[$i]->member[$j]->name.'</td>';
                                                echo '<td>'.$proposal[$i]->member[$j]->email.'</td>';
                                                echo '<td>'.$proposal[$i]->member[$j]->telp.'</td>';
                                                echo '<td>'.$proposal[$i]->statusProposal->status.'</td>';
                                                echo '<td style="display: none">member</td>';
                                                $note = '';
                                                if ($proposal[$i]->member[$j]->note <> null){
                                                    $note .= $proposal[$i]->member[$j]->note.'<br>';
                                                    $date = new DateTime($proposal[$i]->member[$j]->note_updated_date);
                                                    $note .= $date->format('d M Y').' | '.$proposal[$i]->member[$j]->noteUpdatedBy->fullname;
                                                }
                                                echo '<td width="500px">'.$note.'</td>';
                                                echo '<td><a href="'.route('admin.blast.daftar.inovator.edit',['type'=>'member','id'=>$proposal[$i]->member[$j]->id]).'" class="btn blue" target="_blank"><i class="fa fa-pencil-square-o"></i> Edit</a></td>';
                                                echo '</tr>';
                                                $id++;
                                            }
                                            //$id = $id+1;
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
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/buku/scripts/daftarInovator.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop