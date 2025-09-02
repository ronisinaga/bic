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
            <h3 class="page-title"> Manajemen Perkembangan Proposal
                <small>Perkembangan Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Perkembangan Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Perkembangan Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Perkembangan Proposal Content
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
                                <span class="caption-subject bold uppercase"> Perkembangan Proposal</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{$proposal->judul}}" disabled>
                                        <input type="hidden" class="form-control" id="id_proposal" name="id_proposal" value="{{$proposal->id}}">
                                        @if($video <> null)
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{$video->id}}">
                                        @else
                                            <input type="hidden" class="form-control" id="id" name="id" value="0">
                                        @endif
                                        <label for="form_control_1">Judul Proposal</label>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        @if($video <> null)
                                            <input type="text" class="form-control" id="video" name="video" value="{{$video->video_id}}">
                                        @else
                                            <input type="text" class="form-control" id="video" name="video">
                                        @endif
                                        <label for="form_control_1">Video Youtube ID</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Deskripsi</label>
                                        @if($video <> null)
                                            <textarea class="form-control"  id="description" name="description" rows="6"><?php echo $video->description;?></textarea>
                                        @else
                                            <textarea class="form-control"  id="description" name="description" rows="6"></textarea>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class=" icon-layers font-green"></i>
                                                        <span class="caption-subject font-green bold uppercase">Daftar Video</span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <?php
                                                    $num = count($proposal->videoPemenang);
                                                    if ($num == 0){
                                                        echo '<div class="note note-success">';
                                                        echo '<p>Belum ada video inovasi untuk proposal ini</p>';
                                                        echo '<div>';
                                                    }else{
                                                        echo '<table class="table table-striped table-bordered table-hover" id="tblResult" name="tblResult">';
                                                        echo '<thead>';
                                                        echo '<tr>';
                                                        echo '<td>No</td>';
                                                        echo '<td>Video ID</td>';
                                                        echo '<td>Deskripsi</td>';
                                                        echo '<td>Aksi</td>';
                                                        echo '</tr>';
                                                        echo '</thead>';
                                                        echo '<tbody>';
                                                        $index = 1;
                                                        for($i=0;$i<$num;$i++){
                                                            echo '<tr>';
                                                            echo '<td>'.$index.'</td>';
                                                            echo '<td>'.$proposal->videoPemenang[$i]->video_id.'</td>';
                                                            echo '<td>'.$proposal->videoPemenang[$i]->description.'</td>';
                                                            echo '<td>';
                                                            echo '<a class="btn btn-outline blue" href="'.route('inovator.pemenang.administrasi.video.edit',['id_proposal'=>$proposal->id,'id'=>$proposal->videoPemenang[$i]->id]).'" value="'.$proposal->videoPemenang[$i]->id.'" id="edit" name="edit"><i class="fa fa-edit"></i> Edit</a>&nbsp;';
                                                            echo '<a class="btn btn-outline red remove" href="javascript:;" value="'.$proposal->videoPemenang[$i]->id.'" id="hapus" name="hapus"><i class="fa fa-trash"></i> Hapus</a>';
                                                            echo '</td>';
                                                            echo '</tr>';
                                                            $index++;
                                                        }
                                                        echo '</tbody>';
                                                        echo '</table>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan">Simpan</button>
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
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
        var save = '{{route('inovator.pemenang.administrasi.video.update')}}';
        var back = '{{route('inovator.pemenang.administrasi.video.edit',['id_proposal'=>$proposal->id,'id'=>0])}}';
        var remove = '{{route('inovator.pemenang.administrasi.video.remove')}}';
        var mainback = '{{route('inovator.pemenang.administrasi.video')}}';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/inovators/scripts/videoEdit.js" type="text/javascript"></script>
@stop