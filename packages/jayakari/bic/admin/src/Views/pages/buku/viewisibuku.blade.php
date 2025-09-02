@extends('jayakari.bic.admin::layouts.default')
@section('header_page')
    <link href="<?php echo  env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/jquery_multi_select/css/jquery.multiselect.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/buku/css/create.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="processing"></div>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Manajemen Buku
                <small>Buat Isi Buku</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-diamond"></i>
                        <a href="javascript:;">Manajemen Buku</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Buat Isi Buku</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Buat Isi Buku Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-green">
                                <i class="icon-pin font-green"></i>
                                <span class="caption-subject bold uppercase">{{$buku->judul}}</span>
                                <input type="hidden" id="id" name="id" value="{{$isibuku->id}}"/>
                                <input type="hidden" id="id_buku" name="id_buku" value="{{$buku->id}}"/>
                                <input type="hidden" id="id_proposal" name="id_proposal" value="{{$proposal->id}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="menu">Agenda Riset Nasional</label>
                                        <select class="form-control" id="selARN" name="selARN">
                                            <option value="0" selected>Pilih Agenda Riset Nasional</option>
                                            @foreach($arn as $item)
                                                <option value="{{$item->id}}" <?php $selected = $isibuku->id_arn==$item->id?"selected":""; echo $selected; ?>>ARN : {{$item->arn}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Kategori Teknologi (Berdasarkan IRC)</label>
                                        <select class="form-control" name="selIRC" id="selIRC" multiple="multiple" size="11">
                                            @foreach($irc as $item)
                                                <?php
                                                $teknologi = explode(",",$isibuku->id_teknologi);
                                                $found = false;
                                                $num =count($teknologi);
                                                for($i=0;$i<$num&&!$found;$i++){
                                                    if ($teknologi[$i] == $item->id){
                                                        $found = true;
                                                    }
                                                }
                                                if ($found){
                                                    echo '<option value="'.$item->id.'" selected>'.$item->kata_kunci.'</option>';
                                                }else{
                                                    echo '<option value="'.$item->id.'">'.$item->kata_kunci.'</option>';
                                                }
                                                ?>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Kategori Aplikasi (Berdasarkan IRC)</label>
                                        <select class="form-control" name="selAplikasi" id="selAplikasi" multiple="multiple" size="9">
                                            @foreach($aplikasi as $item)
                                                <?php
                                                $aplikasi = explode(",",$isibuku->id_aplikasi);
                                                $found = false;
                                                $num =count($aplikasi);
                                                for($i=0;$i<$num&&!$found;$i++){
                                                    if ($aplikasi[$i] == $item->id){
                                                        $found = true;
                                                    }
                                                }
                                                if ($found){
                                                    echo '<option value="'.$item->id.'" selected>'.$item->kata_kunci.'</option>';
                                                }else{
                                                    echo '<option value="'.$item->id.'">'.$item->kata_kunci.'</option>';
                                                }
                                                ?>
                                            @endforeach
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="judul_singkat" name="judul_singkat" value="{{$isibuku->judul_singkat}}">
                                        <label for="menu">Judul Singkat</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="short_title" name="short_title" value="{{$isibuku->short_title}}">
                                        <label for="menu">Short Title (English)</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Judul Teknis Lengkap</label>
                                        <textarea class="form-control" id="judul_teknis_lengkap" name="judul_teknis_lengkap">{{$isibuku->judul_lengkap}}</textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Deskripsi Singkat</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{$isibuku->deskripsi_singkat}}</textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Short Description</label>
                                        <textarea class="form-control" id="description" name="description">{{$isibuku->short_description}}</textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Perspektif</label>
                                        <textarea class="form-control" id="perspektif" name="perspektif">{{$isibuku->perspektif}}</textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Keunggulan Inovasi</label>
                                        <textarea class="form-control" id="keunggulan_inovasi" name="keunggulan_inovasi">{{$isibuku->keunggulan_inovasi}}</textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Potensi Aplikasi</label>
                                        <textarea class="form-control" id="potensi_aplikasi" name="potensi_aplikasi">{{$isibuku->potensi_aplikasi}}</textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Nama Inovator</label>
                                        <textarea class="form-control" id="inovator" name="inovator">{{$isibuku->inovator}}</textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <input type="text" class="form-control" id="institusi" name="institusi" value="{{$isibuku->institusi}}">
                                        <label for="menu">Institusi</label>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat">{{$isibuku->alamat}}</textarea>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Status Paten</label>
                                        <select class="form-control" name="selStatusPaten" id="selStatusPaten">
                                            <option value="0">-- Pilih Status Patent --</option>
                                            <option value="1" <?php $selected = $isibuku->id_paten ==1?"selected":""; echo $selected ?>>Telah Terdaftar</option>
                                            <option value="2" <?php $selected = $isibuku->id_paten ==2?"selected":""; echo $selected ?>>Dalam Proses Pengajuan</option>
                                            <option value="3" <?php $selected = $isibuku->id_paten ==3?"selected":""; echo $selected ?>>Belum Didaftarkan</option>
                                            <option value="4" <?php $selected = $isibuku->id_paten ==4?"selected":""; echo $selected ?>>Tidak Ingin Didaftarkan</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Kesiapan Inovasi</label>
                                        <select class="form-control" name="selKesiapanInovasi" id="selKesiapanInovasi">
                                            <option value="0">-- Pilih Kesiapan Inovasi --</option>
                                            <option value="1" <?php $selected = $isibuku->id_kesiapan_inovasi ==1?"selected":""; echo $selected ?>>*** Telah Dikomersialkan</option>
                                            <option value="2" <?php $selected = $isibuku->id_kesiapan_inovasi ==2?"selected":""; echo $selected ?>>** Siap Dikomersialkan</option>
                                            <option value="3" <?php $selected = $isibuku->id_kesiapan_inovasi ==3?"selected":""; echo $selected ?>>* Prototype</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Kerjasama Bisnis</label>
                                        <select class="form-control" name="selKerjasamaBisnis" id="selKerjasamaBisnis">
                                            <option value="0">-- Pilih Kerjasama Bisnis --</option>
                                            <option value="1" <?php $selected = $isibuku->id_kerjasama_bisnis ==1?"selected":""; echo $selected ?>>*** Terbuka</option>
                                            <option value="2" <?php $selected = $isibuku->id_kerjasama_bisnis ==2?"selected":""; echo $selected ?>>** Luas</option>
                                            <option value="3" <?php $selected = $isibuku->id_kerjasama_bisnis ==3?"selected":""; echo $selected ?>>* Terbatas</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu">Peringkat Inovasi</label>
                                        <select class="form-control" name="selPeringkatInovasi" id="selPeringkatInovasi">
                                            <option value="0">-- Pilih Peringkat Inovasi--</option>
                                            <option value="1" <?php $selected = $isibuku->id_peringkat_inovasi ==1?"selected":""; echo $selected ?>>*** Paling Prospektif</option>
                                            <option value="2" <?php $selected = $isibuku->id_peringkat_inovasi ==2?"selected":""; echo $selected ?>>** Sangat Prospektif</option>
                                            <option value="3" <?php $selected = $isibuku->id_peringkat_inovasi ==3?"selected":""; echo $selected ?>>* Prospektif</option>
                                        </select>
                                        <span class="help-block">Harus diisi*</span>
                                    </div>
                                </div>
                                <div class="form-actions noborder">
                                    <button type="button" class="btn blue" id="btnSimpan" name="btnSimpan"><i class="fa fa-floppy-o"></i> Update</button>
                                    <button type="button" class="btn default" id="btnBatal" name="btnBatal"><i class="fa fa-undo"></i> Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-green">
                                <i class="icon-pin font-green"></i>
                                <span class="caption-subject bold uppercase">{{$proposal->judul}}</span>
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
                                        <p style="text-align: justify"><?php echo $proposal->abstrak; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>2. Deskripsi Lengkap (<5.000 karakter)</b></p>
                                        <p style="text-align: justify"><?php echo $proposal->deskripsi; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>3. Keunggulan Teknologi yang Anda tawarkan</b></p>
                                        <p style="text-align: justify"><?php echo $proposal->keunggulan_teknologi; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p><b>4. Potensi aplikasi dari inovasi Anda</b></p>
                                        <p style="text-align: justify"><?php echo $proposal->potensi_aplikasi; ?></p>
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
                                        if (count($proposal->development) > 0){
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
                                        <p><b>2. Kebutuhan akan proteksi HAKI</b></p>
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
                                        <p><b>3. Kata Kunci Teknologi</b></p>
                                        <?php
                                        if (count($proposal->kataKunciTeknologi) > 0){
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
                                            @foreach($proposal->kataKunciTeknologi as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$kunciTeknologiLevel1[0]->kata_kunci}}</td>
                                                    <td>{{$kunciTeknologiLevel2[0]->kata_kunci}}</td>
                                                    <td>{{$item->kata_kunci}}</td>
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
                                        if (count($proposal->kataKunciAplikasi) > 0){
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
                                            @foreach($proposal->kataKunciAplikasi as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$kunciAplikasiLevel1[0]->kata_kunci}}</td>
                                                    <td>{{$kunciAplikasiLevel2[0]->kata_kunci}}</td>
                                                    <td>{{$item->kata_kunci}}</td>
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
                                        if (count($proposal->arn) > 0){
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
                                        <p><b>6. Kolaborasi yang Anda inginkan</b></p>
                                        <?php
                                        if (count($proposal->kataKunciKolaborasi) > 0){
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
                                            @foreach($proposal->kataKunciKolaborasi as $item)
                                                <tr>
                                                    <td>{{$index}}</td>
                                                    <td>{{$kunciKolaborasiLevel1[0]->kata_kunci}}</td>
                                                    <td>{{$item->kata_kunci}}</td>
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
                                        <p><b>7. Data Institusi</b></p>
                                        <?php
                                        if (count($proposal->instansi) > 0){
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
                                                <td><b>{{$proposal->user->fullname}} ({{$proposal->user->email}})</b></td>
                                                <td><b>Pembuat dan Pengupload Proposal</b></td>
                                            </tr>
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
                                                <td><b>{{$proposal->user->fullname}}</b></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo  env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/jquery_multi_select/scripts/jquery.multiselect.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/ckeditor492/ckeditor.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/public/jayakari/bic/admin/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
@stop
