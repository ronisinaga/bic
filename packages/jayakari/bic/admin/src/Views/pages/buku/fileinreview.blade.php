@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/isibuku/css/add.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen File
                <small>File buku</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen File</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>File buku</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> File buku Content
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
                                <span class="caption-subject bold uppercase"> File buku</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{$isibuku->judul_singkat}}" disabled>
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$isibuku->id}}">
                                        <label for="form_control_1">Judul Singkat</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="form_control_1">Keterangan File</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">File</label>
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
                                                        <span class="caption-subject font-green bold uppercase">Daftar File</span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="mt-element-card mt-element-overlay">
                                                        <?php
                                                        $num = count($isibuku->file);
                                                        if ($num == 0){
                                                            echo '<div class="row">';
                                                            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                                                            echo 'Belum ada gambar untuk proposal inreview ini';
                                                            echo '<div>';
                                                            echo '<div>';
                                                        }else{
                                                            for($i=0;$i<$num;$i=$i+6){
                                                                echo '<div class="row">';
                                                                echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                echo '<div class="mt-card-item">';
                                                                echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                $files = explode('.',$isibuku->file[$i]->file);
                                                                if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i]->path.'"/>';
                                                                }else if (strtolower($files[count($files)-1]) == 'pdf'){
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                                }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                                    echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                }
                                                                echo '<div class="mt-overlay">';
                                                                echo '<ul class="mt-info">';
                                                                echo '<li>';
                                                                echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/admin/buku/'.$isibuku->file[$i]->id.'/download"><i class="fa fa-download"></i></a>';
                                                                echo '</li>';
                                                                echo '<li>';
                                                                echo '<a class="btn default remove" href="javascript:;" value="'.$isibuku->file[$i]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '<div class="mt-card-content">';
                                                                $keterangan = '';
                                                                if ($isibuku->file[$i]->keterangan == ''){
                                                                    $keterangan = $isibuku->file[$i]->file;
                                                                }else{
                                                                    $keterangan = $isibuku->file[$i]->keterangan;
                                                                }
                                                                echo '<p class="mt-card-desc font-grey-mint">'.$keterangan.'</p>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                if ($num > $i+1){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    $files = explode('.',$isibuku->file[$i+1]->file);
                                                                    if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+1]->path.'"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'pdf'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/admin/buku/'.$isibuku->file[$i+1]->id.'/download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$isibuku->file[$i+1]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    $keterangan = '';
                                                                    if ($isibuku->file[$i+1]->keterangan == ''){
                                                                        $keterangan = $isibuku->file[$i+1]->file;
                                                                    }else{
                                                                        $keterangan = $isibuku->file[$i+1]->keterangan;
                                                                    }
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$keterangan.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+2){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    $files = explode('.',$isibuku->file[$i+2]->file);
                                                                    if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+2]->path.'"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'pdf'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/admin/buku/'.$isibuku->file[$i+2]->id.'/download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$isibuku->file[$i+2]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    $keterangan = '';
                                                                    if ($isibuku->file[$i+2]->keterangan == ''){
                                                                        $keterangan = $isibuku->file[$i+2]->file;
                                                                    }else{
                                                                        $keterangan = $isibuku->file[$i+2]->keterangan;
                                                                    }
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$keterangan.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+3){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    $files = explode('.',$isibuku->file[$i+3]->file);
                                                                    if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+3]->path.'"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'pdf'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/admin/buku/'.$isibuku->file[$i+3]->id.'/download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$isibuku->file[$i+3]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    $keterangan = '';
                                                                    if ($isibuku->file[$i+3]->keterangan == ''){
                                                                        $keterangan = $isibuku->file[$i+3]->file;
                                                                    }else{
                                                                        $keterangan = $isibuku->file[$i+3]->keterangan;
                                                                    }
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$keterangan.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+4){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    $files = explode('.',$isibuku->file[$i+4]->file);
                                                                    if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+4]->path.'"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'pdf'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/admin/buku/'.$isibuku->file[$i+4]->id.'/download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$isibuku->file[$i+4]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    $keterangan = '';
                                                                    if ($isibuku->file[$i+4]->keterangan == ''){
                                                                        $keterangan = $isibuku->file[$i+4]->file;
                                                                    }else{
                                                                        $keterangan = $isibuku->file[$i+4]->keterangan;
                                                                    }
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$keterangan.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+5){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    $files = explode('.',$isibuku->file[$i+5]->file);
                                                                    if (strtolower($files[count($files)-1]) == 'jpg' || strtolower($files[count($files)-1]) == 'jpeg' || strtolower($files[count($files)-1]) == 'png' || strtolower($files[count($files)-1]) == 'bmp' || strtolower($files[count($files)-1]) == 'gif'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$isibuku->file[$i+5]->path.'"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'pdf'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'doc' || strtolower($files[count($files)-1]) == 'docx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png"/>';
                                                                    }else if (strtolower($files[count($files)-1]) == 'xls' || strtolower($files[count($files)-1]) == 'xlsx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                    }else if (strtolower($files[count($files)-1]) == 'ppt' || strtolower($files[count($files)-1]) == 'pptx'){
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default btn-outline" href="'.env('APP_URL').'/admin/buku/'.$isibuku->file[$i+5]->id.'/download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$isibuku->file[$i+5]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '<div class="mt-card-content">';
                                                                    $keterangan = '';
                                                                    if ($isibuku->file[$i+5]->keterangan == ''){
                                                                        $keterangan = $isibuku->file[$i+5]->file;
                                                                    }else{
                                                                        $keterangan = $isibuku->file[$i+5]->keterangan;
                                                                    }
                                                                    echo '<p class="mt-card-desc font-grey-mint">'.$keterangan.'</p>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
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
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
        var save = '{{route('admin.buku.inreview.savefile')}}';
        var back = '{{route('admin.buku.inreview.file',['id'=>$isibuku->id])}}';
        var remove = '{{route('admin.buku.inreview.deletefile')}}';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/buku/scripts/file.js" type="text/javascript"></script>
@stop