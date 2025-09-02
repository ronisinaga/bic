@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/dictionary/css/edit.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Dictionary
                <small>Edit Dictionary</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Dictionary</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Dictionary</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Dictionary Content
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
                                <span class="caption-subject bold uppercase"> Edit Dictionary</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" action="#">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <label for="menu">Kategori Dictionary</label>
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$dictionary[0]->id}}">
                                        <select class="form-control" id="selKategori" name="selKategori">
                                            <option value="0">-- Pilih salah satu --</option>
                                            @foreach($kategoridictionary as $item)
                                                <?php $selected = $item->id == $dictionary[0]->kategoriDictionary->id?"selected":""; ?>
                                                <option value="{{$item->id}}" {{$selected}}>{{$item->kategori}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <?php
                                        $displayText = "none";
                                        $displayImage = "none";
                                        $displayLinkText = "none";
                                        $displayContent = "none";
                                        $displayAngka = "none";
                                        switch ($dictionary[0]->kategoriDictionary->tipe_input){
                                            case "TEXT":
                                                $displayText = "block";
                                                break;
                                            case "IMAGE":
                                                $displayImage = "block";
                                                break;
                                            case "LINKTEXT":
                                                $displayLinkText = "block";
                                                break;
                                            case "CONTENT":
                                                $displayContent = "block";
                                                break;
                                            case "ANGKA":
                                                $displayAngka = "block";
                                                break;
                                        }
                                    ?>
                                    <div class="form-body" id="text" style="display: <?php echo $displayText ?>;">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="value" name="value" value="{{$dictionary[0]->isi}}">
                                            <label for="value">Value</label>
                                            <span class="help-block">Harus diisi*</span>
                                        </div>
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="keterangan" value="{{$dictionary[0]->keterangan}}">
                                            <label for="keterangan">Keterangan</label>
                                        </div>
                                        <div class="form-actions noborder">
                                            <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan"><i class="fa fa-floppy-o"></i> Simpan</button>
                                            <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
                                        </div>
                                    </div>
                                    <div class="form-body" id="angka" style="display: <?php echo $displayAngka ?>;">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="valueAngka" name="valueAngka" value="{{$dictionary[0]->isi}}">
                                            <label for="value">Value</label>
                                            <span class="help-block">Harus diisi*</span>
                                        </div>
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="keteranganAngka" value="{{$dictionary[0]->keterangan}}">
                                            <label for="keterangan">Keterangan</label>
                                        </div>
                                        <div class="form-actions noborder">
                                            <button type="button" class="btn blue" id="btnSimpanAngka" name="btnSimpanAngka"><i class="fa fa-floppy-o"></i> Simpan</button>
                                            <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
                                        </div>
                                    </div>

                                    <div class="form-body" id="content" style="display: <?php echo $displayContent ?>;">
                                        <div class="form-group">
                                            <label for="value">Value</label>
                                            <textarea class="ckeditor form-control" id="valueContent" name="valueContent" rows="5" ></textarea>
                                            <span class="help-block">Harus diisi*</span>
                                        </div>
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="keteranganContent" value="{{$dictionary[0]->keterangan}}">
                                            <label for="keterangan">Keterangan</label>
                                        </div>
                                        <div class="form-actions noborder">
                                            <button type="button" class="btn blue" id="btnSimpanContent" name="btnSimpanContent"><i class="fa fa-floppy-o"></i> Simpan</button>
                                            <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
                                        </div>
                                    </div>

                                    <div class="form-body" id="linktext" style="display: <?php echo $displayLinkText ?>;">
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="valueURL" name="valueURL" value="{{$dictionary[0]->isi}}">
                                            <label for="value">Value</label>
                                            <span class="help-block">Harus diisi*</span>
                                        </div>
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="url" name="url" value="{{$dictionary[0]->public_path}}">
                                            <label for="value">URL</label>
                                            <span class="help-block">Harus diisi*</span>
                                        </div>
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="keteranganLinkText" value="{{$dictionary[0]->keterangan}}">
                                            <label for="keterangan">Keterangan</label>
                                        </div>
                                        <div class="form-actions noborder">
                                            <button type="button" class="btn blue" id="btnSimpanLinkText" name="btnSimpanLinkText"><i class="fa fa-floppy-o"></i> Simpan</button>
                                            <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
                                        </div>
                                    </div>

                                    <div class="form-body" id="image" style="display: <?php echo $displayImage ?>;">
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
                                        </div><br>
                                        <div class="form-group form-md-line-input form-md-floating-label">
                                            <input type="text" class="form-control" id="keteranganImage" value="{{$dictionary[0]->keterangan}}">
                                            <label for="keterangan">Keterangan</label>
                                        </div>
                                        <h4>File</h4>
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                            <tbody>
                                                <tr>
                                                    <td><a href="<?php echo env('APP_URL'); ?>/admin/dictionary/{{$dictionary[0]->id}}/download">{{$dictionary[0]->isi}}</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="form-actions noborder">
                                            <button type="submit" class="btn blue" id="btnSimpanImage" name="btnSimpanImage"><i class="fa fa-floppy-o"></i> Upload</button>
                                            <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
                                        </div>
                                    </div>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('textarea#valueContent').val('<?php echo $dictionary[0]->isi ?>');
    </script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/dictionary/scripts/edit.js" type="text/javascript"></script>
@stop
