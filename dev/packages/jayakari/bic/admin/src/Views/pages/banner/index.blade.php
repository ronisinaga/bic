@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/banner/css/add.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Banner
                <small>Daftar banner</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Banner</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Daftar Banner</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Daftar Banner Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-green">
                                <i class="icon-pin font-green"></i>
                                <span class="caption-subject bold uppercase"> Daftar Banner</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                                        <label for="form_control_1">Keterangan Banner</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Gambar</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                        <span class="fileinput-new"> Pilih file </span>
                                                        <span class="fileinput-exists"> Ubah </span>
                                                        <input type="file" name="gambar" id="gambar"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class=" icon-layers font-green"></i>
                                                        <span class="caption-subject font-green bold uppercase">Daftar Banner</span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="mt-element-card mt-element-overlay">
                                                        <?php
                                                        $num = count($banner);
                                                        if ($num == 0){
                                                            echo 'Belum ada data banner';
                                                        }else{
                                                            for($i=0;$i<$num;$i=$i+4){
                                                                echo '<div class="row">';
                                                                echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
                                                                echo '<div class="mt-card-item">';
                                                                echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                echo '<img src="'.env('APP_URL').'/public/storage/'.$banner[$i]->path.'" />';
                                                                echo '<div class="mt-overlay">';
                                                                echo '<ul class="mt-info">';
                                                                echo '<li>';
                                                                echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$banner[$i]->path.'"><i class="icon-magnifier"></i></a>';
                                                                echo '</li>';
                                                                echo '<li>';
                                                                echo '<a class="btn default remove" href="javascript:;" value="'.$banner[$i]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                echo '</li>';
                                                                echo '<li>';
                                                                echo '<a class="btn default edit" href="javascript:;" value="'.$banner[$i]->id.'" id="edit" name="edit"><i class="fa fa-edit"></i></a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '<div class="mt-card-content">';
                                                                $active = $banner[$i]->is_active==0?"(Tidak Aktif)":"";
                                                                echo '<p class="mt-card-desc font-grey-mint">'.$banner[$i]->keterangan.' '.$active.'</p>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                if ($num > $i+1){
                                                                    echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$banner[$i+1]->path.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$banner[$i+1]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$banner[$i+1]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default edit" href="javascript:;" value="'.$banner[$i+1]->id.'" id="edit" name="edit"><i class="fa fa-edit"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    $active = $banner[$i+1]->is_active==0?"(Tidak Aktif)":"";
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$banner[$i+1]->keterangan.' '.$active.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+2){
                                                                    echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$banner[$i+2]->path.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$banner[$i+2]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$banner[$i+2]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default edit" href="javascript:;" value="'.$banner[$i+2]->id.'" id="edit" name="edit"><i class="fa fa-edit"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    $active = $banner[$i+2]->is_active==0?"(Tidak Aktif)":"";
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$banner[$i+2]->keterangan.' '.$active.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+3){
                                                                    echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$banner[$i+3]->path.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$banner[$i+3]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$banner[$i+3]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default edit" href="javascript:;" value="'.$banner[$i+3]->id.'" id="edit" name="edit"><i class="fa fa-edit"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    $active = $banner[$i+3]->is_active==0?"(Tidak Aktif)":"";
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$banner[$i+3]->keterangan.' '.$active.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                /*if ($num > $i+4){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$banner[$i+4]->path.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$banner[$i+4]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$banner[$i+4]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$banner[$i+4]->keterangan.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+5){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$banner[$i+5]->path.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$banner[$i+5]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$banner[$i+5]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$banner[$i+5]->keterangan.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }*/
                                                                echo '</div>';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="submit" class="btn blue" id="btnSimpan" name="btnSimpan">Simpan</button>
                                    <button type="button" class="btn default" id="btnBatal" name="btnBatal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor492/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/banner/scripts/index.js" type="text/javascript"></script>
@stop