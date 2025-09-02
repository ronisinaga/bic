@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/kategoridictionary/css/edit.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Kategori Dictionary
                <small>Edit Kategori Dictionary</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Kategori Dictionary</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Kategori Dictionary</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Kategori Dictionary Content
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
                                <span class="caption-subject bold uppercase"> Edit Kategori Dictionary</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="kategoridictionary" name="kategoridictionary" value="{{$kategoridictionary[0]->kategori}}">
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$kategoridictionary[0]->id}}">
                                        <label for="menu">Kategori Dictionary</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="kode" name="kode" value="{{$kategoridictionary[0]->kode}}">
                                        <label for="menu">Kode</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu" class="control-text">Tipe Masukan</label>
                                        <?php $selected = $kategoridictionary[0]->tipe_input=="TEXT"?"selected":""; echo $selected; ?>
                                        <select class="form-control" id="selTipe" name="selTipe">
                                            <option value="TEXT" <?php $selected = $kategoridictionary[0]->tipe_input=="TEXT"?"selected":""; echo $selected; ?>>Text</option>
                                            <option value="IMAGE"> <?php $selected = $kategoridictionary[0]->tipe_input=="IMAGE"?"selected":""; echo $selected; ?>Image</option>
                                            <option value="LINKTEXT" <?php $selected = $kategoridictionary[0]->tipe_input=="LINKTEXT"?"selected":""; echo $selected; ?>>Link Text</option>
                                            <option value="CONTENT" <?php $selected = $kategoridictionary[0]->tipe_input=="CONTENT"?"selected":""; echo $selected; ?>>Content</option>
                                            <option value="ANGKA" <?php $selected = $kategoridictionary[0]->tipe_input=="ANGKA"?"selected":""; echo $selected; ?>>Angka</option>
                                        </select>
                                        <span class="help-block">Harus dipilih*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="keterangan" value="{{$kategoridictionary[0]->keterangan}}">
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
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/kategoridictionary/scripts/edit.js" type="text/javascript"></script>
@stop
