@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/news/css/add.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen File Proposal
                <small>File Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen File Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>File Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> File Proposal Content
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
                                <span class="caption-subject bold uppercase"> File Proposal</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{$proposal->judul}}" disabled>
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$proposal->id}}">
                                        <label for="form_control_1">Judul Proposal</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Deskripsi</label>
                                        <textarea class="form-control"  id="description" name="description" rows="6"></textarea>
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
                                                        <input type="file" name="file" id="file"> </span>
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
                                                        $num = count($proposal->filePemenang);
                                                        if ($num == 0){
                                                            echo '<div class="row">';
                                                            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                                                            echo 'Belum ada file untuk proposal ini';
                                                            echo '<div>';
                                                            echo '<div>';
                                                        }else{
                                                            for($i=0;$i<$num;$i=$i+6){
                                                                echo '<div class="row">';
                                                                echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                echo '<div class="mt-card-item">';
                                                                echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                $arrFiles = explode('.',$proposal->filePemenang[$i]->name);
                                                                switch ($arrFiles[1]){
                                                                    case 'jpg':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'JPG':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'jpeg':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'JPEG':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'png':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'PNG':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'bmp':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'BMP':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'tiff':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'TIFF':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'gif':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'GIF':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i]->path.'" />';
                                                                        break;
                                                                    case 'pdf':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                        break;
                                                                    case 'doc':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                        break;
                                                                    case 'docx':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                        break;
                                                                    case 'xls':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                        break;
                                                                    case 'xlsx':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                        break;
                                                                    case 'ppt':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                        break;
                                                                    case 'pptx':
                                                                        echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                        break;
                                                                }
                                                                echo '<div class="mt-overlay">';
                                                                echo '<ul class="mt-info">';
                                                                echo '<li>';
                                                                echo '<a class="btn default download" href="'.route('inovator.pemenang.file.download',['id'=>$proposal->filePemenang[$i]->id]).'" value="'.$proposal->filePemenang[$i]->id.'" id="download" name="download"><i class="fa fa-download"></i></a>';
                                                                echo '</li>';
                                                                echo '<li>';
                                                                echo '<a class="btn default remove" href="javascript:;" value="'.$proposal->filePemenang[$i]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                                if ($num > $i+1){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    $arrFiles = explode('.',$proposal->filePemenang[$i+1]->name);
                                                                    switch ($arrFiles[1]){
                                                                        case 'jpg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'JPG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'jpeg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'JPEG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'png':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'PNG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'bmp':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'BMP':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'tiff':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'TIFF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'gif':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'GIF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+1]->path.'" />';
                                                                            break;
                                                                        case 'pdf':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                            break;
                                                                        case 'doc':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'docx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'xls':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'xlsx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'ppt':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                        case 'pptx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default download" href="'.route('inovator.pemenang.file.download',['id'=>$proposal->filePemenang[$i+1]->id]).'" value="'.$proposal->filePemenang[$i+1]->id.'" id="download" name="download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$proposal->filePemenang[$i+1]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
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
                                                                    $arrFiles = explode('.',$proposal->filePemenang[$i+2]->name);
                                                                    switch ($arrFiles[1]){
                                                                        case 'jpg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'JPG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'jpeg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'JPEG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'png':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'PNG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'bmp':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'BMP':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'tiff':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'TIFF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'gif':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'GIF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+2]->path.'" />';
                                                                            break;
                                                                        case 'pdf':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                            break;
                                                                        case 'doc':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'docx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'xls':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'xlsx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'ppt':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                        case 'pptx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default download" href="'.route('inovator.pemenang.file.download',['id'=>$proposal->filePemenang[$i+2]->id]).'" value="'.$proposal->filePemenang[$i+2]->id.'" id="download" name="download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$proposal->filePemenang[$i+2]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
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
                                                                    $arrFiles = explode('.',$proposal->filePemenang[$i+3]->name);
                                                                    switch ($arrFiles[1]){
                                                                        case 'jpg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'JPG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'jpeg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'JPEG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'png':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'PNG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'bmp':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'BMP':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'tiff':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'TIFF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'gif':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'GIF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+3]->path.'" />';
                                                                            break;
                                                                        case 'pdf':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                            break;
                                                                        case 'doc':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'docx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'xls':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'xlsx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'ppt':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                        case 'pptx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default download" href="'.route('inovator.pemenang.file.download',['id'=>$proposal->filePemenang[$i+3]->id]).'" value="'.$proposal->filePemenang[$i+3]->id.'" id="download" name="download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$proposal->filePemenang[$i+3]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                    echo '</div>';
                                                                }
                                                                if ($num > $i+4){
                                                                    echo '<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">';
                                                                    echo '<div class="mt-card-item">';
                                                                    echo '<div class="mt-card-avatar mt-overlay-1">';
                                                                    $arrFiles = explode('.',$proposal->filePemenang[$i+4]->name);
                                                                    switch ($arrFiles[1]){
                                                                        case 'jpg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'JPG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'jpeg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'JPEG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'png':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'PNG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'bmp':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'BMP':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'tiff':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'TIFF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'gif':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'GIF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+4]->path.'" />';
                                                                            break;
                                                                        case 'pdf':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                            break;
                                                                        case 'doc':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'docx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'xls':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'xlsx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'ppt':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                        case 'pptx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default download" href="'.route('inovator.pemenang.file.download',['id'=>$proposal->filePemenang[$i+4]->id]).'" value="'.$proposal->filePemenang[$i+4]->id.'" id="download" name="download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$proposal->filePemenang[$i+4]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
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
                                                                    $arrFiles = explode('.',$proposal->filePemenang[$i+5]->name);
                                                                    switch ($arrFiles[1]){
                                                                        case 'jpg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'JPG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'jpeg':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'JPEG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'png':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'PNG':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'bmp':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'BMP':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'tiff':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'TIFF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'gif':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'GIF':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/'.$proposal->filePemenang[$i+5]->path.'" />';
                                                                            break;
                                                                        case 'pdf':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/pdf.png" />';
                                                                            break;
                                                                        case 'doc':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'docx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/word.png" />';
                                                                            break;
                                                                        case 'xls':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'xlsx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/excel.png" />';
                                                                            break;
                                                                        case 'ppt':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                        case 'pptx':
                                                                            echo '<img src="'.env('APP_URL').'/public/storage/buku/powerpoint.png" />';
                                                                            break;
                                                                    }
                                                                    echo '<div class="mt-overlay">';
                                                                    echo '<ul class="mt-info">';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default download" href="'.route('inovator.pemenang.administrasi.file.download',['id'=>$proposal->filePemenang[$i+5]->id]).'" value="'.$proposal->filePemenang[$i+5]->id.'" id="download" name="download"><i class="fa fa-download"></i></a>';
                                                                    echo '</li>';
                                                                    echo '<li>';
                                                                    echo '<a class="btn default remove" href="javascript:;" value="'.$proposal->filePemenang[$i+5]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i></a>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                    echo '</div>';
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
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
        var save = '{{route('inovator.pemenang.administrasi.file.update')}}';
        var back = '{{route('inovator.pemenang.administrasi.file.edit',['id'=>$proposal->id])}}';
        var remove = '{{route('inovator.pemenang.administrasi.file.remove')}}';
        var mainback = '{{route('inovator.pemenang.administrasi.file')}}';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/inovators/scripts/fileEdit.js" type="text/javascript"></script>
@stop