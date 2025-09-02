@extends('jayakari.bic.admin::layouts.default')
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Dashboard
                <small>Dashboard Reviewer</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo env('APP_URL'); ?>/admin/home/reviewer">Awal</a>
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
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($baru); ?>">0</span>
                            </div>
                            <div class="desc"> Proposal Baru </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/masuk"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($revisi); ?>"></span> </div>
                            <div class="desc"> Proposal revisi </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/revisi"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($batal); ?>"></span> </div>
                            <div class="desc"> Proposal Batal </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/batal"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($belumreview); ?>">0</span></div>
                            <div class="desc"> Proposal belum review </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/belumreview"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="dashboard-stat default">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($sudahreview); ?>">0</span>
                            </div>
                            <div class="desc"> Proposal sudah review </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/sudahreview"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="dashboard-stat yellow">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($seleksi); ?>"></span> </div>
                            <div class="desc"> Proposal diseleksi </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/seleksi"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>

                <!--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="dashboard-stat yellow">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($diterima); ?>"></span> </div>
                            <div class="desc"> Proposal diterima </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/diterima"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>-->
                <!--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($ditolak); ?>"></span> </div>
                            <div class="desc"> Proposal ditolak </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/ditolak"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>-->
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Daftar message terbaru</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                            $num = count($message);
                                            if ($num == 0){
                                                echo '<div class="mt-comment">Kosong</div>';
                                            }else{
                                                if ($num <= 5){
                                                    //print_r($message);
                                                    for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $message[$i]->user->public_path ?>/<?php echo $message[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $message[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($message[$i]->inserted_date); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/message/inbox/<?php echo $message[$i]->id ?>">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                    }
                                                }else{
                                                    for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $message[$i]->user->public_path ?>/<?php echo $message[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $message[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($message[$i]->inserted_date); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/message/inbox/<?php echo $message[$i]->id ?>">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                    <!-- END: Comments -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class=" icon-social-twitter font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Daftar proposal baru</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                            $num = count($baru);
                                            if ($num <= 5){
                                                for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $baru[$i]->user->public_path ?>/<?php echo $baru[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $baru[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($baru[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $baru[$i]->id ?>/2/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                            }else{
                                                for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $baru[$i]->user->public_path ?>/<?php echo $baru[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $baru[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($baru[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $baru[$i]->id ?>/2/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <!-- END: Comments -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Daftar Proposal revisi</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                        $num = count($revisi);
                                        if ($num == 0){
                                            echo '<div class="mt-comment">Kosong</div>';
                                        }else{
                                        if ($num <= 5){
                                        for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $revisi[$i]->user->public_path ?>/<?php echo $revisi[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $revisi[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($revisi[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $revisi[$i]->id ?>/4/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        }else{
                                        for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $revisi[$i]->user->public_path ?>/<?php echo $revisi[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $revisi[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($revisi[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $revisi[$i]->id ?>/4/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        }
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
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Daftar Proposal Listed</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                        $num = count($disimpan);
                                        if ($num == 0){
                                            echo '<div class="mt-comment">Kosong</div>';
                                        }else{
                                        if ($num <= 5){
                                        for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $disimpan[$i]->user->public_path ?>/<?php echo $disimpan[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $disimpan[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($disimpan[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $disimpan[$i]->id ?>/7/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        }else{
                                        for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $disimpan[$i]->user->public_path ?>/<?php echo $disimpan[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $disimpan[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($disimpan[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $disimpan[$i]->id ?>/7/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        }
                                        }
                                        ?>
                                    </div>
                                    <!-- END: Comments -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class=" icon-social-twitter font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Daftar Proposal belum review</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                        $num = count($belumreview);
                                            if ($num == 0){
                                                echo '<div class="mt-comment">Kosong</div>';
                                            }else{
                                                if ($num <= 5){
                                                    for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $belumreview[$i]->user->public_path ?>/<?php echo $belumreview[$i]->user->small_file ?>" />
                                            </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $belumreview[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($belumreview[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $belumreview[$i]->id ?>/3/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                                }else{
                                                    for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $belumreview[$i]->user->public_path ?>/<?php echo $belumreview[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $belumreview[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($belumreview[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $belumreview[$i]->id ?>/3/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                    <!-- END: Comments -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class=" icon-social-twitter font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Daftar Proposal sudah review</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                            $num = count($sudahreview);
                                            if ($num == 0){
                                                echo '<div class="mt-comment">Kosong</div>';
                                            }else{
                                                if ($num <= 5){
                                                    for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $sudahreview[$i]->user->public_path ?>/<?php echo $sudahreview[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $sudahreview[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($sudahreview[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $sudahreview[$i]->id ?>/5/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                    }
                                                }else{
                                                    for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $sudahreview[$i]->user->public_path ?>/<?php echo $sudahreview[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $sudahreview[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($sudahreview[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $sudahreview[$i]->id ?>/5/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                    }
                                                }
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
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Daftar Proposal diseleksi</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                        $num = count($seleksi);
                                        if ($num == 0){
                                            echo '<div class="mt-comment">Kosong</div>';
                                        }else{
                                        if ($num <= 5){
                                        for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $seleksi[$i]->user->public_path ?>/<?php echo $seleksi[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $seleksi[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($seleksi[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $seleksi[$i]->id ?>/6/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        }else{
                                        for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $seleksi[$i]->user->public_path ?>/<?php echo $seleksi[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $seleksi[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($seleksi[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $seleksi[$i]->id ?>/6/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        }
                                        }
                                        ?>
                                    </div>
                                    <!-- END: Comments -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Daftar Proposal diterima</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <div class="mt-comments">
                                        <?php
                                        $num = count($diterima);
                                        if ($num == 0){
                                            echo '<div class="mt-comment">Kosong</div>';
                                        }else{
                                            if ($num <= 5){
                                                for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $diterima[$i]->user->public_path ?>/<?php echo $diterima[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $diterima[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($diterima[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $diterima[$i]->id ?>/8/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                            }else{
                                                for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $diterima[$i]->user->public_path ?>/<?php echo $diterima[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $diterima[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($diterima[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $diterima[$i]->id ?>/8/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Daftar Proposal ditolak</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <div class="mt-comments">
                                        <?php
                                        $num = count($ditolak);
                                        if ($num == 0){
                                            echo '<div class="mt-comment">Kosong</div>';
                                        }else{
                                            if ($num <= 5){
                                                for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $ditolak[$i]->user->public_path ?>/<?php echo $ditolak[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $ditolak[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($ditolak[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $ditolak[$i]->id ?>/9/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                            }else{
                                                for($i=0;$i<5;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage<?php echo $ditolak[$i]->user->public_path ?>/<?php echo $ditolak[$i]->user->small_file ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $ditolak[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($ditolak[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/reviewer/proposal/<?php echo $ditolak[$i]->id ?>/9/masuk">View</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
@stop