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
                                        <span class="caption-subject bold uppercase">Detail Proposal</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                    <!--<button class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-arrow-left"></i> Kembali</button>
                                        <?php
                                    if ($proposal[0]->statusProposal->status == "REVIEW"){
                                        echo '<button type="button" class="btn red" id="review" name="review" style="margin-top:3px;"><i class="fa fa-send"></i> Review</button>';
                                    }
                                    ?>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>History Review</div>&nbsp;&nbsp;&nbsp;
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
                                                        if (($item->receiver<>"AdminProses") && ($item->sender<>"AdminProses")){
                                                        ?>
                                                        <tr>
                                                            <td>{{$index}}</td>
                                                            <td style="display: none">{{$item->id}}</td>
                                                            <td><?php $tgl = new DateTime($item->inserted_date); echo $tgl->format("d M Y H:i:s"); ?></td>
                                                            <td>
                                                                <?php
                                                                if ($item->id_receiver == 0){
                                                                    echo $item->user->fullname;
                                                                }else{
                                                                    echo "Reviewer";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><a href="javascript:;" id="detailMessage" name="detailMessage">{{$item->judul}}</a></td>
                                                            <td style="display: none">{{$item->isi}}</td>
                                                        </tr>
                                                        <?php $index++; } ?>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6" id="isi" value="isi">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (($proposal[0]->statusProposal->status == "SELEKSI") ||($proposal[0]->statusProposal->status == "DISIMPAN") ||($proposal[0]->statusProposal->status == "DITOLAK") ||($proposal[0]->statusProposal->status == "DITERIMA") || ($proposal[0]->statusProposal->status == "REVISI") || ($proposal[0]->statusProposal->status == "REVIEW") || ($proposal[0]->statusProposal->status == "IN REVIEW")){
                                ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>Pendapat Teknis</div>&nbsp;&nbsp;&nbsp;
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <?php
                                        if (count($proposal[0]->masukanTeknis) > 0){
                                        ?>
                                        <?php $index = 1; ?>
                                        <table class="table table-striped table-bordered table-hover" id="tblHistory" name="tblHistory">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Technical Reviewer</th>
                                                <th>Masukan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($proposal[0]->masukanTeknis as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$item->juri->fullname}}</td>
                                                    <td>{{$item->masukan}}</td>
                                                    <?php $index += 1; ?>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <?php   }else{
                                            echo 'Belum ada masukan teknis';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>Penilaian Juri</div>&nbsp;&nbsp;&nbsp;
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <?php
                                        if (count($proposal[0]->nilaiJuri) > 0){
                                        ?>
                                        <?php $index = 1; ?>
                                        <table class="table table-striped table-bordered table-hover" id="tblHistory" name="tblHistory">
                                            <tbody>
                                            <?php
                                            foreach ($penilaianJuri as $item){
                                                echo '<tr>';
                                                echo '<td>Seri</td>';
                                                echo '<td>Kategori</td>';
                                                echo '<td>No</td>';
                                                echo '<td>Average</td>';
                                                echo '<td>Juri</td>';
                                                echo '<td>D1</td>';
                                                echo '<td>D2</td>';
                                                echo '<td>D3</td>';
                                                echo '<td>D4</td>';
                                                echo '<td>D5</td>';
                                                echo '<td>D6</td>';
                                                echo '<td>D7</td>';
                                                echo '<td>D8</td>';
                                                echo '<td>G</td>';
                                                echo '<td>MIN9</td>';
                                                echo '<td>MAX9</td>';
                                                echo '<td>Kode</td>';
                                                echo '<td>Judul</td>';
                                                echo '</tr>';
                                                echo '<tr>';
                                                echo '<td>'.$item->short.'</td>';
                                                echo '<td>'.$item->kategori.'</td>';
                                                echo '<td>'.$index.'(1)</td>';
                                                echo '<td>'.$item->average.'</td>';
                                                echo '<td>'.$item->jumlah_juri.'</td>';
                                                echo '<td>'.$item->d1.'</td>';
                                                echo '<td>'.$item->d2.'</td>';
                                                echo '<td>'.$item->d3.'</td>';
                                                echo '<td>'.$item->d4.'</td>';
                                                echo '<td>'.$item->d5.'</td>';
                                                echo '<td>'.$item->d6.'</td>';
                                                echo '<td>'.$item->d7.'</td>';
                                                echo '<td>'.$item->d8.'</td>';
                                                echo '<td>'.$item->g.'</td>';
                                                echo '<td>'.$item->min.'</td>';
                                                echo '<td>'.$item->max.'</td>';
                                                echo '<td>'.$item->kode.'</td>';
                                                echo '<td></td>';
                                                echo '</tr>';
                                                foreach ($item->penilaian_juri as $rows){
                                                    echo '<tr>';
                                                    echo '<td colspan="3"></td>';
                                                    echo '<td>'.$rows->average.'</td>';
                                                    echo '<td></td>';
                                                    echo '<td style="background-color: #cccccc">'.$rows->d1.'</td>';
                                                    echo '<td style="background-color: #ccffff">'.$rows->d2.'</td>';
                                                    echo '<td style="background-color: #ffff99">'.$rows->d3.'</td>';
                                                    echo '<td style="background-color: #ffff99">'.$rows->d4.'</td>';
                                                    echo '<td style="background-color: #ccff99">'.$rows->d5.'</td>';
                                                    echo '<td style="background-color: #ccff99">'.$rows->d6.'</td>';
                                                    echo '<td style="background-color: #ffccff">'.$rows->d7.'</td>';
                                                    echo '<td style="background-color: #ffccff">'.$rows->d8.'</td>';
                                                    echo '<td>'.$rows->d9.'</td>';
                                                    echo '<td colspan="3">'.$rows->juri.'</td>';
                                                    echo '<td>'.$rows->komentar.'</td>';
                                                    echo '</tr>';
                                                }
                                                $index++;
                                            }
                                            ?>
                                            <tbody>
                                        </table>
                                        <?php   }else{
                                            echo 'Belum ada penilaian';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php   } ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>{{$proposal[0]->id}} - {{$proposal[0]->judul}}
                                        </div>&nbsp;&nbsp;&nbsp;
                                        <input type="hidden" id="id" name="id" value="{{$proposal[0]->id}}" />
                                        <input type="hidden" id="tahapan" name="tahapan" value="{{$tahapan}}" />
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
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>1. Abstrak (<500 karakter)</b></p>
                                                    <?php echo $proposal[0]->abstrak; ?>
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
                                                        <?php $index = 1; ?>
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
                                                    if (count($proposal[0]->inovatorMember) > 0){
                                                    ?>
                                                    <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Inovator</th>
                                                            <th>Posisi</th>
                                                            <th>Email</th>
                                                            <th>Telp</th>
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
                                                        @foreach($proposal[0]->inovatorMember as $item)
                                                            <tr>
                                                                <td>{{$index}}</td>
                                                                <td>{{$item->name}}</td>
                                                                <td>{{$item->rsc->rsc}}</td>
                                                                <td> {{$item->email}} </td>
                                                                <td> {{$item->telp}} </td>
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
                                                    <p>2. FILE & LINK Pendukung.  3 (tiga) File Pendukung: 2 (dua) slot file gambar masing-masing Max. @1024 KB dan 1 (satu) slot file dokumen Max. @1024 KB; serta 3 (tiga) Link URL video clip, animasi atau Situs Web.</p>
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
                                                    </table><hr>
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
                                </div><hr>
                                <?php
                                if (($proposal[0]->statusProposal->status == "SELEKSI") || ($proposal[0]->statusProposal->status == "DISIMPAN") || ($proposal[0]->statusProposal->status == "DITERIMA") || ($proposal[0]->statusProposal->status == "DITOLAK")){
                                ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>Penilaian Juri</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <?php $index = 1; ?>
                                        <table class="table table-striped table-bordered table-hover" id="tblHistory" name="tblHistory">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Juri</th>
                                                <th>Nilai 1</th>
                                                <th>Nilai 2</th>
                                                <th>Nilai 3</th>
                                                <th>Nilai 4</th>
                                                <th>Nilai 5</th>
                                                <th>Nilai 6</th>
                                                <th>Nilai 7</th>
                                                <th>Nilai 8</th>
                                                <th>Nilai 9</th>
                                                <th>Rata-Rata</th>
                                                <th>Alasan</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div><hr>
                                <?php
                                }
                                if (($proposal[0]->statusProposal->status == "REVISI") || ($proposal[0]->statusProposal->status == "IN REVIEW")|| ($proposal[0]->statusProposal->status == "SELEKSI")|| ($proposal[0]->statusProposal->status == "DISIMPAN") || ($proposal[0]->statusProposal->status == "DITERIMA") || ($proposal[0]->statusProposal->status == "DITOLAK")){
                                ?>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>History Review</div>&nbsp;&nbsp;&nbsp;
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
                                                        if (($item->receiver<>"AdminProses") && ($item->sender<>"AdminProses")){
                                                        ?>
                                                        <tr>
                                                            <td>{{$index}}</td>
                                                            <td style="display: none">{{$item->id}}</td>
                                                            <td><?php $tgl = new DateTime($item->inserted_date); echo $tgl->format("d M Y H:i:s"); ?></td>
                                                            <td>
                                                                <?php
                                                                if ($item->id_receiver == 0){
                                                                    echo $item->user->fullname;
                                                                }else{
                                                                    echo "Reviewer";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><a href="javascript:;" id="detailMessageBawah" name="detailMessageBawah">{{$item->judul}}</a></td>
                                                            <td style="display: none">{{$item->isi}}</td>
                                                        </tr>
                                                        <?php $index++; } ?>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6" id="isiBawah" value="isiBawah">

                                            </div>
                                        </div>
                                    </div>
                                </div><hr>
                                <?php
                                }
                                ?>
                                <div class="form-actions noborder">
                                <!--<button type="button" class="btn default" id="batalBawah" name="batalBawah"><i class="fa fa-close"></i> Kembali</button>
                                    <?php
                                if ($proposal[0]->statusProposal->status == "REVIEW"){
                                    echo '<button type="button" class="btn red" id="reviewBawah" name="reviewBawah" style="margin-top:3px;"><i class="fa fa-send"></i> Review</button>';
                                }
                                ?>-->
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
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL') ?>/public/jayakari/bic/admin/pages/proposals/scripts/detailMasuk.js" type="text/javascript"></script>
@stop
