@extends('sch')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/css/profile.min.css" rel="stylesheet" type="text/css" />
@stop
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
                        <a href="<?php echo env('APP_URL'); ?>/admin/home">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Ubah Password</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Ubah Password Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet bordered">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/layouts/img/hariyanto_salim.png" class="img-responsive" alt=""> </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> Hariyanto Salim </div>
                                <div class="profile-usertitle-job"> Business Owner </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                        </div>
                        <!-- END PORTLET MAIN -->
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">Ubah Avatar</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Ubah Password</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                <form role="form" action="#">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Awal</label>
                                                        <input type="text" placeholder="Hariyanto" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Akhir</label>
                                                        <input type="text" placeholder="Salim" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Hp</label>
                                                        <input type="text" placeholder="0812324343532" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Pekerjaan</label>
                                                        <input type="text" placeholder="Business Owner" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Alamat</label>
                                                        <textarea class="form-control" rows="3" placeholder="Alamat dair Pak Hariyanto Salim"></textarea>
                                                    </div>
                                                    <div class="margiv-top-10">
                                                        <a href="javascript:;" class="btn green"> Simpan </a>
                                                        <a href="javascript:;" class="btn default"> Batal </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                <form action="#" role="form">
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                            <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="..."> </span>
                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <a href="javascript:;" class="btn green"> Simpan </a>
                                                        <a href="javascript:;" class="btn default"> Batal </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <label class="control-label">Password saat ini</label>
                                                        <input type="password" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Password baru</label>
                                                        <input type="password" class="form-control" /> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Ulangi Password baru</label>
                                                        <input type="password" class="form-control" /> </div>
                                                    <div class="margin-top-10">
                                                        <a href="javascript:;" class="btn green"> Ubah Password </a>
                                                        <a href="javascript:;" class="btn default"> Batal </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                            <!-- PRIVACY SETTINGS TAB -->
                                            <div class="tab-pane" id="tab_1_4">
                                                <form action="#">
                                                    <table class="table table-light table-hover">
                                                        <tr>
                                                            <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                            <td>
                                                                <label class="uniform-inline">
                                                                    <input type="radio" name="optionsRadios1" value="option1" /> Yes </label>
                                                                <label class="uniform-inline">
                                                                    <input type="radio" name="optionsRadios1" value="option2" checked/> No </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                            <td>
                                                                <label class="uniform-inline">
                                                                    <input type="checkbox" value="" /> Yes </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                            <td>
                                                                <label class="uniform-inline">
                                                                    <input type="checkbox" value="" /> Yes </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                            <td>
                                                                <label class="uniform-inline">
                                                                    <input type="checkbox" value="" /> Yes </label>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--end profile-settings-->
                                                    <div class="margin-top-10">
                                                        <a href="javascript:;" class="btn red"> Save Changes </a>
                                                        <a href="javascript:;" class="btn default"> Cancel </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PRIVACY SETTINGS TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
@stop
@section('footer_page')
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/scripts/profile.min.js" type="text/javascript"></script>
@stop