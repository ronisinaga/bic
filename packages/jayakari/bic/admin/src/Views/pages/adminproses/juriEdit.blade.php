@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/arn/css/create.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Ubah Data Assign Juri
                <small>Ubah data assign juri ke topik</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Ubah Data Assign Juri</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Ubah data assign juri ke topik</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Ubah Juri Content
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
                                <span class="caption-subject bold uppercase"> Assign juri ke topik</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="menu">Batch</label>
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$topikJuri->id}}" />
                                        <select class="form-control" id="selBatch" name="selBatch">
                                            <option value="0" selected>-- Pilih Batch --</option>
                                            @foreach($batch as $item)
                                                <?php $selected = $topikJuri->topik->id_batch == $item->id?"selected":"" ?>
                                                <option value="{{$item->id}}" {{$selected}}>{{$item->batch}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus dipilih*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Topik</label>
                                        <select class="form-control" id="selTopik" name="selTopik">
                                            <option value="0" selected>-- Pilih Topik --</option>
                                            <?php
                                                $num = count($batch);
                                                $found = false;
                                                for($i=0;$i<$num&&!$found;$i++){
                                                    if ($batch[$i]->id == $topikJuri->topik->id_batch){
                                                        $found = true;
                                                        foreach($batch[$i]->topik as $item){
                                                            $selected = $topikJuri->id_topik == $item->id?"selected":"";
                                                            echo '<option value="'.$item->id.'" '.$selected.'>'.$item->topik.'</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <span class="help-block">Harus dipilih*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Juri</label>
                                        <select class="form-control" id="selJuri" name="selJuri">
                                            <option value="0" selected>-- Pilih Juri --</option>
                                            @foreach($juri as $item)
                                                <?php $selected = $topikJuri->id_juri == $item->id?"selected":"" ?>
                                                <option value="{{$item->id}}" {{$selected}}>{{$item->fullname}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus dipilih*</span>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan"><i class="fa fa-floppy-o"></i> Simpan</button>
                                    <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
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
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/juriEdit.js" type="text/javascript"></script>
@stop
