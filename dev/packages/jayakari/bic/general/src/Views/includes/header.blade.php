<!-- BEGIN TOP BAR -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span>+6221 4288 5430</span></li>
                    <li><i class="fa fa-phone"></i><span>+62 8118 242 558 (BIC-JKT)</span></li>
                    <li><i class="fa fa-phone"></i><span>+62 8118 242 462 (BIC-INA)</span></li>
                    <li><i class="fa fa-envelope-o"></i><span>info@bic.web.id</span></li>
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-3 col-sm-3 additional-nav">
                <ul class="list-unstyled list-inline pull-right">
                    <li><a href="{{env('APP_URL')}}/general/login">LOGIN</a></li>
                    <li><a href="{{env('APP_URL')}}/general/registrasi">REGISTRASI</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<!-- END TOP BAR -->

<!-- BEGIN HEADER -->
<div class="header">
    <div class="container">
        <a class="site-logo" href="<?php echo env('APP_URL'); ?>"><img src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/corporates/img/logos/logo.png"></a>
        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
        <div class="header-navigation pull-right font-transform-inherit">
            <ul>
            <!--<li><i class="fa fa-phone"></i><span>+6221 4288 5430</span></li>
                    <li><i class="fa fa-fax"></i><span>+62 21 2147 2655</span></li>
                    <li><i class="fa fa-phone"></i><span>+62 21 4288 5430</span></li>
                    <li><i class="fa fa-phone"></i><span>+62 8118 242 558 (BIC-JKT)</span></li>
                    <li><i class="fa fa-phone"></i><span>+62 8118 242 462 (BIC-INA)</span></li>
                    <li><i class="fa fa-envelope-o"></i><span>info@bic.web.id</span></li>-->
                <?php
                foreach($kategoriMenu as $item){
                    if (strtolower($item->menuCategory->kategori) == 'seri inovasi indonesia'){
                        echo '<li class="dropdown dropdown-megamenu">';
                        echo '<a class="dropdown-toggle" data-toggle="dropdown" data-target="" href="javascript:;">'.$item->menuCategory->kategori.'</a>';
                        $numBuku = count($buku);
                        if ($numBuku > 0){
                            echo '<ul class="dropdown-menu">';
                            echo '<li>';
                            echo '<div class="header-navigation-content">';
                            echo '<div class="row">';
                            echo '<div class="col-md-6 header-navigation-col">';
                            echo '<ul>';
                            $index = 0;
                            for($i=0;$i<$numBuku;$i++){
                                if ($index > 0){
                                    if ($index % 6 == 0){
                                        echo '</ul>';
                                        echo '</div>';
                                        echo '<div class="col-md-6 header-navigation-col">';
                                        echo '<ul>';
                                        if (!str_contains(strtolower($buku[$i]->judul),'challenger')){
                                            $index++;
                                            echo '<li><a href="'.env('APP_URL').'/general/buku/'.$buku[$i]->judul.'">'.$buku[$i]->judul.'</a></li>';
                                        }
                                    }else{
                                        if (!str_contains(strtolower($buku[$i]->judul),'challenger')){
                                            $index++;
                                            echo '<li><a href="'.env('APP_URL').'/general/buku/'.$buku[$i]->judul.'">'.$buku[$i]->judul.'</a></li>';
                                        }
                                    }
                                }else{
                                    if (!str_contains(strtolower($buku[$i]->judul),'challenger')){
                                        $index++;
                                        echo '<li><a href="'.env('APP_URL').'/general/buku/'.$buku[$i]->judul.'">'.$buku[$i]->judul.'</a></li>';
                                    }
                                }
                            }
                            echo '</ul>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</li>';
                            echo '</ul>';
                        }
                        echo '</li>';
                    }else{
                        if (count($item->menuCategory->menu) > 0){
                            echo '<li class="dropdown">';
                            if (strtolower($item->menuCategory->kategori) == 'utama'){
                                echo '<a class="dropdown-toggle" data-toggle="dropdown" data-target="" href="'.env('APP_URL').'">'.$item->menuCategory->kategori.'</a>';
                            }else if (strtolower($item->menuCategory->kategori) == 'innovation.id'){
                                echo '<a class="dropdown-toggle" data-toggle="dropdown" data-target="" href="http://innovation.id">'.$item->menuCategory->kategori.'</a>';
                            }else if (strtolower($item->menuCategory->kategori) == 'demo website bic baru'){
                                echo '<a class="dropdown-toggle" data-toggle="dropdown" data-target="" href="http://demo.innovation.id">'.$item->menuCategory->kategori.'</a>';
                            }else{
                                echo '<a class="dropdown-toggle" data-toggle="dropdown" data-target="" href="javascript:;">'.$item->menuCategory->kategori.'</a>';
                            }
                            $num = count($item->menuCategory->menu);
                            echo '<ul class="dropdown-menu">';
                            for ($i=0;$i<$num;$i++){
                                echo '<li><a href="'.env('APP_URL').$item->menuCategory->menu[$i]->url.'">'.$item->menuCategory->menu[$i]->menu.'</a></li>';
                            }
                            echo '</ul>';
                            echo '</li>';
                        }else{
                            echo '<li>';
                            if (strtolower($item->menuCategory->kategori) == 'utama'){
                                echo '<a href="'.env('APP_URL').'">'.$item->menuCategory->kategori.'</a>';
                            }else if (strtolower($item->menuCategory->kategori) == 'innovation.id'){
                                echo '<a href="http://innovation.id">'.$item->menuCategory->kategori.'</a>';
                            }else if (strtolower($item->menuCategory->kategori) == 'demo website'){
                                echo '<a href="http://demo.innovation.id">'.$item->menuCategory->kategori.'</a>';
                            }else if (strtolower($item->menuCategory->kategori) == 'kontak'){
                                echo '<a href="'.route('general.about').'">'.$item->menuCategory->kategori.'</a>';
                            }/*else if (strtolower($item->menuCategory->kategori) == 'in review'){
                                echo '<a href="'.route('general.book.inreview').'"><font color="red">'.$item->menuCategory->kategori.'</font></a>';
                            }*/else{
                                if (strtolower($item->menuCategory->kategori) <> 'in review'){
                                    echo '<a href="javascript:;">'.$item->menuCategory->kategori.'</a>';
                                }
                            }
                            echo '</li>';
                        }
                    }
                }
                    /*if ((\Illuminate\Support\Facades\URL::current() == env('APP_URL').'/general/login') || ((\Illuminate\Support\Facades\URL::current() == env('APP_URL').'/general/registrasi'))){

                    }else{
                        //diisi menu selain login dan registrasi
                    }*/
                ?>
            </ul>
        </div>
    </div>
</div>
<!-- Header END -->

