@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link rel="stylesheet" href="<?php echo env('APP_URL'); ?>/assets/magnific-popup/css/magnific-popup.css" />
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet"  type="text/css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css' rel='stylesheet'  type="text/css">
    <link href="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/index.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/css/portfolio.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <!-- BEGIN SLIDER -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" id="kategori" name="kategori" value="{{$kategori}}">
                    <select class="form-control" id="selJudul" name="selJudul">
                        <option value="judul" <?php $selected = $sort == 'judul'?"selected":""; echo $selected; ?>>Judul Singkat</option>
                        <option value="title" <?php $selected = $sort == 'title'?"selected":""; echo $selected; ?>>Short Title</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <a href="javascript:;" onclick="findBuku('a');">A</a>
                    <a href="javascript:;" onclick="findBuku('b');">B</a>
                    <a href="javascript:;" onclick="findBuku('c');">C</a>
                    <a href="javascript:;" onclick="findBuku('d');">D</a>
                    <a href="javascript:;" onclick="findBuku('e');">E</a>
                    <a href="javascript:;" onclick="findBuku('f');">F</a>
                    <a href="javascript:;" onclick="findBuku('g');">G</a>
                    <a href="javascript:;" onclick="findBuku('h');">H</a>
                    <a href="javascript:;" onclick="findBuku('i');">I</a>
                    <a href="javascript:;" onclick="findBuku('j');">J</a>
                    <a href="javascript:;" onclick="findBuku('k');">K</a>
                    <a href="javascript:;" onclick="findBuku('l');">L</a>
                    <a href="javascript:;" onclick="findBuku('m');">M</a>
                    <a href="javascript:;" onclick="findBuku('n');">N</a>
                    <a href="javascript:;" onclick="findBuku('o');">O</a>
                    <a href="javascript:;" onclick="findBuku('p');">P</a>
                    <a href="javascript:;" onclick="findBuku('q');">Q</a>
                    <a href="javascript:;" onclick="findBuku('r');">R</a>
                    <a href="javascript:;" onclick="findBuku('s');">S</a>
                    <a href="javascript:;" onclick="findBuku('t');">T</a>
                    <a href="javascript:;" onclick="findBuku('u');">U</a>
                    <a href="javascript:;" onclick="findBuku('v');">V</a>
                    <a href="javascript:;" onclick="findBuku('w');">W</a>
                    <a href="javascript:;" onclick="findBuku('x');">X</a>
                    <a href="javascript:;" onclick="findBuku('y');">Y</a>
                    <a href="javascript:;" onclick="findBuku('z');">Z</a>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $num = count($isibuku);
                        for($i=0;$i<$num;$i=$i+2){
                            echo '<tr>';
                            if ($num > $i+1){
                                echo '<td>';
                            }else{
                                echo '<td colspan="2">';
                            }
                            echo '<div class="service-box">';
                            echo '<div class="col-md-12">';
                            $url = urlencode($isibuku[$i]->judul_singkat);
                            echo '<h4><a href="'.env('APP_URL').'/general/view/'.$url.'">'.$isibuku[$i]->judul_singkat.'</a></h4>';
                            echo '<h4><i><a href="'.env('APP_URL').'/general/view/'.$url.'">'.$isibuku[$i]->short_title.'</a></i></h4><hr>';
                            echo '<p>'.$isibuku[$i]->judul_lengkap.'</p>';
                            $paten = "";
                            switch ($isibuku[$i]->id_paten){
                                case "1":
                                    $paten = "Telah Terdaftar";
                                    break;
                                case "2":
                                    $paten = "Dalam Proses Pengajuan";
                                    break;
                                case "3":
                                    $paten = "Belum Didaftarkan";
                                    break;
                                case "4":
                                    $paten = "Tidak Ingin Didaftarkan";
                                    break;
                            }
                            echo '<p><b>Status Paten:</b> '.$paten.'</p>';
                            $kesiapanInovasi = "";
                            switch ($isibuku[$i]->id_kesiapan_inovasi){
                                case "1":
                                    $kesiapanInovasi = "*** Telah Dikomersialkan";
                                    break;
                                case "2":
                                    $kesiapanInovasi = "** Siap Dikomersialkan";
                                    break;
                                case "3":
                                    $kesiapanInovasi = "* Prototype";
                                    break;
                            }
                            echo '<p><b>Kesiapan Inovasi:</b> '.$kesiapanInovasi.'</p>';
                            $kerjasamaBisnis = "";
                            switch ($isibuku[$i]->id_kerjasama_bisnis){
                                case "1":
                                    $kerjasamaBisnis = "*** Terbuka";
                                    break;
                                case "2":
                                    $kerjasamaBisnis = "** Luas";
                                    break;
                                case "3":
                                    $kerjasamaBisnis = "* Terbatas";
                                    break;
                            }
                            echo '<p><b>Kerjasama Bisnis:</b> '.$kerjasamaBisnis.'</p>';
                            $peringkatInovasi = "";
                            switch ($isibuku[$i]->id_peringkat_inovasi){
                                case "1":
                                    $peringkatInovasi = "*** Paling Prospektif";
                                    break;
                                case "2":
                                    $peringkatInovasi = "** Sangat Prospektif";
                                    break;
                                case "3":
                                    $peringkatInovasi = "* Prospektif";
                                    break;
                            }
                            echo '<p><b>Peringkat Inovasi:</b> '.$kerjasamaBisnis.'</p>';
                            echo '<div class="content-page">';
                            echo '<div class="filter-v1">';
                            echo '<div class="row mix-grid thumbnails">';
                            /*$number = count($isibuku[$i]->file);
                            if ($number > 0){
                                echo '<div class="col-md-6 col-sm-6 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                echo '<div class="mix-inner">';
                                //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku[$i]->file[0]->path.'" class="img-responsive">';
                                echo '<div class="mix-details">';
                                echo '<p style="color:#fff">'.$isibuku[$i]->file[0]->keterangan.'</p>';
                                echo '<a href="'.env('APP_URL').'/general/download/'.$isibuku[$i]->file[0]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                if ($number >= 2){
                                    echo '<div class="col-md-6 col-sm-6 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                    echo '<div class="mix-inner">';
                                    //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                    echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku[$i]->file[1]->path.'" class="img-responsive">';
                                    echo '<div class="mix-details">';
                                    echo '<p style="color:#fff">'.$isibuku[$i]->file[1]->keterangan.'</p>';
                                    echo '<a href="'.env('APP_URL').'/general/download/'.$isibuku[$i]->file[1]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }*/
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</td>';
                            if ($num > $i+1){
                                echo '<td>';
                                echo '<div class="row service-box ">';
                                echo '<div class="col-md-12">';
                                echo '<h4><a href="'.env('APP_URL').'/general/view/'.$isibuku[$i+1]->judul_singkat.'">'.$isibuku[$i+1]->judul_singkat.'</a></h4>';
                                echo '<h4><i><a href="'.env('APP_URL').'/general/view/'.$isibuku[$i+1]->judul_singkat.'">'.$isibuku[$i+1]->short_title.'</a></i></h4><hr>';
                                echo '<p>'.$isibuku[$i+1]->judul_lengkap.'</p>';
                                $paten = "";
                                switch ($isibuku[$i+1]->id_paten){
                                    case "1":
                                        $paten = "Telah Terdaftar";
                                        break;
                                    case "2":
                                        $paten = "Dalam Proses Pengajuan";
                                        break;
                                    case "3":
                                        $paten = "Belum Didaftarkan";
                                        break;
                                    case "4":
                                        $paten = "Tidak Ingin Didaftarkan";
                                        break;
                                }
                                echo '<p><b>Status Paten:</b> '.$paten.'</p>';
                                $kesiapanInovasi = "";
                                switch ($isibuku[$i+1]->id_kesiapan_inovasi){
                                    case "1":
                                        $kesiapanInovasi = "*** Telah Dikomersialkan";
                                        break;
                                    case "2":
                                        $kesiapanInovasi = "** Siap Dikomersialkan";
                                        break;
                                    case "3":
                                        $kesiapanInovasi = "* Prototype";
                                        break;
                                }
                                echo '<p><b>Kesiapan Inovasi:</b> '.$kesiapanInovasi.'</p>';
                                $kerjasamaBisnis = "";
                                switch ($isibuku[$i+1]->id_kerjasama_bisnis){
                                    case "1":
                                        $kerjasamaBisnis = "*** Terbuka";
                                        break;
                                    case "2":
                                        $kerjasamaBisnis = "** Luas";
                                        break;
                                    case "3":
                                        $kerjasamaBisnis = "* Terbatas";
                                        break;
                                }
                                echo '<p><b>Kerjasama Bisnis:</b> '.$kerjasamaBisnis.'</p>';
                                $peringkatInovasi = "";
                                switch ($isibuku[$i+1]->id_peringkat_inovasi){
                                    case "1":
                                        $peringkatInovasi = "*** Paling Prospektif";
                                        break;
                                    case "2":
                                        $peringkatInovasi = "** Sangat Prospektif";
                                        break;
                                    case "3":
                                        $peringkatInovasi = "* Prospektif";
                                        break;
                                }
                                echo '<p><b>Peringkat Inovasi:</b> '.$kerjasamaBisnis.'</p>';
                                echo '<div class="content-page">';
                                echo '<div class="filter-v1">';
                                echo '<div class="row mix-grid thumbnails">';
                                $number = count($isibuku[$i+1]->file);
                                /*if ($number > 0){
                                    echo '<div class="col-md-6 col-sm-6 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                    echo '<div class="mix-inner">';
                                    //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                    echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="img-responsive">';
                                    echo '<div class="mix-details">';
                                    echo '<p style="color:#fff">'.$isibuku[$i+1]->file[0]->keterangan.'</p>';
                                    echo '<a href="'.env('APP_URL').'/general/download/'.$isibuku[$i+1]->file[0]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    if ($number >= 2){
                                        echo '<div class="col-md-6 col-sm-6 mix category_1 mix_all" style="display: block;  opacity: 1;">';
                                        echo '<div class="mix-inner">';
                                        //echo '<a data-rel="fancybox-button" title="Project Name" href="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[0]->path.'" class="fancybox-button">';
                                        echo '<img alt="" src="'.env('APP_URL').'/public/storage/'.$isibuku[$i+1]->file[1]->path.'" class="img-responsive">';
                                        echo '<div class="mix-details">';
                                        echo '<p style="color:#fff">'.$isibuku[$i+1]->file[1]->keterangan.'</p>';
                                        echo '<a href="'.env('APP_URL').'/general/download/'.$isibuku[$i+1]->file[1]->id.'" class="mix-link"><i class="fa fa-download"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }*/
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</td>';
                            }else{
                                echo '<td style="display:none"></td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table><br>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/datatables.js" type="text/javascript"></script>
    <script src="<?php echo  env('APP_URL'); ?>/assets/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.10.0/js-yaml.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js'></script>
    <script type="text/javascript">
        var host = '<?php echo env('APP_URL'); ?>';
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/buku/scripts/kategori.js" type="text/javascript"></script>
@stop