@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Message
                <small>Isi message</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo  env('APP_URL'); ?>/admin/home">Message</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Isi message</span>
                    </li>
                </ul>
                <div clasr="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Isi message Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form class="form-horizontal form-without-legend" role="form" action="<?php echo  env('APP_URL'); ?>/admin/home">
                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">Kepada</label>
                            <div class="col-md-8">
                                <label class="control-label"><b>{{$proposalMdssage->receiver}}</b></label>
                                <input type="hidden" id="id" name="id" value="{{$proposalMessage->id}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Judul Pesan</label>
                            <div class="col-md-8">
                                <label class="control-label">{{$proposalMessage->judul}}</label>
                                <input type="hidden" id="judul" name="judul" value="[BIC] Review Proposal - {{$proposalMessage->judul}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Isi Pesan</label>
                            <div class="col-md-10">
                                <div class="keterangan" style="background: #ffffff">
                                    <p style="text-align: justify">
                                        <?php
                                        echo $proposalMessage->isi;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-offset-2 padding-left-0 padding-top-20">
                                <button type="button" class="btn btn-primary" id="kembali" name="kembali"><i class="fa fa-arrow-circle-left"></i> Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
@stop
@section('footer_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/content.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop