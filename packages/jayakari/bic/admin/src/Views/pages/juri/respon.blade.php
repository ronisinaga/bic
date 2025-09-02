@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/proposals/css/pages.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Pendapat Teknis
                <small>Isi pendapat teknis</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Pendapat Teknis</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Isi pendapat teknis</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Pendapat Teknis Content
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
                                        <span class="caption-subject bold uppercase"> Pendapat Teknis Juri</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>{{$teknis->proposal->judul}}</div>&nbsp;&nbsp;&nbsp;
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <input type="hidden" id="id" name="id" value="{{$teknis->id}}"/>
                                        <textarea class="form-control ckeditor" id="isi" name="isi" row="5"></textarea>
                                    </div>
                                </div><hr>
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>Detail Proposal</div>&nbsp;&nbsp;&nbsp;
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">

                                            <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T1T"]; ?>
                                                    <?php echo $labels["T1D"] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b><?php echo $labels["T1A"]; ?></b><br>
                                                    <p style="text-align: justify">{{$proposal->abstrak}}</p>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b><?php echo $labels["T1DK"]; ?></b><br>
                                                    <p style="text-align: justify">{{$proposal->deskripsi}}</p>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b><?php echo $labels["T1KT"]; ?></b><br>
                                                    <p style="text-align: justify">{{$proposal->keunggulan_teknologi}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b><?php echo $labels["T1PA"]; ?></b><br>
                                                    <p style="text-align: justify">{{$proposal->potensi_aplikasi}}</p>
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
                                                    <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
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
                                            <tr>
                                                <td>
                                                    <b><?php echo $labels["T2DI"]; ?></b><br><br>
                                                    <?php
                                                    if ($proposal->instansi <> null){
                                                    ?>
                                                    <table class="table table-striped table-bordered table-hover" id="tblTeknologiLevel3" name="tblTeknologiLevel3">
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
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $labels["T3T"]; ?>
                                                    <?php echo $labels["T3D"]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b><?php echo $labels["T3DP"]; ?></b><br><br>
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
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b><?php echo $labels["T3F"]; ?></b><br><br>
                                                    <?php
                                                    if (count($proposal->file) > 0){
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
                                                        @foreach($proposal->file as $item)
                                                            <tr>
                                                                <td>{{$index}}</td>
                                                                <td><a href="<?php echo env('APP_URL'); ?>/admin/proposals/{{$item->id}}/download">{{$item->file}}</a></td>
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
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/admin/pages/juri/scripts/respon.js" type="text/javascript"></script>
@stop
