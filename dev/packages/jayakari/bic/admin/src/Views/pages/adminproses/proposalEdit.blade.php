@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/arn/css/create.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Assign Proposal
                <small>Assign proposal ke topik</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Assign Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Assign proposal ke topik</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Assign Proposal Content
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
                                <span class="caption-subject bold uppercase"> Assign proposal ke topik</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="menu">Batch</label>
                                        <select class="form-control" id="selBatch" name="selBatch">
                                            <option value="0" selected>-- Pilih Batch --</option>
                                            @foreach($batch as $item)
                                                <?php
                                                    $selected = $proposal[0]->id_batch == $item->id?"selected":"";
                                                ?>
                                                <option value="{{$item->id}}" {{$selected}}>{{$item->batch}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus dipilih*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Proposal</label>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="proposal" name="proposal" value="{{$proposal[0]->judul}}" readonly/>
                                                <input type="hidden" class="form-control" id="id_proposal" name="id_proposal" value="{{$proposal[0]->id}}"/>
                                                <input type="hidden" class="form-control" id="id" name="id" value="{{$topikProposal->id}}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn purple" id="btnView" name="btnView"><i class="fa fa-eye"></i> Lihat Proposal</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Topik</label>
                                        <select class="form-control" id="selTopik" name="selTopik">
                                            <option value="0" selected>-- Pilih Topik --</option>
                                            @foreach($batchTopik as $item)
                                                <?php
                                                    $selected = $topikProposal->id_topik == $item->id?"selected":"";
                                                ?>
                                                    <option value="{{$item->id}}" {{$selected}}>{{$item->topik}}</option>
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
    <!-- popup proposal -->
    <div class="modal fade" id="popupViewProposal" tabindex="-1" name="popupViewProposal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h3 class="modal-title" id="view">Detail Proposal</h3>
                </div>
                <div class="modal-body">
                    <div class="keterangan" id="viewBody">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="keterangan" style="background: #ffffff">
                                    <div style="padding-left:10px;padding-right:10px;">
                                        <h3><b>{{$proposal[0]->judul}}</b></h3>
                                        Tanggal : <?php $tgl = new DateTime($proposal[0]->tgl_pembuatan); echo $tgl->format('d M Y'); ?>
                                        <hr>
                                        <h4><b>Abstrak</b></h4><hr>
                                        <p style="text-align: justify">{{$proposal[0]->abstrak}}</p>
                                        <h4><b>Deskripsi</b></h4><hr>
                                        <p style="text-align: justify">{{$proposal[0]->deskripsi}}</p>
                                        <h4><b>Keunggulan Teknologi</b></h4><hr>
                                        <p style="text-align: justify">{{$proposal[0]->keunggulan_teknologi}}</p>
                                        <h4><b>Potensi Aplikasi</b></h4><hr>
                                        <p style="text-align: justify">{{$proposal[0]->potensi_aplikasi}}</p>
                                        <h4><b>Tahapan Pengembangan</b></h4><hr>
                                        <p style="text-align: justify">{{$proposal[0]->development->development}}</p>
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
                                        <p style="text-align: justify">{{$proposal[0]->arn->arn}}</p>
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
                                                <td>{{$proposal[0]->instansi->nama_instansi}}</td>
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
                                                    <td>{{$item->file}}</td>
                                                </tr>
                                                <?php $index++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal"><i class="fa fa-close"></i> Tutup</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('footer_page')
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/proposalEdit.js" type="text/javascript"></script>
@stop
