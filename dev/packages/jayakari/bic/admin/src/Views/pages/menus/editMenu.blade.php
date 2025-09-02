@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/menus/css/addmenugroup.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Menu
                <small>Tambah Menu</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Menu</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Tambah Menu</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Tambah Menu Content
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
                                <span class="caption-subject bold uppercase"> Tambah Menu</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label" style="margin-right: 10px;">
                                        <select class="form-control" id="selKategori">
                                            <option value="0">-- Pilih Kategori --</option>
                                            @foreach($kategori as $item)
                                                <?php
                                                    $selected = $menu[0]->kategoriMenu->id == $item->id?"selected":"";
                                                ?>
                                                <option value="{{$item->id}}" {{$selected}}>{{$item->kategori}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$menu[0]->id}}">
                                        <label for="selKategori">Kategori Menu</label>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="menu" name="menu" value="{{$menu[0]->menu}}">
                                        <label for="menu">Menu</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group" style="margin-right: 10px;">
                                        <label for="selIcon">Menu Icon</label>
                                        <select class="form-control" data-placeholder="Pilih icon menu" id="selIcon" name="selIcon" style="font-size: 16px">
                                            <option value="" selected></option>
                                        </select>
                                        <span class="help-block">Harus dipilih*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="url" value="{{$menu[0]->url}}">
                                        <label for="url">Url Menu</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="keterangan" value="{{$menu[0]->keterangan}}">
                                        <label for="keterangan">Keterangan</label>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnEdit" name="btnEdit"><i class="fa fa-edit"></i> Update</button>
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
        var selectedicon = "<?php echo $menu[0]->icon; ?>";
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/menus/scripts/editmenu.js" type="text/javascript"></script>
@stop
