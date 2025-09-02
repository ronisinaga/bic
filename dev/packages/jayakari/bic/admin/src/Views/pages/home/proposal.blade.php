@extends('jayakari.bic.admin::layouts.default')
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Dashboard
                <small>Dashboard Admin Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo env('APP_URL'); ?>/admin/home/proposal">Awal</a>
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
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($sudahreview); ?>">0</span>
                            </div>
                            <div class="desc"> Proposal sudah review </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/adminproses/proposal/sudahreview"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($seleksi); ?>"></span> </div>
                            <div class="desc"> Proposal diseleksi </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/adminproses/proposal/seleksi"> Lihat Detail
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
                                <span data-counter="counterup" data-value="<?php echo count($disimpan); ?>"></span> </div>
                            <div class="desc"> Proposal disimpan </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/adminproses/proposal/disimpan"> Lihat Detail
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
                                <span data-counter="counterup" data-value="<?php echo count($pemenangTahunLalu); ?>"></span> </div>
                            <div class="desc"> Proposal diterima </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/adminproses/proposal/diterima"> Lihat Detail
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
                                <span data-counter="counterup" data-value="<?php echo count($ditolak); ?>"></span> </div>
                            <div class="desc"> Proposal ditolak </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/adminproses/proposal/ditolak"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="<?php echo count($diterima); ?>"></span> </div>
                            <div class="desc"> Total Proposal Diterima  </div>
                        </div>
                        <a class="more" href="<?php echo env('APP_URL'); ?>/admin/adminproses/proposal/totalditerima"> Lihat Detail
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
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
                                        for($i=0;$i<$num;$i++){
                                        ?>
                                        <div class="mt-comment">
                                            <div class="mt-comment-img">
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage/user/small_default.png" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $message[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($message[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/adminproses/message/inbox/<?php echo $message[$i]->id ?>">View</a>
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
                                                <img src="<?php echo env('APP_URL'); ?>/public/storage/user/small_default.png ?>" /> </div>
                                            <div class="mt-comment-body">
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author"><?php echo $message[$i]->judul ?></span>
                                                    <span class="mt-comment-date"><?php $day = new DateTime($message[$i]->tgl_pembuatan); echo $day->format('d M Y H:i:s') ?></span>
                                                </div>
                                                <div class="mt-comment-details">
                                                    <span class="mt-comment-status mt-comment-status-pending"></span>
                                                    <ul class="mt-comment-actions">
                                                        <li>
                                                            <a href="<?php echo env('APP_URL'); ?>/admin/adminproses/message/inbox/<?php echo $message[$i]->id ?>">View</a>
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
                <div class="col-md-4 col-sm-4">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class=" icon-social-twitter font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Daftar Proposal seleksi</span>
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
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
@stop