@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/css/assigncategory.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">Assign Kategori Pengguna
                <small>Assign kategori pengguna</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Inovator</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Assign Kategori Pengguna</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">Assign Kategori Pengguna Content
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
                                <span class="caption-subject bold uppercase">Assign Kategori Pengguna</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" id="frmAddUser" name="frmAddUser">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="alamat">Pengguna</label>
                                        <input type="text" class="form-control" disabled id="inovator" value="{{$user[0]->fullname}}"/>
                                        <input type="hidden" class="form-control" disabled id="id" value="{{$user[0]->id}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Kategori Pengguna</label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <select class="form-control" data-placeholder="Kategori Pengguna" id="selKategori" name="selKategori">
                                                    <option value="0" selected></option>
                                                    @foreach($kategori as $item)
                                                        <option value="{{$item->id}}">{{$item->kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn green" id="add" name="add"><i class="fa fa-plus"></i> Tambah</button>
                                            </div>
                                        </div>

                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Kategori Pengguna</label>
                                        <table class="table table-striped table-bordered table-hover" id="kategori">
                                            <thead>
                                            <tr>
                                                <th> No </th>
                                                <th style="display: none"> ID </th>
                                                <th> Kategori Pengguna </th>
                                                <th> Aksi </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $index = 1;
                                            ?>
                                            @foreach($user[0]->userCategory as $item)
                                                <tr>
                                                    <td> {{$index}} </td>
                                                    <td style="display: none"> {{$item->id}} </td>
                                                    <td> {{$item->kategori}} </td>
                                                    <td width="20%">
                                                        <button type="button" class="btn red" id="remove" name="remove"><i class="fa fa-remove"></i> Hapus</button>
                                                    </td>
                                                </tr>
                                                <?php
                                                $index = $index+1;
                                                ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan"><i class="fa fa-toggle-off"></i> Assign Pengguna</button>
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/users/scripts/assigncategory.js" type="text/javascript"></script>
@stop
