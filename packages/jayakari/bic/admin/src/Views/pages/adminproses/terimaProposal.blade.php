@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/emails/css/askReview.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
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
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo  env('APP_URL'); ?>/admin/home">Email</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Kirim email</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Kirim Email Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form class="form-horizontal form-without-legend" role="form" action="<?php echo  env('APP_URL'); ?>/admin/home">
                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">Kepada</label>
                            <div class="col-md-8">
                                <label class="control-label"><b>{{$proposal[0]->user->fullname}}</b></label>
                                <input type="hidden" id="id" name="id" value="{{$proposal[0]->id}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Judul Pesan</label>
                            <div class="col-md-8">
                                <label class="control-label"><b>[BIC] Selamat Proposal Pemenang - </b>{{$proposal[0]->id}} - {{$proposal[0]->judul}}</label>
                                <input type="hidden" id="judul" name="judul" value="[BIC] Review Proposal - {{$proposal[0]->id}} - {{$proposal[0]->judul}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Isi Pesan <span class="require">*</span></label>
                            <div class="col-md-10">
                                <?php
                                $txtreview = "";
                                if (count($review) <> 0){
                                    $txtreview = $review[0]->isi;
                                }
                                ?>
                                <textarea class="ckeditor form-control" name="isi" id="isi" rows="10">{{$txtreview}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">&nbsp;</label>
                            <div class="col-md-10">
                                <button class="btn blue" type="button" id="btnreview" name="btnreview"><i class="fa fa-send"></i> Kirim Pesan</button>
                                <button type="button" class="btn red" id="batal" name="batal"><i class="fa fa-close"></i> Batal</button>
                            </div>
                        </div><hr>
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Data Proposal</label>
                            <div class="col-md-10">
                                <!--<div class="keterangan" style="background: #ffffff">-->
                                <div style="background: #ffffff">
                                    <div style="padding-left:10px;padding-right:10px;">
                                        <h3><b>{{$proposal[0]->id}} - {{$proposal[0]->judul}}</b></h3>
                                        Tanggal : <?php $tgl = new DateTime($proposal[0]->tgl_pembuatan); echo $tgl->format('d M Y'); ?>
                                        <hr>
                                        <h4><b>Perjalanan Review Proposal Anda</b></h4>
                                        <?php $index = 1; ?>
                                        <table class="table table-striped table-bordered table-hover" id="tblHistory" name="tblHistory">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Tanggal</th>
                                                <th>Dari</th>
                                                <th>Judul</th>
                                                <th>Message</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($proposal[0]->message as $item)
                                                <?php
                                                if (($item->receiver<>"AdminProses") && ($item->sender<>"AdminProses")){
                                                ?>
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$item->id}}</td>
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
                                                    <?php $arrjudul = explode("-",$item->judul); ?>
                                                    <td>{{$arrjudul[0]}}</td>
                                                    <td><?php echo $item->isi; ?></td>
                                                </tr>
                                                <?php $index++; } ?>
                                            @endforeach
                                            </tbody>
                                        </table><hr>
                                        <h4><b>Pendapat Teknis</b></h4>
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
                                            echo 'Belum ada pendapat teknis';
                                        }
                                        ?><hr>
                                        <h4><b>Penilaian Juri</b></h4>
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
                                        ?><hr>
                                        <h4><b>Abstrak</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->abstrak?></p>
                                        <h4><b>Deskripsi</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->deskripsi?></p>
                                        <h4><b>Keunggulan Teknologi</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->keunggulan_teknologi?></p>
                                        <h4><b>Potensi Aplikasi</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->potensi_aplikasi?></p>
                                        <h4><b>Tahapan Pengembangan</b></h4><hr>
                                        <p style="text-align: justify"><?php echo $proposal[0]->development->development?></p>
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
                                        <p style="text-align: justify">{{$proposal[0]->arn->arn or ''}}</p>
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
                                                <th>Telepon</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td><b>{{$proposal[0]->user->fullname}}</b></td>
                                                <td><b>Pembuat dan Pengupload Proposal</b></td>
                                                <td><b>{{$proposal[0]->user->email or ''}}</b></td>
                                                <td><b>{{$proposal[0]->user->hp or ''}}</b></td>
                                            </tr>
                                            <?php
                                            $index = 2;
                                            ?>
                                            @foreach($proposal[0]->inovatorMember as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->rsc->rsc}}</td>
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
                                                <td><b>{{$proposal[0]->user->email or ''}}</b></td>
                                                <td><b>{{$proposal[0]->user->hp or ''}}</b></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <?php }
                                        ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/adminproses/scripts/terimaProposal.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop