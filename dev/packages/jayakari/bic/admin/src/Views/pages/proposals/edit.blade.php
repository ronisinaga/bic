@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Proposal
                <small>Lengkapi Proposal</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Proposal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Lengkapi Proposal</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Edit Proposal Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form ">
                            <?php
                            if (count($proposal[0]->message) > 0){
                            ?>
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>History Review - {{$proposal[0]->id}} - {{$proposal[0]->judul}}</div>&nbsp;&nbsp;&nbsp;
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
                                                    if (($item->id_receiver == 0) &&($item->id_sender == 0)){

                                                    }else{ ?>
                                                    <tr>
                                                        <td>{{$index}}</td>
                                                        <td style="display: none">{{$item->id}}</td>
                                                        <td><?php $tgl = new DateTime($item->inserted_date); echo $tgl->format("d M Y H:i:s"); ?></td>
                                                        <td>
                                                            <?php
                                                            if ($item->id_receiver == 0){
                                                                if ($item->user == null){
                                                                    //echo 'user tidak dikenal';
                                                                }else{
                                                                    echo $item->user->fullname;
                                                                }
                                                            }else{
                                                                echo "Reviewer";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" id="detailMessage" name="detailMessage">{{$item->judul}}</a>
                                                        </td>
                                                        <td style="display: none">{{$item->isi}}</td>
                                                    </tr>
                                                    <?php   } $index++; ?>
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
                                        <h2><b><i class="fa fa-cogs"></i>   {{$proposal[0]->id}} - {{$proposal[0]->judul}}</b></h2>
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="mt-element-step">
                                        <div class="row step-thin" style="cursor: pointer;cursor: hand">
                                            <div class="col-md-4 bg-grey done mt-step-col active" id="stepNaratif" name="stepNaratif">
                                                <div class="mt-step-number bg-white font-grey">1</div>
                                                <div class="mt-step-title uppercase font-grey-cascade"><?php echo $labels["T1T"]; ?></div>
                                                <div class="mt-step-content font-grey-cascade"><?php echo $labels["T1D"] ?></div>
                                            </div>
                                            <div class="col-md-4 bg-grey mt-step-col" id="stepDataPendukung" name="stepDataPendukung">
                                                <div class="mt-step-number bg-white font-grey">2</div>
                                                <div class="mt-step-title uppercase font-grey-cascade"><?php echo $labels["T2T"] ?></div>
                                                <div class="mt-step-content font-grey-cascade"><?php echo $labels["T2D"] ?></div>
                                            </div>
                                            <div class="col-md-4 bg-grey mt-step-col" id="stepFile" name="stepFile">
                                                <div class="mt-step-number bg-white font-grey">3</div>
                                                <div class="mt-step-title uppercase font-grey-cascade"><?php echo $labels["T3T"] ?></div>
                                                <div class="mt-step-content font-grey-cascade"><?php echo $labels["T3D"] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <form role="form">
                                        <input type="hidden" value="{{$proposal[0]->id}}" id="id" name="id"/>
                                        <div class="form-body" id="naratif" name="naratif" style="display: block">
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T1A"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="mt-step-desc">
                                                        <div class="caption-desc font-grey-cascade">
                                                            <?php echo $labels["T1AD"] ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="ckeditor form-control" id="abstrak" name="abstrak" rows="6" value="{{$proposal[0]->abstrak}}"></textarea>
                                                            <div class="control-label">
                                                                <span class="required"><?php echo $labels["CP"]?></span>
                                                            </div>
                                                            <!--<div class="form-actions noborder">
                                                                <button type="button" class="btn blue">Simpan</button>
                                                                <button type="button" class="btn default">Reset</button>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T1DK"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="mt-step-desc">
                                                        <div class="caption-desc font-grey-cascade">
                                                            <?php echo $labels["T1DKD"]; ?>
                                                        </div>
                                                    </div>
                                                    <div class="mt-step-desc">
                                                        <textarea class="ckeditor form-control"  id="deskripsi" name="deskripsi" rows="6" value="{{$proposal[0]->deskripsi}}"></textarea>
                                                        <div class="control-label">
                                                            <span class="required"><?php echo $labels["CP"]?></span>
                                                        </div><p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T1KT"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="mt-step-desc">
                                                        <div class="caption-desc font-grey-cascade">
                                                            <?php echo $labels["T1KTD"]; ?>
                                                        </div>
                                                    </div>
                                                    <div class="mt-step-desc">
                                                        <textarea class="ckeditor form-control"  id="keunggulan_teknologi" name="keunggulan_teknologi" rows="6" value="{{$proposal[0]->keunggulan_teknologi}}"></textarea>
                                                        <div class="control-label">
                                                            <span class="required"><?php echo $labels["CP"]?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T1PA"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="mt-step-desc">
                                                        <div class="caption-desc font-grey-cascade">
                                                            <?php echo $labels["T1PAD"]; ?>
                                                        </div>
                                                    </div>
                                                    <div class="mt-step-desc">
                                                        <textarea class="ckeditor form-control"  id="potensi_aplikasi" name="potensi_aplikasi" rows="6" value="{{$proposal[0]->potensi_aplikasi}}"></textarea>
                                                        <div class="control-label">
                                                            <span class="required"><?php echo $labels["CP"]?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-body" id="data_pendukung" name="data_pendukung" style="display: none;">
                                            <div class="portlet-body">
                                                <div class="portlet box purple">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T2TP"]); ?></div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php echo $labels["T2PTP"]; ?>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <td width="25%">
                                                                        <select id="selDevelopment" class="form-control select2" name="selDevelopment">
                                                                            <option value="0">-- Pilih salah satu --</option>
                                                                            @foreach($development as $item)
                                                                                <?php
                                                                                    if ((strtolower($item->kode) <> 'fase1') && (strtolower($item->kode) <> 'fase2') && (strtolower($item->kode) <> 'fase3') && (strtolower($item->kode) <> 'fase4')){
                                                                                        if ($proposal[0]->id_development == $item->id){
                                                                                            echo '<option value="'.$item->id.'" selected>'.$item->development.'</option>';
                                                                                        }else{
                                                                                            echo '<option value="'.$item->id.'">'.$item->development.'</option>';
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td width="75%">
                                                                        <div class="keterangan">
                                                                            <?php echo $labels["T2TPK"]; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <table>
                                                                <thead>
                                                                <tr>
                                                                    <th span="2">
                                                                        <!--<div class="form-actions noborder">
                                                                            <button type="button" class="btn purple">Simpan</button>
                                                                            <button type="button" class="btn default">Reset</button>
                                                                        </div>-->
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div><hr>
                                                <div class="portlet box purple">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T2H"]); ?></div>
                                                        <div class="tools">
                                                            <a href="javascript:;" class="collapse"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php echo $labels["T2PH"]; ?>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <td width="30%">
                                                                        <select id="selIPR" name="selIPR" class="form-control select2">
                                                                            <option value="0">-- Pilih salah satu --</option>
                                                                            @foreach($ipr as $item)
                                                                                <?php
                                                                                if (count($proposal[0]->ipr) > 0){
                                                                                    if ($proposal[0]->ipr[0]->id == $item->id){
                                                                                        echo '<option value="'.$item->id.'" selected>'.$item->ipr.'</option>';
                                                                                    }else{
                                                                                        echo '<option value="'.$item->id.'">'.$item->ipr.'</option>';
                                                                                    }
                                                                                }else{
                                                                                    echo '<option value="'.$item->id.'">'.$item->ipr.'</option>';
                                                                                }
                                                                                ?>
                                                                            @endforeach
                                                                        </select><br>
                                                                        <?php
                                                                        if (count($proposal[0]->ipr) > 0){
                                                                            if (($proposal[0]->ipr[0]->kode == "PATENT") || ($proposal[0]->ipr[0]->kode == "DAFTAR")){
                                                                                echo '<div class="row" id="patent" name="patent" style="display:block">';
                                                                            }else{
                                                                                echo '<div class="row" id="patent" name="patent" style="display:none">';
                                                                            }
                                                                        }else{
                                                                            echo '<div class="row" id="patent" name="patent" style="display:block">';
                                                                        }
                                                                        ?>
                                                                        <div class="col-md-12">
                                                                            <lable class="form-group">Nomor Paten/Pendaftaran</lable>
                                                                            <?php
                                                                            if (count($proposal[0]->ipr) > 0){
                                                                                $no_patent = $proposal[0]->ipr[0]->pivot->no_patent;
                                                                            }else{
                                                                                $no_patent = "";
                                                                            }
                                                                            ?>
                                                                            <input type="text" class="form-control" id="noPatent" name="noPatent" value="{{$no_patent}}"/>
                                                                        </div>
                                                        </div>
                                                        </td>
                                                        <td width="70%">
                                                            <div class="keterangan">
                                                                <?php echo $labels["T2HK"]; ?>
                                                            </div>
                                                            <div>

                                                            </div>
                                                        </td>
                                                        </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div><hr>
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T2KKT"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php echo $labels["T2PKKT"]; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo $labels["T2KKTL1"]; ?></label>
                                                            <select id="selKunciTeknologiLev1" name="selKunciTeknologiLev1" class="form-control select2">
                                                                <option value="0">-- Pilih salah satu --</option>
                                                                @foreach($kunciteknologi as $item)
                                                                    <?php
                                                                    if (count($proposal[0]->kataKunciTeknologi) > 0){
                                                                        $selected = $item->id == $proposal[0]->kataKunciTeknologi[0]->pivot->id_level_1?"selected":"";
                                                                    }else{
                                                                        $selected = "";
                                                                    }
                                                                    ?>
                                                                    <option value="{{$item->id}}" {{$selected}}>{{$item->kata_kunci}}</option>
                                                                @endforeach
                                                            </select><br>
                                                            <label class="control-label"><?php echo $labels["T2KKTL2"]; ?></label>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <select  id="selKunciTeknologiLev2" name="selKunciTeknologiLev2" class="form-control select2">
                                                                        <option value="0">-- Pilih salah satu --</option>
                                                                        @foreach($kunciteknologiLev2 as $item)
                                                                            <?php
                                                                            $selected = $item->id == $proposal[0]->kataKunciTeknologi[0]->pivot->id_level_2?"selected":"";
                                                                            ?>
                                                                            <option value="{{$item->id}}" {{$selected}}>{{$item->kata_kunci}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <!--<button type="button" class="btn red" id="addTeknologiLevel2" name="addTeknologiLevel2"><i class="fa fa-plus"></i> Pilih</button>-->
                                                                </div>
                                                            </div><br>
                                                            <label class="control-label"><?php echo $labels["T2KKTL3"]; ?></label>
                                                            <!--<dic class="row">
                                                                <div class="col-md-12">
                                                                    <?php echo $labels["T2PTP"]; ?>
                                                                </div>
                                                            </dic>-->
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <select  id="selKunciTeknologiLev3" name="selKunciTeknologiLev3" class="form-control select2">
                                                                        <option value="0">-- Pilih salah satu --</option>
                                                                        @foreach($kunciteknologiLev3 as $item)
                                                                            <option value="{{$item->id}}">{{$item->kata_kunci}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="btn red" id="addTeknologi" name="addTeknologi"><i class="fa fa-plus"></i> Pilih</button>
                                                                </div>
                                                            </div><br>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th style="display: none;">ID</th>
                                                                        <th>Kata Kunci Teknologi</th>
                                                                        <th style="display: none;">ID</th>
                                                                        <th>Level 2</th>
                                                                        <th style="display: none;">ID</th>
                                                                        <th>Level 1</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $index = 1;
                                                                    ?>
                                                                    @foreach($proposal[0]->kunciTeknologi as $item)
                                                                        <tr>
                                                                            <td>{{$index}}</td>
                                                                            <td style="display: none;">{{$item->id_kata_kunci}}</td>
                                                                            <td>{{$item->kataKunciTeknologi->kata_kunci or ''}}</td>
                                                                            <td style="display: none;">{{$item->id_level_2}}</td>
                                                                            <td>{{$item->level2->kata_kunci or ''}}</td>
                                                                            <td style="display: none;">{{$item->id_level_1}}</td>
                                                                            <td>{{$item->level1->kata_kunci or ''}}</td>
                                                                            <td><button type="button" class="btn red" id="removeTeknologi" name="removeTeknologi"><i class="fa fa-remove"></i> Hapus</button></td>
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
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T2KKA"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php echo $labels["T2PKKA"]; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo $labels["T2KKAL1"]; ?></label>
                                                            <select id="selKunciAplikasiLev1" name="selKunciAplikasiLev1" class="form-control select2">
                                                                <option value="0">-- Pilih salah satu --</option>
                                                                @foreach($kunciaplikasi as $item)
                                                                    <?php
                                                                    if (count($proposal[0]->kataKunciAplikasi) > 0){
                                                                        $selected = $item->id == $proposal[0]->kataKunciAplikasi[0]->pivot->id_level_1?"selected":"";
                                                                    }else{
                                                                        $selected = "";
                                                                    }
                                                                    ?>
                                                                    <option value="{{$item->id}}" {{$selected}}>{{$item->kata_kunci}}</option>
                                                                @endforeach
                                                            </select><br>
                                                            <label class="control-label"><?php echo $labels["T2KKAL2"]; ?></label>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <select id="selKunciAplikasiLev2" name="selKunciAplikasiLev2" class="form-control select2">
                                                                        <option value="0">-- Pilih salah satu --</option>
                                                                        @foreach($kunciaplikasiLev2 as $item)
                                                                            <?php
                                                                            $selected = $item->id == $proposal[0]->kataKunciAplikasi[0]->pivot->id_level_2?"selected":"";
                                                                            ?>
                                                                            <option value="{{$item->id}}" {{$selected}}>{{$item->kata_kunci}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <!--<button type="button" class="btn red" id="addAplikasiLevel2" name="addAplikasiLevel2"><i class="fa fa-plus"></i> Pilih</button>-->
                                                                </div>
                                                            </div><br>
                                                            <label class="control-label"><?php echo $labels["T2KKAL3"]; ?></label>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <select  id="selKunciAplikasiLev3" name="selKunciAplikasiLev3" class="form-control select2">
                                                                        <option value="0">-- Pilih salah satu --</option>
                                                                        @foreach($kunciaplikasiLev3 as $item)
                                                                            <option value="{{$item->id}}">{{$item->kata_kunci}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="btn red" id="addAplikasi" name="addAplikasi"><i class="fa fa-plus"></i> Pilih</button>
                                                                </div>
                                                            </div><br>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-bordered table-hover" id="tblAplikasiLevel3" name="tblAplikasiLevel3">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th style="display: none;">ID</th>
                                                                        <th>Kata Kunci Aplikasi</th>
                                                                        <th style="display: none;">ID</th>
                                                                        <th>Level 2</th>
                                                                        <th style="display: none;">ID</th>
                                                                        <th>Level 2</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $index = 1;
                                                                    ?>
                                                                    @foreach($proposal[0]->kunciAplikasi as $item)
                                                                        <tr>
                                                                            <td>{{$index}}</td>
                                                                            <td style="display: none;">{{$item->id_kata_kunci}}</td>
                                                                            <td>{{$item->kataKunciAplikasi->kata_kunci or ''}}</td>
                                                                            <td style="display: none;">{{$item->id_level_2}}</td>
                                                                            <td>{{$item->level2->kata_kunci or ''}}</td>
                                                                            <td style="display: none;">{{$item->id_level_1}}</td>
                                                                            <td>{{$item->level1->kata_kunci or ''}}</td>
                                                                            <td><button type="button" class="btn red" id="removeAplikasi" name="removeAplikasi"><i class="fa fa-remove"></i> Hapus</button></td>
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
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T2FBR"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php echo $labels["T2PFBR"]; ?>
                                                        </div>
                                                    </div>
                                                    <select id="selARN" class="form-control select2">
                                                        <option value="0">-- Pilih salah satu --</option>
                                                        @foreach($arn as $item)
                                                            <?php
                                                            if ($proposal[0]->id_arn == $item->id){
                                                                echo '<option value="'.$item->id.'" selected>'.$item->arn.'</option>';
                                                            }else{
                                                                echo '<option value="'.$item->id.'">'.$item->arn.'</option>';
                                                            }
                                                            ?>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T2K"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php echo $labels["T2PKYAI"]; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo $labels["T2KL1"]; ?></label>
                                                            <select id="selKolaborasi" name="selKolaborasi" class="form-control select2">
                                                                <option value="0">-- Pilih salah satu --</option>
                                                                @foreach($kolaborasi as $item)
                                                                    <?php
                                                                    $selected = "";
                                                                    if (count($proposal[0]->kataKunciKolaborasi) > 0){
                                                                        //$selected = $item->id == $proposal[0]->kataKunciKolaborasi[0]->pivot->id_level_1?"selected":"";
                                                                    }
                                                                    ?>
                                                                    <option value="{{$item->id}}" {{$selected}}>{{$item->kata_kunci}}</option>
                                                                @endforeach
                                                            </select><br>
                                                            <div class="checkbox-list" id="cbxKolaborasi" name="cbxKolaborasi">
                                                            @foreach($kolaborasiLev2 as $item)
                                                                <?php
                                                                $num = count($proposal[0]->kataKunciKolaborasi);
                                                                $found = false;
                                                                $checked = "";
                                                                for($i=0;$i<$num&&!$found;$i++){
                                                                    if ($item->id == $proposal[0]->kataKunciKolaborasi[$i]->id){
                                                                        $found = true;
                                                                        $checked = "checked";
                                                                    }
                                                                }
                                                                ?>
                                                                <!--<label><input type="checkbox" id="itemKolaborasi" name="itemKolaborasi" value="{{$item->id}}" text="{{$item->kata_kunci}}" {{$checked}}>{{$item->kata_kunci}}</label>-->
                                                                @endforeach
                                                            </div><br>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div>
                                                                        <button type="button" class="btn green" id="tambahKolaborasi" name="tambahKolaborasi"><i class="fa fa-plus"></i> Tambah</button>
                                                                    </div>
                                                                </div>
                                                            </div><br>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-bordered table-hover" id="tblKolaborasi" name="tblKolaborasi">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th style="display: none;">ID</th>
                                                                        <th>Kata Kunci Kolaborasi</th>
                                                                        <th style="display: none;">ID</th>
                                                                        <th>Jenis Kolaborasi</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $index = 1; ?>
                                                                    @foreach($proposalKolaborasi as $item)
                                                                        <tr>
                                                                            <td>{{$index}}</td>
                                                                            <td style="display: none;">{{$item->id_level_1}}</td>
                                                                            <td>
                                                                                <?php
                                                                                $num =count($kolaborasi);
                                                                                $found = false;
                                                                                for($i=0;$i<$num&&!$found;$i++){
                                                                                    if ($kolaborasi[$i]->id == $item->id_level_1){
                                                                                        $found = true;
                                                                                        echo $kolaborasi[$i]->kata_kunci;
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            <td style="display: none;">{{$item->id_kata_kunci}}</td>
                                                                            <td>
                                                                                <?php
                                                                                if ($item->id_kata_kunci == 0){

                                                                                }else{
                                                                                    echo $item->kataKunciKolaborasi->kata_kunci;
                                                                                }
                                                                                ?>
                                                                            </td>
                                                                            <td><button type="button" class="btn red" id="removeKolaborasi" name="removeKolaborasi"><i class="fa fa-trash"></i> Hapus</button></td>
                                                                        </tr>
                                                                        <?php $index++ ?>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T2CBMK"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <p>Catatan bagi mitra kolaborasi, misalnya:</p>
                                                                <i class="fa fa-arrow-right"></i> Kontribusi dari mitra:<br>
                                                                <i class="fa fa-arrow-right"></i> Tipe mitra yang diinginkan:<br>
                                                                <i class="fa fa-arrow-right"></i> Bidang aktivitas mitra:<br>
                                                                <i class="fa fa-arrow-right"></i> Bentuk kerjasama:<br>
                                                                <i class="fa fa-arrow-right"></i> Lainnya...:
                                                            </div>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" rows="10" id="catatan" name="catatan">{{$proposal[0]->catatan}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="portlet box purple">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T2DI"]); ?></div>
                                                    <div class="tools">
                                                        <a href="javascript:;" class="collapse"> </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Institusi:</label>
                                                        <?php
                                                        $institusi = "";
                                                        $employees = 0;
                                                        $bidangusaha = array();
                                                        if ($proposal[0]->instansi <> null){
                                                            $institusi = $proposal[0]->instansi->nama_instansi;
                                                            $employees = $proposal[0]->instansi->id_employee;
                                                            $bidangusaha = explode(',',$proposal[0]->instansi->bidang_usaha);
                                                        }
                                                        ?>
                                                        <input type="text" id="institusi" name="institusi" class="form-control" placeholder="Nama Institusi" value="{{$institusi}}"><hr>
                                                        <label class="control-label">Bidang Usaha Institusi:</label>
                                                        <div class="input-group">
                                                            <div class="icheck-list">
                                                                <!--<div class="checkbox-list" id="cbxBidang" name="cbxBidang">-->
                                                                @foreach($instansi as $item)
                                                                    <label>
                                                                    <?php
                                                                    $checked = "";
                                                                    $found = false;
                                                                    $num = count($bidangusaha);
                                                                    for($i=0;$i<$num&&!$found;$i++){
                                                                        if($bidangusaha[$i] == $item->id){
                                                                            $found = true;
                                                                            $checked = 'checked';
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <!--<input type="checkbox" id="instansi" name="instansi" value="{{$item->id}}" {{$checked}}> {{$item->instansi}}-->
                                                                        <input type="radio" name="instansi" id="instansi" class="icheck" value="{{$item->id}}" {{$checked}}> {{$item->instansi}}
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div><hr>
                                                        <label class="control-label">Jumlah Karyawan:</label>
                                                        <select class="form-control select2" id="selEmployee" name="selEmployee">
                                                            <option value="0">--Pilih jumlah karyawan--</option>
                                                            @foreach($employee as $item)
                                                                <?php $selected = $employees == $item->id?"selected":""; ?>
                                                                <option value="{{$item->id}}" {{$selected}}>{{$item->employee}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-body" id="data_file" name="data_file" style="display: none;">

                                    <div class="portlet box purple">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T3DP"]); ?></div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php echo $labels["T3PDP"]; ?>
                                                </div>
                                            </div><hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3>Tim Peneliti Proposal Ini</h3>
                                                    <table class="table table-striped table-bordered table-hover" id="tblChosenInovatorMember" name="tblChosenInovatorMember">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th style="display: none">ID</th>
                                                            <th>Nama</th>
                                                            <th style="display: none">ID Jabatan</th>
                                                            <th>Jabatan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $index = 1 ?>
                                                        @foreach($proposal[0]->inovatorMember as $item)
                                                            <tr>
                                                                <td>{{$index}}</td>
                                                                <td style="display: none">{{$item->pivot->id_inovator_member}}</td>
                                                                <td>{{$item->name}}</td>
                                                                <td style="display: none">{{$item->pivot->id_rsc}}</td>
                                                                <td>
                                                                    <?php
                                                                    $found = false;
                                                                    $num = count($rsc);
                                                                    for($i=0;$i<$num&&!$found;$i++){
                                                                        if ($item->pivot->id_rsc == $rsc[$i]->id){
                                                                            $found = true;
                                                                            echo $rsc[$i]->rsc;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><button type="button" class="btn green" id="editChosenMember" name="editChosenMember"><i class="fa fa-pencil"></i> Edit</button><button type="button" class="btn red" id="hapusChosenMember" name="hapusChosenMember"><i class="fa fa-remove"></i> Hapus</button></td></td>
                                                            </tr>
                                                            <?php $index++; ?>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="page-toolbar">
                                                        <div class="btn-group pull-left">
                                                            <h3>Daftar Peneliti</h3>
                                                        </div>
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn blue" id="tambahTim" name="tambahTim"><i class="fa fa-plus"></i> Tambah Peneliti</button>
                                                        </div>
                                                    </div>
                                                    <table class="table table-striped table-bordered table-hover" id="tblInovatorMember" name="tblInovatorMember">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $index = 1;
                                                        ?>
                                                        @foreach($proposal[0]->user->inovatorMember as $item)
                                                            <tr>
                                                                <td>{{$index}}</td>
                                                                <td style="display: none">{{$item->id}}</td>
                                                                <td style="display: none">{{$item->email}}</td>
                                                                <td style="display: none">{{$item->telp}}</td>
                                                                <td style="display: none">{{$item->alamat}}</td>
                                                                <td>{{$item->name}}</td>
                                                                <td style="display: none">{{$item->institusi}}</td>
                                                                <td><button type="button" class="btn blue" id="pilihMember" name="pilihMember"><i class="fa fa-check"></i> Pilih</button><button type="button" class="btn green" id="editMember" name="editMember"><i class="fa fa-pencil"></i> Edit</button><button type="button" class="btn red" id="removeMember" name="removeMember"><i class="fa fa-remove"></i> Hapus</button></td>
                                                            </tr>
                                                            <?php $index++ ?>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="portlet box purple">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i><?php echo strip_tags($labels["T3F"]); ?></div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php echo $labels["T3PDFP"]; ?>
                                                </div>
                                            </div><hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="page-toolbar">
                                                        <div class="btn-group pull-left">
                                                            <h3>File yang terkait dengan proposal inovasi</h3>
                                                        </div>
                                                        <div class="btn-group pull-right">
                                                            <?php
                                                            if (count($proposal[0]->file) == 3){
                                                                echo '<button type="button" class="btn blue" id="tambahFile" name="tambahFile" disabled><i class="fa fa-plus"></i> Tambah File</button>';
                                                            }else{
                                                                echo '<button type="button" class="btn blue" id="tambahFile" name="tambahFile"><i class="fa fa-plus"></i> Tambah File</button>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <table class="table table-striped table-bordered table-hover" id="tblFileProposal" name="tblFileProposal">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th style="display: none;">ID</th>
                                                            <th>Nama File</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $index =1 ?>
                                                        @foreach($proposal[0]->file as $item)
                                                            <tr>
                                                                <td>{{$index}}</td>
                                                                <td style="display:none;">{{$item->id}}</td>
                                                                <td><a href="<?php echo env('APP_URL'); ?>/public{{$item->public_path}}">{{$item->file}}</a></td>
                                                                <td><button type="button" class="btn red" id="deleteFile" name="deleteFile"><i class="fa fa-remove"></i> Hapus File</button></td>
                                                            </tr>
                                                            <?php $index++; ?>
                                                        @endforeach
                                                        </tbody>
                                                    </table><hr>
                                                    <div class="page-toolbar">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <p>Alamat URL terkait proposal</p>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input type="text" id="url" name="url" class="form-control">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="pull-right">
                                                                    <?php
                                                                        if (count($proposal[0]->url) == 3){
                                                                            echo '<button type="button" class="btn blue" id="tambahUrl" name="tambahUrl" disabled><i class="fa fa-plus"></i> Tambah URL</button>';
                                                                        }else{
                                                                            echo '<button type="button" class="btn blue" id="tambahUrl" name="tambahUrl"><i class="fa fa-plus"></i> Tambah URL</button>';
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div><hr>
                                                        <table class="table table-striped table-bordered table-hover" id="tblUrlProposal" name="tblUrlProposal">
                                                            <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th style="display: none;">ID</th>
                                                                <th>Url</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $index =1 ?>
                                                            @foreach($proposal[0]->url as $item)
                                                                <tr>
                                                                    <td>{{$index}}</td>
                                                                    <td style="display:none;">{{$item->id}}</td>
                                                                    <td><a href="{{$item->url}}" target="_blank">{{$item->url}}</a></td>
                                                                    <td><button type="button" class="btn red" id="deleteURL" name="deleteURL"><i class="fa fa-remove"></i> Hapus URL</button></td>
                                                                </tr>
                                                                <?php $index++; ?>
                                                            @endforeach
                                                            </tbody>
                                                        </table><hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="button" class="btn blue" id="btnBefore" name="btnBefore"><i class="fa fa-arrow-left"></i> Sebelumnya</button>
                                    <button type="button" class="btn green" id="btnNext" name="btnNext">Berikutnya <i class="fa fa-arrow-right"></i></button>
                                    <button type="button" class="btn red" id="btnSimpan" name="btnSimpan"><i class="fa fa-floppy-o"></i> Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="popupAddMember"tabindex="-1" name="popupAddMember" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Data Member</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-2">Nama</label>
                            <div class="col-md-10">
                                <input type="text" id="popupNama" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Institusi</label>
                            <div class="col-md-10">
                                <input type="text" id="popupInstitusi" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="text" id="popupEmail" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Telepon</label>
                            <div class="col-md-10">
                                <input type="text" id="popupTelepon" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Alamat</label>
                            <div class="col-md-10">
                                <textarea type="text" id="popupAlamat" class="form-control"></textarea>
                            </div>
                        </div><br>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal"><i class="fa fa-close"></i> Tutup</button>
                    <button type="button" class="btn btn-primary" id="tambahMember"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="popupEditMember"tabindex="-1" name="popupEditMember" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit Data Member</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-2">Nama</label>
                            <div class="col-md-10">
                                <input type="text" id="popupEditNama" class="form-control"/>
                                <input type="hidden" id="popupEditID" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Institusi</label>
                            <div class="auto col-md-10">
                                <input type="text" id="popupEditInstitusi" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="text" id="popupEditEmail" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Telepon</label>
                            <div class="col-md-10">
                                <input type="text" id="popupEditTelepon" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Alamat</label>
                            <div class="col-md-10">
                                <textarea type="text" id="popupEditAlamat" class="form-control"></textarea>
                            </div>
                        </div><br>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal"><i class="fa fa-close"></i> Tutup</button>
                    <button type="button" class="btn btn-primary" id="updateMember"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="popupPilihMember"tabindex="-1" name="popupPilihMember" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Pilih Posisi Member</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input type="text" id="popupPilihNama" class="form-control" disabled/>
                                <input type="hidden" id="popupPilihID" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-3">Posisi Dalam Tim</label>
                            <div class="col-md-9">
                                <select class="form-control" id="selRSC" name="selRSC">
                                    <option value="0">-- Pilih Posisi --</option>
                                    @foreach($rsc as $item)
                                        <option value="{{$item->id}}">{{$item->rsc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal">Close</button>
                    <button type="button" class="btn btn-primary" id="chooseMember">Pilih</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="popupEditChosenMember"tabindex="-1" name="popupEditChosenMember" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Pilih Posisi Member</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input type="text" id="popupEditChosenNama" class="form-control" disabled/>
                                <input type="hidden" id="popupEditChosenID" class="form-control"/>
                                <input type="hidden" id="popupSelChosenID" class="form-control"/>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-3">Posisi Dalam Tim</label>
                            <div class="col-md-9">
                                <select class="form-control" id="selEditChosenRSC" name="selEditChosenRSC">
                                    <option value="0">-- Pilih Posisi --</option>
                                    @foreach($rsc as $item)
                                        <option value="{{$item->id}}">{{$item->rsc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><br>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateChosenMember">Pilih</button>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="popupUploadFile"tabindex="-1" name="popupUploadFile" role="dialog">
        <div class="modal-dialog">
            <form action="<?php echo env('APP_URL'); ?>/admin/inovator/proposal/uploadFile" enctype="multipart/form-data" id="formUpload" name="formUpload">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Pilih file yang terkait dengan proposal inovasi</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Pilih File</label>
                            <div class="col-md-3">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group">
                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                            <span class="fileinput-filename"> </span>
                                        </div>
                                        <span class="input-group-addon btn default btn-file">
                                        <span class="fileinput-new"> Select file </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="files" id="files"> </span>
                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="batal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateChosenMember">Upload</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
@section('footer_page')
        <script src="<?php echo env('APP_URL'); ?>/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script type="text/javascript">
        var tabValue = "<?php echo $tab ?>";
        //var abstrak = JSON.stringify('<?php echo $proposal[0]->abstrak ?>');
        $('textarea#abstrak').val('<?php echo $proposal[0]->abstrak ?>');
        $('textarea#deskripsi').val('<?php echo $proposal[0]->deskripsi; ?>');
        $('textarea#keunggulan_teknologi').val('<?php echo $proposal[0]->keunggulan_teknologi; ?>');
        $('textarea#potensi_aplikasi').val('<?php echo $proposal[0]->potensi_aplikasi; ?>');

        CKEDITOR.replace( 'abstrak', {
            customConfig: '/assets/ckeditor/custom/abstrak.js'
        });
        CKEDITOR.replace( 'deskripsi', {
            customConfig: '/assets/ckeditor/custom/deskripsi.js'
        });
        CKEDITOR.replace( 'keunggulan_teknologi', {
            customConfig: '/assets/ckeditor/custom/teknologi.js'
        });
        CKEDITOR.replace( 'potensi_aplikasi', {
            customConfig: '/assets/ckeditor/custom/aplikasi.js'
        });
    </script>
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
    <script type="text/javascript">
        host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/scripts/editproposal.js" type="text/javascript"></script>
    <script src="<?php echo env('APP_URL'); ?>/assets/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
@stop
