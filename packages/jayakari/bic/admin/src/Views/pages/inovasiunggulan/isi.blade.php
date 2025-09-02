@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Inovasi Unggulan
                <small>Isi Inovasi Unggulan</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Inovasi Unggulan</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List Isi Inovasi Unggulan</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Inovasi Unggulan Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light ">

                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <input type="hidden" id="id" name="id" value="{{$inovasiunggulan->id}}"/>
                                <span class="caption-subject bold uppercase">Tema: {{$inovasiunggulan->tema}}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php
                                if (count($inovasiunggulan->isi) == 0){
                                    echo 'Belum ada';
                                }else{
                            ?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Tema </th>
                                    <th> Judul Singkat </th>
                                    <th> Short Title </th>
                                    <th> Judul Lengkap </th>
                                    <th style="display:none"> ID </th>
                                    <th> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $id = 1;
                                ?>
                                @foreach($inovasiunggulan->isi as $data)
                                    <tr>
                                        <td> {{$id}} </td>
                                        <td>{{$inovasiunggulan->tema}} </td>
                                        <td>{{$data->isiBuku->judul_singkat}} </td>
                                        <td>{{$data->isiBuku->short_title}} </td>
                                        <td>{{$data->isiBuku->judul_lengkap}} </td>
                                        <td style="display: none">{{$data->id}} </td>
                                        <td>
                                            <a href="<?php echo env('APP_URL'); ?>/admin/inovasi/unggulan/isi/{{$data->id}}/hapus" class="btn red">
                                                <i class="fa fa-trash"></i> Hapus </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $id = $id+1;
                                    ?>
                                @endforeach
                                </tbody>
                            </table>
                            <?php   }   ?>
                        </div><hr>
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <span class="caption-subject bold uppercase">Form Pencarian</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="menu">Agenda Riset Nasional</label>
                                        <select class="form-control" id="selARN" name="selARN">
                                            <option value="0" selected>Pilih Agenda Riset Nasional</option>
                                            @foreach($arn as $item)
                                                <option value="{{$item->id}}">ARN : {{$item->arn}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Kategori Teknologi (Berdasarkan IRC)</label>
                                        <select class="form-control" name="selIRC" id="selIRC" multiple="multiple" size="11">
                                            @foreach($irc as $item)
                                                <option value="{{$item->id}}">{{$item->kata_kunci}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Kategori Aplikasi (Berdasarkan IRC)</label>
                                        <select class="form-control" name="selAplikasi" id="selAplikasi" multiple="multiple" size="9">
                                            @foreach($aplikasi as $item)
                                                <option value="{{$item->id}}">{{$item->kata_kunci}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul_singkat" name="judul_singkat">
                                        <label for="menu">Judul Singkat</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="short_title" name="short_title">
                                        <label for="menu">Short Title (English)</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul_lengkap" name="judul_lengkap">
                                        <label for="menu">Judul Teknis Lengkap</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="keyword" name="keyword">
                                        <label for="menu">Keyword</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Status Paten</label>
                                        <select class="form-control" name="selStatusPaten" id="selStatusPaten">
                                            <option value="0">-- Pilih Status Patent --</option>
                                            <option value="1">Telah Terdaftar</option>
                                            <option value="2">Dalam Proses Pengajuan</option>
                                            <option value="3">Belum Didaftarkan</option>
                                            <option value="4">Tidak Ingin Didaftarkan</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Kesiapan Inovasi</label>
                                        <select class="form-control" name="selKesiapanInovasi" id="selKesiapanInovasi">
                                            <option value="0">-- Pilih Kesiapan Inovasi --</option>
                                            <option value="1">*** Telah Dikomersialkan</option>
                                            <option value="2">** Siap Dikomersialkan</option>
                                            <option value="3">* Prototype</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Kerjasama Bisnis</label>
                                        <select class="form-control" name="selKerjasamaBisnis" id="selKerjasamaBisnis">
                                            <option value="0">-- Pilih Kerjasama Bisnis --</option>
                                            <option value="1">*** Terbuka</option>
                                            <option value="2">** Luas</option>
                                            <option value="3">* Terbatas</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Peringkat Inovasi</label>
                                        <select class="form-control" name="selPeringkatInovasi" id="selPeringkatInovasi">
                                            <option value="0">-- Pilih Peringkat Inovasi--</option>
                                            <option value="1">*** Paling Prospektif</option>
                                            <option value="2">** Sangat Prospektif</option>
                                            <option value="3">* Prospektif</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnCari" name="btnCari"><i class="fa fa-search"></i> Cari</button>
                                </div>
                            </form>
                        </div><hr>
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <span class="caption-subject bold uppercase">Hasil Pencarian</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="result" name="result">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Judul Singkat </th>
                                    <th> Short Title </th>
                                    <th> Judul Lengkap </th>
                                    <th style="display: none"> Deskripsi Singkat </th>
                                    <th style="display: none"> Short Description </th>
                                    <th style="display: none"> Perspektif </th>
                                    <th style="display: none"> Keunggulan Inovasi </th>
                                    <th style="display: none"> Potensi Aplikasi </th>
                                    <th style="display: none"> Inovator </th>
                                    <th style="display: none"> Institusi </th>
                                    <th style="display: none"> Paten </th>
                                    <th style="display: none"> Kesiapan Inovasi </th>
                                    <th style="display: none"> Kerjasama Bisnis </th>
                                    <th style="display: none"> Peringkat Inovasi </th>
                                    <th style="display: none"> ID </th>
                                    <th> Aksi </th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    </div>
    <!--popup-->
    <div class="modal fade" id="popupIsiBuku"tabindex="-1" name="popupIsiBuku" role="dialog">
        <div class="modal-dialog">
            <form action="<?php echo env('APP_URL'); ?>/admin/inovator/proposal/uploadFile" enctype="multipart/form-data" id="formUpload" name="formUpload">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Detail</h4>
                    </div>
                    <div class="modal-body">

                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal"><i class="fa fa-close"></i> Close</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop
@section('footer_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/inovasiunggulan/scripts/isi.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop