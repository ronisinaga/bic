@extends('jayakari.bic.admin::layouts.default')
@section('content')
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <h3 class="page-title"> Dashboard
                    <small>dashboard & statistics</small>
                </h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="<?php echo env('APP_URL'); ?>/admin/home">Awal</a>
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
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat blue">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{count($users)}}">0</span>
                                </div>
                                <div class="desc"> Total Inovator </div>
                            </div>
                            <a class="more" href="javascript:;"> &nbsp;
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat red">
                            <div class="visual">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{count($totalProposal)}}">0</span></div>
                                <div class="desc"> Total Proposal masuk </div>
                            </div>
                            <a class="more" href="javascript:;"> &nbsp;
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat green">
                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{count($batal)}}">0</span>
                                </div>
                                <div class="desc"> Proposal Batal </div>
                            </div>
                            <a class="more" href="javascript:;"> &nbsp;
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat purple">
                            <div class="visual">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="{{count($ditolak)}}"></span> </div>
                                <div class="desc"> Proposal Discontinued </div>
                            </div>
                            <a class="more" href="javascript:;"> &nbsp;
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->
                <!--<div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green"></i>
                                    <span class="caption-subject font-green bold uppercase">Daftar Pengunjung Situs</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <label class="btn red btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" id="option1">Umum</label>
                                        <label class="btn red btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">Member</label>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="site_statistics_loading">
                                    <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/layouts/img/loading.gif" alt="loading" /> </div>
                                <div id="site_statistics_content" class="display-none">
                                    <div id="site_statistics" class="chart"> </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-share font-red-sunglo hide"></i>
                                    <span class="caption-subject font-red-sunglo bold uppercase">Proposal</span>
                                    <span class="caption-helper">Statistik Perbulan</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="site_activities_loading">
                                    <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                                <div id="site_activities_content" class="display-none">
                                    <div id="site_activities" style="height: 228px;"> </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>-->
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
@stop