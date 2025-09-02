@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/katakunciteknologi/css/edit.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Kata Kunci Teknologi
                <small>Tambah Kata Kunci Teknologi</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Kata Kunci Teknologi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Kata Kunci Teknologi</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Kata Kunci Teknologi Content
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
                                <span class="caption-subject bold uppercase"> Edit Kata Kunci Teknologi</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <label for="menu">Type</label>
                                        <select class="form-control" data-placeholder="Pilih tipe teknologi" id="selType" name="selType">
                                            <option value=""></option>
                                            @foreach($tipeteknologi as $item)
                                                <?php
                                                    if ($katakunciteknologi[0]->type == $item->id){
                                                        echo '<option value="'.$item->id.'" selected>'.$item->kode.'('.$item->tipe_teknologi.')</option>';
                                                    }else{
                                                        echo '<option value="'.$item->id.'">'.$item->kode.'('.$item->tipe_teknologi.')</option>';
                                                    }
                                                ?>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <label for="menu">Level</label>
                                        <select class="form-control" id="selLevel" name="selLevel" data-placeholder="Pilih Level">
                                            <option value=""></option>
                                            <option value="Level 1" <?php $selected = $katakunciteknologi[0]->level == "Level 1"?"selected":""; echo $selected; ?>>Level 1</option>
                                            <option value="Level 2" <?php $selected = $katakunciteknologi[0]->level == "Level 2"?"selected":""; echo $selected; ?>>Level 2</option>
                                            <option value="Level 3" <?php $selected = $katakunciteknologi[0]->level == "Level 3"?"selected":""; echo $selected; ?>>Level 3</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="level1" name="level1" value="{{$katakunciteknologi[0]->level1}}">
                                        <label for="menu">Level 1</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="level2" name="level2" value="{{$katakunciteknologi[0]->level2}}">
                                        <label for="menu">Level 2</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="level3" name="level3" value="{{$katakunciteknologi[0]->level3}}">
                                        <label for="menu">Level 3</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="katakunciteknologi" name="katakunciteknologi" value="{{$katakunciteknologi[0]->kata_kunci}}">
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$katakunciteknologi[0]->id}}">
                                        <label for="menu">Kata Kunci Teknologi</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="selKategori">Parent</label>
                                        <select class="form-control" data-placeholder="Pilih parent dari kata kunci teknologi" id="selParent">
                                            <option value="0">-- Tidak Ada --</option>
                                            @foreach($katakunci as $item)
                                                <?php
                                                $selected = $katakunciteknologi[0]->parent == $item->id?"selected":"";
                                                ?>
                                                <option value="{{$item->id}}" {{$selected}}>{{$item->kata_kunci}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$katakunciteknologi[0]->id}}">
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="keterangan" value="{{$katakunciteknologi[0]->keterangan}}">
                                        <label for="keterangan">Keterangan</label>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan"><i class="fa fa-edit"></i> Update</button>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/katakunciteknologi/scripts/edit.js" type="text/javascript"></script>
@stop
