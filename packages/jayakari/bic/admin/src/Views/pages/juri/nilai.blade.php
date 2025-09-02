@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/juri/css/nilai.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">

        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <form role="form">
                                <div id="wrapper">
                                    <input type="hidden" id="id_topik" name="id_topik" value="{{$topikProposal->id_topik}}">
                                    <input type="hidden" id="id_proposal" name="id_proposal" value="{{$topikProposal->id_proposal}}">
                                    <input type="hidden" id="id_juri" name="id_juri" value="{{$datauser[0]->id}}">
                                    <div id="one">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNO" name="XPNO" value="{{$labels["PNO"]}}">
                                                    <a href="" id="TNO" name="TNO">{{$labels["TNO"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr style="vertical-align: middle">
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNO" class="icheck" value="1"> 1 - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNO" class="icheck" value="2"> 2</label>
                                                                <label>
                                                                    <input type="radio" name="OTNO" class="icheck" value="3"> 3 </label>
                                                                <label>
                                                                    <input type="radio" name="OTNO" class="icheck" value="4"> 4 - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="two">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNRU" name="XPNRU" value="{{$labels["PNRU"]}}">
                                                    <a href="javascript:;" id="TNRU" name="TNRU">{{$labels["TNRU"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNRU" class="icheck" value="1"> 1 - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNRU" class="icheck" value="2"> 2</label>
                                                                <label>
                                                                    <input type="radio" name="OTNRU" class="icheck" value="3"> 3 </label>
                                                                <label>
                                                                    <input type="radio" name="OTNRU" class="icheck" value="4"> 4 - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="three">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNDT" name="XPNDT" value="{{$labels["PNDT"]}}">
                                                    <a href="#" id="TNDT" name="TNDT">{{$labels["TNDT"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNDT" class="icheck" value="1"> 1 - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNDT" class="icheck" value="2"> 2</label>
                                                                <label>
                                                                    <input type="radio" name="OTNDT" class="icheck" value="3"> 3 </label>
                                                                <label>
                                                                    <input type="radio" name="OTNDT" class="icheck" value="4"> 4 - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="four">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNT" name="XPNT" value="{{$labels["PNT"]}}">
                                                    <a href="#" id="TNT" name="TNT">{{$labels["TNT"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNT" class="icheck" value="1"> 1 - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNT" class="icheck" value="2"> 2</label>
                                                                <label>
                                                                    <input type="radio" name="OTNT" class="icheck" value="3"> 3 </label>
                                                                <label>
                                                                    <input type="radio" name="OTNT" class="icheck" value="4"> 4 - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="five">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNP" name="XPNP" value="{{$labels["PNP"]}}">
                                                    <a href="#" id="TNP" name="TNP">{{$labels["TNP"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNP" class="icheck" value="1"> 1 - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNP" class="icheck" value="2"> 2</label>
                                                                <label>
                                                                    <input type="radio" name="OTNP" class="icheck" value="3"> 3 </label>
                                                                <label>
                                                                    <input type="radio" name="OTNP" class="icheck" value="4"> 4 - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="six">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNPE" name="XPNPE" value="{{$labels["PNPE"]}}">
                                                    <a href="#" id="TNPE" name="TNPE">{{$labels["TNPE"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNPE" class="icheck" value="1"> 1 - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNPE" class="icheck" value="2"> 2</label>
                                                                <label>
                                                                    <input type="radio" name="OTNPE" class="icheck" value="3"> 3 </label>
                                                                <label>
                                                                    <input type="radio" name="OTNPE" class="icheck" value="4"> 4 - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="seven">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNPB" name="XPNPB" value="{{$labels["PNPB"]}}">
                                                    <a href="#" id="TNPB" name="TNPB">{{$labels["TNPB"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNPB" class="icheck" value="1"> 1 - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNPB" class="icheck" value="2"> 2</label>
                                                                <label>
                                                                    <input type="radio" name="OTNPB" class="icheck" value="3"> 3 </label>
                                                                <label>
                                                                    <input type="radio" name="OTNPB" class="icheck" value="4"> 4 - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="eight">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNRB" name="XPNRB" value="{{$labels["PNRB"]}}">
                                                    <a href="#" id="TNRB" name="TNRB">{{$labels["TNRB"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNRB" class="icheck" value="1"> 1 - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNRB" class="icheck" value="2"> 2</label>
                                                                <label>
                                                                    <input type="radio" name="OTNRB" class="icheck" value="3"> 3 </label>
                                                                <label>
                                                                    <input type="radio" name="OTNRB" class="icheck" value="4"> 4 - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="nine">
                                        <table class="table table-striped table-hover" id="sample_1">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="hidden" id="XPNR" name="XPNR" value="{{$labels["PNR"]}}">
                                                    <a href="#" id="TNR" name="TNR">{{$labels["TNR"]}}</a>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <label>
                                                                    <input type="radio" name="OTNR" id="OTNR" class="icheck" value="1"> A - Min </label>
                                                                <label>
                                                                    <input type="radio" name="OTNR" id="OTNR" class="icheck" value="2"> B</label>
                                                                <label>
                                                                    <input type="radio" name="OTNR" id="OTNR" class="icheck" value="3"> C </label>
                                                                <label>
                                                                    <input type="radio" name="OTNR" id="OTNR" class="icheck" value="4"> D - Max </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="ket" name="ket" style="background-color: #cccccc">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="penjelasan" style="padding-left:10px;">
                                                <?php echo $labels["PNO"]; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label><b>Catatan Juri</b></label>
                                            <textarea class="form-control" id="alasan" name="alasan" row="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <h3><b>Detail proposal: {{$proposal->judul}}</b></h3>
                                @if($proposal->isiBuku <> null)
                                    @if ($banner->folder_final <> null)
                                        <h3>Klik disini <i class="fa fa-hand-o-right"></i> <a href="http://bic.web.id/public/storage/flippdf/{{$buku->folder_final}}/index.html" target="_blank">{{$buku->judul}}. Lihat di halaman: <b>{{$proposal->isiBuku->page}}</b></a></h3></a>
                                    @elseif($banner->folder_inreview <> null)
                                        <h3>Klik disini <i class="fa fa-hand-0-right"></i> <a href="http://bic.web.id/public/storage/flippdf/{{$buku->folder_inreview}}/index.html" target="_blank"> {{$buku->judul}}. Lihat di halaman: <b>{{$proposal->isiBuku->page}}</b></a></h3></b></a>
                                    @endif
                                @endif
                                <div class="keterangan">
                                    <table class="table table-striped table-hover" id="sample_1">

                                        <tbody>
                                        <?php if (count($teknis) > 0){ ?>
                                        <tr>
                                            <td>
                                                <?php
                                                echo '<h3><b>'.$labels["TCR"].'</b></h3>';
                                                echo '<h4>'.$labels["PCR"].'</h4><hr>';
                                                echo $teknis[0]->masukan;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php   } ?>
                                        <tr>
                                            <td>
                                                <?php echo $labels["T1T"]; ?>
                                                <?php echo $labels["T1D"] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b><?php echo $labels["T1A"]; ?></b><br>
                                                <p style="text-align: justify"><?php echo $proposal->abstrak; ?></p>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b><?php echo $labels["T1DK"]; ?></b><br>
                                                <p style="text-align: justify"><?php echo $proposal->deskripsi; ?></p>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b><?php echo $labels["T1KT"]; ?></b><br>
                                                <p style="text-align: justify"><?php echo $proposal->keunggulan_teknologi; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b><?php echo $labels["T1PA"]; ?></b><br>
                                                <p style="text-align: justify"><?php echo $proposal->potensi_aplikasi; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo $labels["T2T"]; ?>
                                                <?php echo $labels["T2D"]; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b><?php echo $labels["T2TP"]; ?></b><br>
                                                <?php
                                                if ($proposal->development <> null){
                                                ?>
                                                <p style="text-align: justify">{{$proposal->development->development}}</p>
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
                                                <b><?php echo $labels["T2H"]; ?></b><br>
                                                <?php
                                                if (count($proposal->ipr) == 0){
                                                    echo '-';
                                                }else{
                                                ?>
                                                <table class="table table-striped table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                                    <tbody>
                                                    <tr>
                                                        <td>Jenis Patent</td>
                                                        <td>{{$proposal->ipr[0]->ipr}}</td>
                                                    </tr>
                                                    <?php
                                                    if (($proposal->ipr[0]->id == 1) || ($proposal->ipr[0]->id == 2)){
                                                    ?>
                                                    <tr>
                                                        <td>Nomor Patent</td>
                                                        <td>{{$proposal->ipr[0]->pivot->no_patent}}</td>
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
                                                <b><?php echo $labels["T2KKT"]; ?></b><br>
                                                <?php
                                                if (count($proposal->kunciTeknologi) > 0){
                                                ?>
                                                <table class="table table-striped table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
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
                                                    @foreach($proposal->kunciTeknologi as $item)
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
                                                <b><?php echo $labels["T2KKA"]; ?></b><br><br>
                                                <?php
                                                if (count($proposal->kunciAplikasi) > 0){
                                                ?>
                                                <table class="table table-striped table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
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
                                                    @foreach($proposal->kunciAplikasi as $item)
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
                                                <b><?php echo $labels["T2FBR"]; ?></b><br><br>
                                                <?php
                                                if ($proposal->arn <> null){
                                                ?>
                                                <p style="text-align: justify">{{$proposal->arn->arn}}</p>
                                                <?php
                                                }else{
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b><?php echo $labels["T2K"]; ?></b><br><br>
                                                <?php
                                                if (count($proposal->kunciKolaborasi) > 0){
                                                ?>
                                                <table class="table table-striped table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
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
                                                    @foreach($proposal->kunciKolaborasi as $item)
                                                        <tr>
                                                            <td>{{$index}}</td>
                                                            <td>{{$item->level1->kata_kunci or ''}}</td>
                                                            <td>{{$item->kataKunciKolaborasi->kata_kunci or ''}}</td>
                                                        </tr>
                                                        <?php $index++; ?>
                                                    @endforeach
                                                    </tbody>
                                                </table><b>Catatan bagi rekanan kolaborasi:</b></h5>
                                                <p style="text-align: justify">{{$proposal->catatan}}</p>
                                                <?php
                                                }else{
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <!--<tr>
                                            <td>
                                                <b><?php echo $labels["T2DI"]; ?></b><br><br>
                                                <?php
                                                if ($proposal->instansi <> null){
                                                ?>
                                                <table class="table table-striped table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                                    <tbody>
                                                    <tr>
                                                        <td>Nama Instansi</td>
                                                        <td>{{$proposal->instansi->nama_instansi}}</td>
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
                                        </tr>-->
                                        <tr>
                                            <td>
                                                <?php echo $labels["T3T"]; ?>
                                                <?php echo $labels["T3D"]; ?>
                                            </td>
                                        </tr>
                                        <!--<tr>
                                            <td>
                                                <b><?php echo $labels["T3DP"]; ?></b><br><br>
                                                <?php
                                                if (count($inovasiMember) > 0){
                                                ?>
                                                <table class="table table-striped table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
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
                                                <?php
                                                }else{
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                        </tr>-->
                                        <tr>
                                            <td>
                                                <b><?php echo $labels["T3F"]; ?></b><br><br>
                                                <?php
                                                if (count($proposal->file) > 0){
                                                ?>
                                                <table class="table table-striped table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
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
                                                    @foreach($proposal->file as $item)
                                                        <tr>
                                                            <td>{{$index}}</td>
                                                            <td><a href="<?php echo env('APP_URL'); ?>/admin/proposals/{{$item->id}}/download">{{$item->file}}</a></td>
                                                        </tr>
                                                        <?php $index++; ?>
                                                    @endforeach
                                                    </tbody>
                                                </table><hr>
                                                <?php
                                                }else{
                                                    echo '-';
                                                }
                                                if (count($proposal->url) > 0){
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
                                                    @foreach($proposal->url as $item)
                                                        <tr>
                                                            <td>{{$index}}</td>
                                                            <td><a href="{{$item->url}}" target="_blank">{{$item->url}}</a></td>
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
                                <div class="form-actions noborder">
                                    <button type="button" class="btn yellow" id="btnSimpan" name="btnSimpan"><i class="fa fa-save"></i> Simpan</button>
                                    <button type="button" class="btn red" id="btnBatal" name="btnBatal"><i class="fa fa-arrow-left"></i> Kembali</button>
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
    <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/juri/scripts/nilai.js" type="text/javascript"></script>
@stop
