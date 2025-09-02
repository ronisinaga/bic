@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/emails/css/askReview.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Email
                <small>Kirim email meminta review proposal inovasi</small>
            </h3>
            <div class="page-bar">
                <!--<ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo  env('APP_URL'); ?>/admin/home">Email</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Kirim email</span>
                    </li>
                </ul>-->
                    <ul class="page-breadcrumb">
                        <li style="color: red">
                            <?php echo $labels["PIR"] ?>
                        </li>
                    </ul>
                <!--<div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Kirim Email Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>-->
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form class="form-horizontal form-without-legend" role="form" action="<?php echo  env('APP_URL'); ?>/admin/home">
                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">Kepada</label>
                            <div class="col-md-8">
                                <label class="control-label"><b>Tim Review</b></label>
                                <input type="hidden" id="id" name="id" value="{{$proposal[0]->id}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Judul Pesan</label>
                            <div class="col-md-10">
                                <label class="control-label" style="text-align: left"><b>[BIC] Review Proposal - {{$proposal[0]->id}} -  </b>{{$proposal[0]->judul}}</label>
                                <input type="hidden" id="judul" name="judul" value="[BIC] Review Proposal - {{$proposal[0]->id}} - {{$proposal[0]->judul}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Isi Pesan <span class="require">*</span></label>
                            <div class="col-md-10">
                                <textarea class="ckeditor form-control" name="isi" id="isi" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Data Proposal</label>
                            <div class="col-md-10">
                                <div class="keterangan" style="background: #ffffff">
                                    <div style="padding-left:10px;padding-right:10px;">
                                        <h3><b>{{$proposal[0]->judul}}</b></h3>
                                        Tanggal : <?php $tgl = new DateTime($proposal[0]->tgl_pembuatan); echo $tgl->format('d M Y'); ?>
                                        <hr>
                                        <h4><b>Abstrak</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->abstrak?></p>
                                        <h4><b>Deskripsi</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->deskripsi?></p>
                                        <h4><b>Keunggulan Teknologi</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->keunggulan_teknologi?></p>
                                        <h4><b>Potensi Aplikasi</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->potensi_aplikasi?></p>
                                        <h4><b>Tahapan Pengembangan</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $development[0]->development?></p>
                                        <h4><b>Kebutuhan akan proteksi HAKI</b></h4><hr>
                                        <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                            <tbody>
                                            <tr>
                                                <td>Jenis Patent</td>
                                                <td>{{$proposal[0]->ipr[0]->ipr}}</td>
                                            </tr>
                                            <?php
                                            if (($proposal[0]->ipr[0]->id == 1) || ($proposal[0]->ipr[0]->id == 2)){
                                            ?>
                                            <tr>
                                                <td>Nomor Patent</td>
                                                <td>{{$proposal[0]->ipr[0]->pivot->no_patent}}</td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <h4><b>Kata Kunci Teknologi</b></h4><hr>
                                        <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Level 1</th>
                                                <th>Level 2</th>
                                                <th>Level 3</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $index = 1;
                                            ?>
                                            @foreach($proposal[0]->kunciTeknologi as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$item->level1->kata_kunci or ''}}</td>
                                                    <td>{{$item->level2->kata_kunci or ''}}</td>
                                                    <td>{{$item->kataKunciTeknologi->kata_kunci or ''}}</td>
                                                </tr>
                                                <?php $index++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <h4><b>Kata Kunci Aplikasi</b></h4><hr>
                                        <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Level 1</th>
                                                <th>Level 2</th>
                                                <th>Level 3</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $index = 1;
                                            ?>
                                            @foreach($proposal[0]->kunciAplikasi as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$item->level1->kata_kunci or ''}}</td>
                                                    <td>{{$item->level2->kata_kunci or ''}}</td>
                                                    <td>{{$item->kataKunciAplikasi->kata_kunci or ''}}</td>
                                                </tr>
                                                <?php $index++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <h4><b>Fokus bidang riset</b></h4><hr>
                                        <p style="text-align: justify">{{$arn[0]->arn}}</p>
                                        <h4><b>Kolaborasi yang diinginkan</b></h4><hr>
                                        <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Level 1</th>
                                                <th>Level 2</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $index = 1;
                                            ?>
                                            @foreach($proposal[0]->kunciKolaborasi as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$item->level1->kata_kunci or ''}}</td>
                                                    <td>{{$item->kataKunciKolaborasi->kata_kunci or ''}}</td>
                                                </tr>
                                                <?php $index++; ?>
                                            @endforeach
                                            </tbody>
                                        </table><b>Catatan:</b></h5>
                                        <p style="text-align: justify">{{$proposal[0]->catatan}}</p>
                                        <h4><b>Data Institusi</b></h4><hr>
                                        <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                            <tbody>
                                            <tr>
                                                <td>Nama Instansi</td>
                                                <td>{{$proposal[0]->instansi->nama_instansi or ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>Bidang Usaha</td>
                                                <td>
                                                    <?php $index = 1; ?>
                                                    @foreach($bidangusaha as $item)
                                                        <p style="text-align: justify">{{$index}}. {{$item}}</p>
                                                        <?php $index++ ?>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Karyawan</td>
                                                <td>{{$employee}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <h4><b>Data Peneliti/Inovator/Tim Peneliti</b></h4><hr>
                                        <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Inovator</th>
                                                <th>Posisi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $index = 1;
                                            ?>
                                            @foreach($inovasiMember as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->jabatan}}</td>
                                                </tr>
                                                <?php $index++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <h4><b>File Pendukung</b></h4><hr>
                                        <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>File</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $index = 1;
                                            ?>
                                            @foreach($proposal[0]->file as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td><a href="<?php echo env('APP_URL'); ?>/admin/proposals/{{$item->id}}/download">{{$item->file}}</a></td>
                                                <!--<td>{{$item->file}}</td>-->
                                                </tr>
                                                <?php $index++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-offset-2 padding-left-0 padding-top-20">
                                <button type="button" class="btn btn-primary" id="kirim" name="kirim"><i class="fa fa-send"></i> Email Ke Reviewer</button>
                                <button type="button" class="btn default" id="batal" name="batal"><i class="fa fa-close"></i> Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
@stop
@section('footer_page')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo  env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/emails/scripts/askReview.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop