@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Pengguna
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
                                <img src="<?php echo env('APP_URL'); ?>/public/storage/{{$datauser[0]->public_path}}/{{$datauser[0]->file}}" class="img-responsive" alt=""> </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">{{$datauser[0]->fullname}}</div>
                                <div class="profile-usertitle-job"> Inovator </div>
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
                                                        <label class="control-label">Nama</label>
                                                        <input type="text" placeholder="Nama" id="fullname" name="fullname" class="form-control" value="{{$datauser[0]->fullname}}"/>
                                                        <input type="hidden" id="id" name="id" value="{{$datauser[0]->id}}"/>
                                                        <input type="hidden" id="nickname_origin" name="nickname_origin" value="{{$datauser[0]->nickname}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nickname</label>
                                                        <input type="text" placeholder="Nama" id="nickname" name="nickname" class="form-control" value="{{$datauser[0]->nickname}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jk">Jenis Kelamin</label>
                                                        <select class="form-control" data-placeholder="Pilih jenis kelamin" id="selJK" name="selJK">
                                                            <option value="" selected></option>
                                                            <option value="Pria" <?php $selected=$datauser[0]->jk == "Pria"?"selected":""; echo $selected; ?>>Pria</option>
                                                            <option value="Wanita" <?php $selected=$datauser[0]->jk == "Wanita"?"selected":""; echo $selected; ?>>Wanita</option>
                                                        </select>
                                                        <span class="help-block">Harus diisi*</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Telp/HP</label>
                                                        <input type="text" placeholder="0812324343532" id="hp" name="hp" class="form-control"  value="{{$datauser[0]->hp}}"/> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" placeholder="Business Owner" id="email" name="email" class="form-control"  value="{{$datauser[0]->email}}"/> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Alamat</label>
                                                        <textarea class="form-control" rows="2" id="alamat" name="alamat" placeholder="Alamat Anda">{{$datauser[0]->alamat}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">{{$labels["TAR"]}}: </label>
                                                        <textarea class="form-control" rows="3" id="alasan" name="alasan" placeholder="Alasan bergabung dengan BIC">{{$datauser[0]->alasan}}</textarea>
                                                    </div>
                                                    <div class="margiv-top-10">
                                                        <a href="javascript:;" class="btn blue" id="kirim" name="kirim"><i class="fa fa-send"></i> Simpan </a>
                                                        <!--<a href="javascript:;" class="btn default" id="batal" name="batal"><i class="fa fa-remove"></i>  Batal </a>-->
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                <form action="#" role="form">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-2">Pilih File</label>
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="input-group">
                                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                            <span class="fileinput-filename"> </span>
                                                                        </div>
                                                                        <span class="input-group-addon btn default btn-file">
                                                                            <span class="fileinput-new"> Select file </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="files" id="files"> </span>
                                                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <button class="btn blue" type="submit" id="upload" name="update"><i class="fa fa-send"></i> Upload </button>
                                                        <!--<a href="javascript:;" class="btn default"><i class="fa fa-remove"></i> Batal </a>-->
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <div class="form-group">
                                                    <label class="control-label">Password baru</label>
                                                    <input type="password" class="form-control" id="password" name="password" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Ulangi Password baru</label>
                                                    <input type="password" class="form-control" id="retype" name="retype" /> </div>
                                                <div class="margin-top-10">
                                                    <button id="ubah" name="ubah" class="btn blue"><i class="fa fa-send"></i> Ubah Password </button>
                                                    <!--<a href="javascript:;" class="btn default"><i class="fa fa-close"></i> Batal </a>-->
                                                </div>
                                            </div>
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
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/scripts/profile.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@stop