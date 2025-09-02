@extends('jayakari.bic.admin::layouts.default')
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Dashboard
                <small>Juri</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo env('APP_URL'); ?>/admin/home/juri">Awal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Dashboard Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($masukanTeknis) ?>">0</span></div>
                            <div class="desc"> Masukan teknis belum dinilai </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/juri/teknis/belumrespon"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>-->
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$belumnilai}}">0</span></div>
                            <div class="desc"> Proposal belum dinilai </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/juri/proposal/belumnilai"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="{{$sudahnilai}}">0</span>
                            </div>
                            <div class="desc"> Proposal sudah dinilai </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/juri/proposal/sudahnilai"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-4 col-sm-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-body">
                                    <h4><b>Statistik Progress Penilaian Proposal Topik Saya:</b></h4>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Topik </th>
                                            <th> Kode Juri </th>
                                            <th> Total Proposal </th>
                                            <th> Sudah dinilai </th>
                                            <th> Belum dinilai </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $index = 1;
                                        ?>
                                        @foreach($mytopic as $item)
                                            <tr>
                                                <td> {{$index}} </td>
                                                <td><?php echo $item->topic; ?></td>
                                                <td><?php echo $item->juri; ?></td>
                                                <td><?php echo $item->total; ?></td>
                                                <td><?php echo $item->done; ?></td>
                                                <td><?php echo $item->notyet; ?></td>
                                            </tr>
                                            <?php $index++ ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <label style="color: red"><b>Catatan: Warna merah adalah statistik anda</b></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-bubbles font-red"></i>
                                        <span class="caption-subject font-red bold uppercase">Proposal Belum Dinilai</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_comments_1">
                                            <!-- BEGIN: Comments -->
                                            <div class="mt-comments">
                                                <?php
                                                foreach($proposalBelumNilai as $item){
                                                ?>
                                                <div class="mt-comment">
                                                    <div class="mt-comment-img">
                                                        <img src="<?php echo env('APP_URL'); ?>/public/storage/user/small_default.png" /> </div>
                                                    <div class="mt-comment-body">
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author"><?php echo $item->proposal->judul ?></span>
                                                        </div>
                                                        <div class="mt-comment-details">
                                                            <ul class="mt-comment-actions">
                                                                <li>
                                                                    <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $item->id_proposal ?>/6/masuk">View</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <!-- END: Comments -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-body">
                                    <h4><b>Statistik Progress Penilaian Proposal Seluruh Topik:</b></h4>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Topik </th>
                                            <th> Kode Juri </th>
                                            <th> Total Proposal </th>
                                            <th> Sudah dinilai </th>
                                            <th> Belum dinilai </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $index = 1;
                                        ?>
                                        @foreach($alltopics as $item)
                                            <tr>
                                                <td> {{$index}} </td>
                                                <td><?php echo $item->topic; ?></td>
                                                <td><?php echo $item->juri; ?></td>
                                                <td><?php echo $item->total; ?></td>
                                                <td><?php echo $item->done; ?></td>
                                                <td><?php echo $item->notyet; ?></td>
                                            </tr>
                                            <?php $index++ ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <label style="color: red"><b>Catatan: Warna merah adalah statistik anda</b></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-body">
                                    <h4><b>Rincian Daftar Proposal yang dinilai:</b></h4>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Topik </th>
                                            <th> Judul </th>
                                            <th> Total Juri </th>
                                            <th> Sudah dinilai </th>
                                            <th> Belum dinilai </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $index = 1;
                                        ?>
                                        @foreach($juriProposal as $item)
                                            <tr>
                                                <td> {{$index}} </td>
                                                <td> {{$item->topik}}</td>
                                                <td> {{$item->proposal}}</td>
                                                <td> {{$item->jumlah_juri}}</td>
                                                <td> {{$item->sudah_nilai}}</td>
                                                <td> {{$item->belum_nilai}}</td>
                                            </tr>
                                            <?php $index++ ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
@stop