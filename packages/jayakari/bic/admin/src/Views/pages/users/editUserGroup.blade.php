@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Kategori Pengguna
                <small>Edit Kategori Pengguna</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Kategori Pengguna</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Kategori Pengguna</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Kategori Pengguna Content
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
                                <span class="caption-subject bold uppercase"> Edit Kategori Pengguna</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="kategori" value="{{$kategori[0]->kategori}}">
                                        <input type="hidden" class="form-control" id="id" value="{{$kategori[0]->id}}">
                                        <label for="kategori">Group Pengguna</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Hak Akses</label>
                                        <div class="checkbox-list" id="checkboxes" name="checkboxes">
                                            @foreach($kategoriMenu as $item)
                                                <?php
                                                    $found = false;
                                                    $num = count($kategori[0]->kategoriMenu);
                                                    for($i=0;$i<$num&&!$found;$i++){
                                                        if ($item->id == $kategori[0]->kategoriMenu[$i]->id){
                                                            $found = true;
                                                        }
                                                    }
                                                    if ($found){
                                                ?>
                                                <label>
                                                    <input type="checkbox" id="kategoriMenu" name="kategoriMenu" value="{{$item->id}}" checked> {{$item->kategori}}
                                                </label>
                                                <?php
                                                        }else{
                                                ?>
                                                <label>
                                                    <input type="checkbox" id="kategoriMenu" name="kategoriMenu" value="{{$item->id}}"> {{$item->kategori}}
                                                </label>
                                                <?php
                                                        }
                                                ?>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="keterangan" value="{{$kategori[0]->keterangan}}">
                                        <label for="keterangan">Keterangan</label>
                                        <span class="help-block">Harus diisi*</span>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host= "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/scripts/editusergroup.js" type="text/javascript"></script>
@stop
