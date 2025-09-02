@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
@stop
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal
                <small>Detail Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Detail Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Detail Proposal Content
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="caption font-green">
                                        <i class="icon-pin font-green"></i>
                                        <span class="caption-subject bold uppercase"> Detail Proposal</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <button class="btn red" id="btnBatal" name="btnBatal"><i class="fa fa-arrow-left"></i> Kembali</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <?php
                                    if (count($proposal[0]->message) > 0){
                                ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>History Review - {{$proposal[0]->judul}}</div>&nbsp;&nbsp;&nbsp;
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label"><b>Perjalanan Review</b></label>
                                                <?php $index = 1; ?>
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
                                                    @foreach($proposal[0]->message as $item)
                                                        <?php
                                                        if (($item->receiver <> "AdminProses") && ($item->sender <> "AdminProses")){
                                                        ?>
                                                        <tr>
                                                            <td>{{$index}}</td>
                                                            <td style="display: none">{{$item->id}}</td>
                                                            <td><?php $tgl = new DateTime($item->inserted_date); echo $tgl->format("d M Y H:i:s"); ?></td>
                                                            <td>
                                                                <?php
                                                                if ($item->id_receiver == 0){
                                                                    if ($item->user <> null){
                                                                        echo $item->user->fullname;
                                                                    }
                                                                }else{
                                                                    echo "Reviewer";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><a href="javascript:;" id="detailMessage" name="detailMessage">{{$item->judul}}</a></td>
                                                            <td style="display: none">{{$item->isi}}</td>
                                                        </tr>
                                                        <?php $index++; }?>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6" id="isi" value="isi">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php  } ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>{{$proposal[0]->id}} - {{$proposal[0]->judul}}</div>&nbsp;&nbsp;&nbsp;
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
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
                                                    <p style="text-align: justify"><?php echo $proposal[0]->abstrak; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>2. Deskripsi Lengkap (<5.000 karakter)</b></p>
                                                    <p style="text-align: justify"><?php echo $proposal[0]->deskripsi; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>3. Keunggulan Teknologi yang Anda tawarkan</b></p>
                                                    <p style="text-align: justify"><?php echo $proposal[0]->keunggulan_teknologi; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>4. Potensi aplikasi dari inovasi Anda</b></p>
                                                    <p style="text-align: justify"><?php echo $proposal[0]->potensi_aplikasi; ?></p>
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
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><b>{{$proposal[0]->user->fullname}}</b></td>
                                                            <td><b>Pembuat dan Pengupload Proposal</b></td>
                                                            <td><b>{{$proposal[0]->user->email}}</b></td>
                                                            <td><b>{{$proposal[0]->user->hp}}</b></td>
                                                        </tr>
                                                        <?php
                                                            $index = 2;
                                                        ?>
                                                        @foreach($inovasiMember as $item)
                                                            <tr>
                                                                <td>{{$index}}</td>
                                                                <td>{{$item->name}}</td>
                                                                <td>{{$item->jabatan}}</td>
                                                                <td> - </td>
                                                                <td> - </td>
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
                                                            <th>Email</th>
                                                            <th>Telepon</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><b>{{$proposal[0]->user->fullname}}</b></td>
                                                            <td><b>Pembuat dan Pengupload Proposal</b></td>
                                                            <td><b>{{$proposal[0]->user->email}}</b></td>
                                                            <td><b>{{$proposal[0]->user->hp}}</b></td>
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
                                                    ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><hr>
                                    <?php
                                    if (count($proposal[0]->message) > 0){
                                    ?>
                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>History Review - {{$proposal[0]->judul}}</div>&nbsp;&nbsp;&nbsp;
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label"><b>Perjalanan Review</b></label>
                                                    <?php $index = 1; ?>
                                                    <table class="table table-striped table-bordered table-hover" id="tblHistoryBawah" name="tblHistoryBawah">
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
                                                        @foreach($proposal[0]->message as $item)
                                                            <?php
                                                            if (($item->receiver <> "AdminProses") && ($item->sender <> "AdminProses")){
                                                            ?>
                                                            <tr>
                                                                <td>{{$index}}</td>
                                                                <td style="display: none">{{$item->id}}</td>
                                                                <td><?php $tgl = new DateTime($item->inserted_date); echo $tgl->format("d M Y H:i:s"); ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($item->id_receiver == 0){
                                                                        if ($item->user <> null){
                                                                            echo $item->user->fullname;
                                                                        }
                                                                    }else{
                                                                        echo "Reviewer";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><a href="javascript:;" id="detailMessageBawah" name="detailMessageBawah">{{$item->judul}}</a></td>
                                                                <td style="display: none">{{$item->isi}}</td>
                                                            </tr>
                                                            <?php $index++; }?>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6" id="isiBawah" value="isiBawah">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/scripts/detailproposalAdmin.js" type="text/javascript"></script>
@stop
