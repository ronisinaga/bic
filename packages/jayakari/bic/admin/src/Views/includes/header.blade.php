<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div>
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <?php
            switch ($activeCategory){
                case 1:
                    echo '<a href="'.env("APP_URL").'/admin/home">
                        <img src="'.env("APP_URL").'/public/jayakari/bic/admin/layouts/img/logo.png" alt="logo" class="logo-image" /></a>';
                    break;
                case 2:
                    echo '<a href="'.env("APP_URL").'/admin/home/proposal">
                        <img src="'.env("APP_URL").'/public/jayakari/bic/admin/layouts/img/logo.png" alt="logo" class="logo-image" /></a>';
                    break;
                case 3:
                    echo '<a href="'.env("APP_URL").'/admin/home/reviewer">
                        <img src="'.env("APP_URL").'/public/jayakari/bic/admin/layouts/img/logo.png" alt="logo" class="logo-image" /></a>';
                    break;
                case 4:
                    echo '<a href="'.env("APP_URL").'/admin/home/inovator">
                        <img src="'.env("APP_URL").'/public/jayakari/bic/admin/layouts/img/logo.png" alt="logo" class="logo-image" /></a>';
                    break;
                case 5:
                    echo '<a href="'.env("APP_URL").'/admin/home/juri">
                        <img src="'.env("APP_URL").'/public/jayakari/bic/admin/layouts/img/logo.png" alt="logo" class="logo-image" /></a>';
                    break;
                case 7:
                    echo '<a href="'.env("APP_URL").'/admin/home/administrasi">
                        <img src="'.env("APP_URL").'/public/jayakari/bic/admin/layouts/img/logo.png" alt="logo" class="logo-image" /></a>';
                    break;
                case 9:
                    echo '<a href="'.env("APP_URL").'/admin/home/designer">
                        <img src="'.env("APP_URL").'/public/jayakari/bic/admin/layouts/img/logo.png" alt="logo" class="logo-image" /></a>';
                    break;
                default:
                    break;
            }
            ?>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?php echo  env("APP_URL"); ?>/public/storage{{$datauser[0]->public_path}}/{{$datauser[0]->small_file}}" />
                            <span class="username username-hide-on-mobile"> {{$datauser[0]->fullname}} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <?php
                                    switch ($activeCategory){
                                        case 1:
                                            echo '<a href="'.env("APP_URL").'/admin/superuser/profile"><i class="icon-user"></i> My Profile </a>';
                                            break;
                                        case 2:
                                            echo '<a href="'.env("APP_URL").'/admin/proposal/profile"><i class="icon-user"></i> My Profile </a>';
                                            break;
                                        case 3:
                                            echo '<a href="'.env("APP_URL").'/admin/reviewer/profile"><i class="icon-user"></i> My Profile </a>';
                                            break;
                                        case 4:
                                            echo '<a href="'.env("APP_URL").'/admin/inovator/profile"><i class="icon-user"></i> My Profile </a>';
                                            break;
                                        case 5:
                                            echo '<a href="'.env("APP_URL").'/admin/juri/profile"><i class="icon-user"></i> My Profile </a>';
                                            break;
                                        case 7:
                                            echo '<a href="'.env("APP_URL").'/admin/juri/profile"><i class="icon-user"></i> My Profile </a>';
                                            break;
                                        case 9:
                                            echo '<a href="'.env("APP_URL").'/admin/juri/profile"><i class="icon-user"></i> My Profile </a>';
                                            break;
                                        default:
                                            break;
                                    }
                                ?>


                            </li>
                            <li>
                                <!--<a href="<?php echo  env('APP_URL'); ?>/general/login">-->
                                    <a href="http://bic.web.id">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->

                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- END SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menus slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menus-light" class right after "page-sidebar-menus" to enable light sidebar menus style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menus-hover-submenu" class right after "page-sidebar-menus" to enable hoverable(hover vs accordion) sub menus mode -->
            <!-- DOC: Apply "page-sidebar-menus-closed" class right after "page-sidebar-menus" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menus mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menus slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <?php
                $numUC = count($datauser[0]->userCategory);
                $kategoriMenu = null;
                if ($numUC > 1){
                    if ($kategorilabel == 'kategori pengguna'){
                        echo '<li class="nav-item start active open">';
                    }else{
                        echo '<li class="nav-item">';
                    }
                    echo '    <a href="javascript:;" class="nav-link nav-toggle">';
                    echo '        <i class="fa fa-object-group"></i>';
                    echo '        <span class="title"> KATAGORI PENGGUNA</span>';
                    echo '        <span class="selected"></span>';
                    echo '        <span class="arrow open"></span>';
                    echo '    </a>';
                    echo '<ul class="sub-menu">';
                    foreach ($datauser[0]->userCategory as $value){
                        echo '<li class="nav-item  ">';
                        echo '    <a href="'.env("APP_URL").'/admin/users/'.$value->id.'/changeCategory" class="nav-link ">';
                        echo '        <i class="fa fa-users"></i>';
                        echo '<span class="title">'.$value->kategori.'</span>';
                        echo '        <span class="selected"></span>';
                        echo '        <span class="arrow open"></span>';
                        echo '    </a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    if (\Illuminate\Support\Facades\Cookie::has('active_category')){
                        $num = count($datauser[0]->userCategory);
                        $found = false;
                        $idx = 0;
                        for ($i=0;$i<$num&&!$found;$i++){
                            if ($activeCategory == $datauser[0]->userCategory[$i]->id){
                                $found = true;
                                $idx = $i;
                            }
                        }
                        $kategoriMenu = $datauser[0]->userCategory[$idx]->kategoriMenu;
                    }else{
                        $kategoriMenu = $datauser[0]->userCategory[0]->kategoriMenu;
                    }
                }else{

                    $kategoriMenu = $datauser[0]->userCategory[0]->kategoriMenu;
                }
                $num = count($kategoriMenu);
                $idx = 0;
                foreach ($kategoriMenu as $item){
                    if ($idx == 0){
                        if ($numUC > 1){
                            if ($kategorilabel == strtolower($item->kategori)){
                                echo '<li class="nav-item start active open">';
                            }else{
                                echo '<li class="nav-item">';
                            }
                        }else{
                            if ($kategorilabel == strtolower($item->kategori)){
                                echo '<li class="nav-item start active open">';
                            }else{
                                echo '<li class="nav-item">';
                            }
                        }
                    }else{
                        if ($kategorilabel == strtolower($item->kategori)){
                            echo '<li class="nav-item start active open">';
                        }else{
                            echo '<li class="nav-item">';
                        }
                    }
                    if ($item->url == ''){
                        echo '    <a href="javascript:;" class="nav-link nav-toggle">';
                    }else{
                        echo '    <a href="'.env('APP_URL').$item->url.'" class="nav-link nav-toggle">';
                    }
                    echo '        <i class="'.$item->icon.'"></i> ';
                    echo '        <span class="title">'.$item->kategori.'</span>';
                    echo '        <span class="selected"></span>';
                    echo '        <span class="arrow open"></span>';
                    echo '    </a>';
                    $num = count($item->menu);
                    if ($num > 0){
                        echo '<ul class="sub-menu">';
                        foreach ($item->menu as $value){
                            echo '<li class="nav-item  ">';
                            echo '    <a href="'.env('APP_URL').$value->url.'" class="nav-link ">';
                            echo '        <i class="'.$value->icon.'"></i> <span class="title">'.$value->menu.'</span>';
                            echo '    </a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                    $idx++;
                }
            ?>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->