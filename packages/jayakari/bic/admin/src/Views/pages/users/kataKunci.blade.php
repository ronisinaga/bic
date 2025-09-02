@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/css/katakunci.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Juri
                <small>Tambah Kategori Juri</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Juri</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Tambah Kategori Juri</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Kategori Juri Content
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
                                <span class="caption-subject bold uppercase"> Tambah Kategori Juri</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" id="frmAddUser" name="frmAddUser">
                                <div class="form-body">
                                    <!--<div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="username">
                                        <label for="email">Username</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>-->
                                    <div class="form-group">
                                        <label for="email">Juri</label>
                                        <input type="text" class="form-control" id="juri" name="juri" value="{{$user[0]->fullname}}" disabled>
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$user[0]->id}}" >
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <select class="form-control" data-placeholder="Pilih kategori juri" id="selKategori" name="selKategori">
                                                    <option value="0"></option>
                                                    @foreach($kataKunci as $item)
                                                        <option value="{{$item->id}}">{{$item->kata_kunci}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn purple" id="tambah" name="tambah"><i class="fa fa-plus"></i> Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        if (count($user[0]->kataKunci) > 0){
                                            echo '<div id="kataKunci" name="kataKunci" style="display:block">';
                                        }else{
                                            echo '<div id="kataKunci" name="kataKunci" style="display:none">';
                                        }
                                    ?>
                                        <table class="table table-striped table-bordered table-hover" id="tblKategori" name="tblKategori">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Juri</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $index=1; ?>
                                            @foreach($user[0]->kataKunci as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>$item->kata_kunci</td>
                                                    <td><button type="button" class="btn red" id="removeKategori" name="removeKategori"><i class="fa fa-remove"></i> Hapus</button></td>
                                                </tr>
                                                <?php $index++ ?>
                                            @endforeach
                                            </tbody>
                                        </table>
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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host= "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/scripts/katakunci.js" type="text/javascript"></script>
@stop
