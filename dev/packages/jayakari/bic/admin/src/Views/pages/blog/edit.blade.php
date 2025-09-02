@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/blog/css/add.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Blog
                <small>Edit berita</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Blog</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Blog</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Blog Content
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
                                <span class="caption-subject bold uppercase"> Edit Blog</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{$blog->judul}}">
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$blog->id}}">
                                        <label for="form_control_1">Judul Blog</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <?php $date = new DateTime($blog->tanggal); ?>
                                    <div class="form-group">
                                        <label for="menu">Tanggal</label>
                                        <div class="input-group input-medium date date-picker" data-date-format="dd-M-yyyy">
                                            <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{$date->format('d-M-Y')}}" readonly>
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <span class="help-block">Pilih tanggal*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <label for="form_control_1">Isi Blog</label>
                                        <textarea class="form-control" name="isi" rows="6" id="isi"><?php echo $blog->isi; ?></textarea>
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
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            @if(count($blog->image) > 0)
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$blog->image[0]->keterangan}}"/>
                                            @else
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" value=""/>
                                            @endif
                                            <label for="form_control_1">Keterangan Gambar</label>
                                            <span class="help-block">Harus diisi*</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class=" icon-layers font-green"></i>
                                                        <span class="caption-subject font-green bold uppercase">Daftar Gambar</span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="mt-element-card mt-element-overlay">
                                                        <?php
                                                        $num = count($blog->image);
                                                        if ($num == 0){
                                                            echo 'Belum ada gambar untuk berita ini';
                                                        }else{
                                                            for($i=0;$i<$num;$i=$i+6){
                                                                echo '<div class="row">';
                                                                echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                echo '<div class="mt-card-item">';
                                                                echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                echo '<img src="'.env('APP_URL').'/public/storage/'.$blog->image[$i]->path.'" />';
                                                                echo '<div class="mt-overlay">';
                                                                echo '<ul class="mt-info">';
                                                                echo '<li>';
                                                                echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$blog->image[$i]->path.'"><i class="icon-magnifier"></i></a>';
                                                                echo '</li>';
                                                                echo '<li>';
                                                                echo '<a class="btn default remove" href="javascript:;" value="'.$blog->image[$i]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                /*if ($num > $i+1){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/blog/'.$blog->image[$i+1]->file300x300.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$blog->image[$i+1]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$blog->image[$i+1]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+2){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/blog/'.$blog->image[$i+2]->file300x300.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$blog->image[$i+2]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$blog->image[$i+2]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+3){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/blog/'.$blog->image[$i+3]->file300x300.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$blog->image[$i+3]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$blog->image[$i+3]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$blog->image[$i+3]->catatan.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+4){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/blog/'.$blog->image[$i+4]->file300x300.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$blog->image[$i+4]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$blog->image[$i+4]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+5){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/blog/'.$blog->image[$i+5]->file300x300.'" />';
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/public/storage/'.$blog->image[$i+5]->path.'"><i class="icon-magnifier"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$blog->image[$i+5]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
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
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/blog/scripts/edit.js" type="text/javascript"></script>
@stop