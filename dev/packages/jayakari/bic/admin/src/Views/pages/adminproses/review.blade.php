@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal
                <small>Review Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Review Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Review Proposal Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="portlet-title">
                                        <div class="caption font-green">
                                            <i class="icon-pin font-green"></i>
                                            <span class="caption-subject bold uppercase"> Review Proposal</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right">
                                        <button class="btn green pull-right" id="btnLookup" name="btnLookup">Lookup Proposal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>Review Anda</div>&nbsp;&nbsp;&nbsp;
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <label class="control-label"><b>Isi Review</b></label>
                                        <?php
                                        $txtreview = "";
                                        if (count($review) <> 0){
                                            $txtreview = $review[0]->isi;
                                        }
                                        ?>
                                        <textarea class="ckeditor form-control" rows="6" id="review" name="review">{{$txtreview}}</textarea><br>
                                        <label class="control-label"><b>Status Proposal</b></label>
                                        <select class="form-control" id="selStatus" name="selStatus">
                                            <option value="0">-- Pilih salah satu --</option>
                                            @foreach($statusProposal as $item)
                                                <option value="{{$item->id}}">{{$item->status}}</option>
                                            @endforeach
                                        </select><br><br>
                                        <button class="btn blue" type="button" id="btnreview" name="btnreview"><i class="fa fa-send"></i> Kirim Review</button><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label"><b>Perjalanan Review</b></label>
                                                <table class="table table-striped table-bordered table-hover" id="tblHistory" name="tblHistory">
                                                    <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th style="display: none">ID</th>
                                                        <th>Tanggal</th>
                                                        <th>Dari</th>
                                                        <th>Judul</th>
                                                        <th style="display: none">Message</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $index = 1;
                                                    $num = count($proposal[0]->message);
                                                    for($i=$num-1;$i>=0;$i--){
                                                        echo '<tr>';
                                                        echo '<td>'.$index.'</td>';
                                                        echo '<td style="display: none">'.$proposal[0]->message[$i]->id.'</td>';
                                                        echo '<td>';
                                                        $tgl = new DateTime($proposal[0]->message[$i]->inserted_date);
                                                        echo $tgl->format("d M Y H:i:s");
                                                        echo '</td>';
                                                        echo '<td>';
                                                        if ($proposal[0]->message[$i]->id_receiver == 0){
                                                            if ($proposal[0]->message[$i]->user <> null){
                                                                echo $proposal[0]->message[$i]->user->fullname;
                                                            }else{
                                                                echo 'Reviewer';
                                                            }
                                                        }else{
                                                            echo "Reviewer";
                                                        }
                                                        echo '</td>';
                                                        echo '<td><a href="javascript:;" id="detailMessage" name="detailMessage">'.$proposal[0]->message[$i]->judul.'</a></td>';
                                                        echo '<td style="display: none">'.$proposal[0]->message[$i]->isi.'</td>';
                                                        echo '</tr>';
                                                        $index++;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6" id="isi" value="isi">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>{{$proposal[0]->id}} - {{$proposal[0]->judul}}</div>
                                        <input type="hidden" id="id" name="id" value="{{$proposal[0]->id}}"/>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="naratif">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <h3><b>Bagian 1 - Penjelasan Naratif</b></h3>
                                                    <p>Bagian ini berisi penjelasan Anda secara naratif, ringkas dan jelas mengenai inovasi yang Anda usulkan. Narasi dijabarkan dalam bentuk :</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>1. Abstrak (<500 karakter)</b></p>
                                                    <p style="text-align: justify">{{$proposal[0]->abstrak}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>2. Deskripsi Lengkap (<5.000 karakter)</b></p>
                                                    <p style="text-align: justify">{{$proposal[0]->deskripsi}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>3. Keunggulan Teknologi yang Anda tawarkan</b></p>
                                                    <p style="text-align: justify">{{$proposal[0]->keunggulan_teknologi}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>4. Potensi aplikasi dari inovasi Anda</b></p>
                                                    <p style="text-align: justify">{{$proposal[0]->potensi_aplikasi}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3><b>Bagian 2 - Data Pendukung</b></h3>
                                                    <p>Bagian ini berisi data-data pendukung yang diperlukan bagi juri untuk menilai beberapa aspek dari inovasi Anda seperti : </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>1. Tahapan Pengembangan</b></p>
                                                    <?php
                                                    if ($proposal[0]->development <> null){
                                                    ?>
                                                    <p style="text-align: justify">{{$proposal[0]->development->development}}</p>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <p style="text-align: justify">-</p>
                                                    <?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>2. Kebutuhan akan proteksi HAKI</b></p>
                                                    <?php
                                                    if (count($proposal[0]->ipr) == 0){
                                                        echo '-';
                                                    }else{
                                                    ?>
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
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>3. Kata Kunci Teknologi</b></p>
                                                    <?php
                                                    if (count($proposal[0]->kunciTeknologi) > 0){
                                                    ?>
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
                                                    <?php
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>4. Kata Kunci Aplikasi</b></p>
                                                    <?php
                                                    if (count($proposal[0]->kunciAplikasi) > 0){
                                                    ?>
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
                                                    <?php
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>5. Fokus Bidang Riset</b></p>
                                                    <?php
                                                    if ($proposal[0]->arn <> null){
                                                    ?>
                                                    <p style="text-align: justify">{{$proposal[0]->arn->arn}}</p>
                                                    <?php
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>6. Kolaborasi yang Anda inginkan</b></p>
                                                    <?php
                                                    if (count($proposal[0]->kunciKolaborasi) > 0){
                                                    ?>
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
                                                    </table><b>Catatan bagi rekanan kolaborasi:</b></h5>
                                                    <p style="text-align: justify">{{$proposal[0]->catatan}}</p>
                                                    <?php
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>7. Data Institusi</b></p>
                                                    <?php
                                                    if ($proposal[0]->instansi <> null){
                                                    ?>
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
                                                    <?php
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h3><b>Bagian 3 - Data dan File Pendukung</b></h3>
                                                    <p>Bagian ini berisi penjelasan Anda secara naratif, ringkas dan jelas mengenai inovasi yang Anda usulkan. Narasi dijabarkan dalam bentuk :</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>1. Data Peneliti / Inovator / Tim Peneliti dan bagi Anda yang ingin menambahkan</p>
                                                    <?php
                                                    if (count($inovasiMember) > 0){
                                                    ?>
                                                    <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Inovator</th>
                                                            <th>Posisi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><b>{{$proposal[0]->user->fullname}}</b></td>
                                                            <td><b>Pembuat dan Pengupload Proposal</b></td>
                                                        </tr>
                                                        <?php
                                                        $index = 2;
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
                                                    <?php
                                                    }else{  ?>
                                                    <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Inovator</th>
                                                            <th>Posisi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><b>{{$proposal[0]->user->fullname}}</b></td>
                                                            <td><b>Pembuat dan Pengupload Proposal</b></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>2. File seperti gambar dan dokumen pendukung lainnya yang tidak dapat diakomodasi oleh form yang telah kami sediakan. Disediakan 2 slot gambar Max. @1024 KB dan 1 slot untuk file umum Max. @1024 KB.</p>
                                                    <?php
                                                    if (count($proposal[0]->file) > 0){
                                                    ?>
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
                                                    <?php
                                                    }else{
                                                        echo '-';
                                                    }
                                                    if (count($proposal[0]->url) > 0){
                                                    ?>
                                                    <table class="table table-striped table-bordered table-hover" id="tblUrl" name="tblUrl">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Url</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $index = 1;
                                                        ?>
                                                        @foreach($proposal[0]->url as $item)
                                                            <tr>
                                                                <td>{{$index}}</td>
                                                                <?php
                                                                    $url = '';
                                                                    if (strpos($item->url, 'http') !== false) {
                                                                        $url = $item->url;
                                                                    }else{
                                                                        $url = 'http://'.$item->url;
                                                                    }
                                                                ?>
                                                                <td><a href="{{$url}}" target="_blank">{{$item->url}}</a></td>
                                                            <!--<td>{{$item->file}}</td>-->
                                                            </tr>
                                                            <?php $index++; ?>
                                                        @endforeach
                                                        </tbody>
                                                    </table><hr>
                                                    <?php
                                                    }else{
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popupLookUp"tabindex="-1" name="popupLookUp" role="dialog">
        <div class="modal-dialog-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><b>Cari Proposal</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3">Nomor Proposal</label>
                            <div class="col-md-9">
                                <input type="text" id="popupNomorProposal" name="popupNomorProposal" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-3">Nama Inovator</label>
                            <div class="col-md-9">
                                <input type="text" id="popupNamaInovator" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-3">Judul Proposal</label>
                            <div class="col-md-9">
                                <input type="text" id="popupJudulProposal" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-3">Keyword</label>
                            <div class="col-md-9">
                                <input type="text" id="popupKeywordProposal" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-3">Status Proposal</label>
                            <div class="col-md-9">
                                <select class="form-control" id="selPopupStatusProposal" name="selPopupStatusProposal">
                                    <option value="0">-- All --</option>
                                    @foreach($proposalStatus as $item)
                                        <option value="{{$item->id}}">{{$item->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal"><i class="fa fa-close"></i> Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnPopupCari" name="btnPopupCari"><i class="fa fa-search"></i> Cari</button>
                </div>
                <div style="display: block" id="divResult" name="divResult">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet-title">
                                    <div class="caption font-green">
                                        <i class="icon-pin font-green"></i>
                                        <span class="caption-subject bold uppercase"> Hasil Pencarian</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="result">
                        <thead>
                        <tr>
                            <th width="20px"> No </th>
                            <th width="100px"> Inovator </th>
                            <th width="50px"> Status </th>
                            <th width="20px"> Proposal# </th>
                            <th width="400px"> Judul </th>
                            <!--<th> Abstrak </th>
                            <th> Deskripsi </th>
                            <th> Keunggulan Teknologi </th>
                            <th> Potensi Aplikasi </th>-->
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/review.js" type="text/javascript"></script>
@stop