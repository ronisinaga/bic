@extends('jayakari.bic.admin::layouts.default')
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title"> Dashboard
                <small>Dashboard Inovator</small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo env('APP_URL'); ?>/admin/home/inovator">Awal</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Dashboard Inovator Content
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
            <div class="row">
                <div class="col-md-12">
                    <!--<h3 class="page-title"> Selamat datang Inovator</h3><hr>-->
                    <h3 class="page-title"> <?php echo $labels["TWI"]; ?></h3><hr>
                    <p style="text-align: justify">
                        <?php echo $labels["PWI"]; ?>
                    </p><hr>
                </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Message dari Reviewer</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                            $num = count($message);
                                            if ($num == 0){
                                                echo "Tidak ada message baru";
                                            }else{
                                                if ($num <= 5){
                                                    for($i=0;$i<$num;$i++){
                                                        echo '<div class="mt-comment">';
                                                        echo '    <div class="mt-comment-img">';
                                                        echo '    </div>';
                                                        echo '    <div class="mt-comment-body">';
                                                        echo '<div class="mt-comment-info">';
                                                        echo '    <span class="mt-comment-author">'.$message[$i]->judul.'</span>';
                                                        $date = new DateTime($message[$i]->inserted_date);
                                                        echo '    <span class="mt-comment-date">'.$date->format('d M Y H:i:s').'</span>';
                                                        echo '</div>';
                                                        echo '<div class="mt-comment-details">';
                                                        $status = $message[$i]->status==0?"New":"Read";
                                                        echo '    <span class="mt-comment-status mt-comment-status-pending">'.$status.'</span>';
                                                        echo '    <ul class="mt-comment-actions">';
                                                        echo '        <li>';
                                                        echo '            <a href="'.env('APP_URL').'/admin/inovator/message/inbox/'.$message[$i]->id.'">View</a>';
                                                        echo '        </li>';
                                                        echo '    </ul>';
                                                        echo '</div>';
                                                        echo '       </div>';
                                                        echo '</div>';
                                                    }
                                                }else{
                                                    for($i=0;$i<5;$i++){
                                                        echo '<div class="mt-comment">';
                                                        echo '    <div class="mt-comment-img">';
                                                        echo '    </div>';
                                                        echo '    <div class="mt-comment-body">';
                                                        echo '<div class="mt-comment-info">';
                                                        echo '    <span class="mt-comment-author">'.$message[$i]->judul.'</span>';
                                                        $date = new DateTime($message[$i]->inserted_date);
                                                        echo '    <span class="mt-comment-date">'.$date->format('d M Y H:i:s').'</span>';
                                                        echo '</div>';
                                                        echo '<div class="mt-comment-details">';
                                                        $status = $message[$i]->status==0?"New":"Read";
                                                        echo '    <span class="mt-comment-status mt-comment-status-pending">'.$status.'</span>';
                                                        echo '    <ul class="mt-comment-actions">';
                                                        echo '        <li>';
                                                        echo '            <a href="'.env('APP_URL').'/admin/inovator/message/content/'.$message[$i]->id.'">View</a>';
                                                        echo '        </li>';
                                                        echo '    </ul>';
                                                        echo '</div>';
                                                        echo '       </div>';
                                                        echo '</div>';
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                    <!-- END: Comments -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption">
                                <i class="icon-bubbles font-red"></i>
                                <span class="caption-subject font-red bold uppercase">Proposal Terbaru</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="portlet_comments_1">
                                    <!-- BEGIN: Comments -->
                                    <div class="mt-comments">
                                        <?php
                                        $num = count($proposal);
                                        if ($num == 0){
                                            echo "Tidak ada proposal baru";
                                        }else{
                                            if ($num <= 5){
                                                for($i=0;$i<$num;$i++){
                                                    echo '<div class="mt-comment">';
                                                    echo '    <div class="mt-comment-img">';
                                                    echo '    </div>';
                                                    echo '    <div class="mt-comment-body">';
                                                    echo '<div class="mt-comment-info">';
                                                    echo '    <span class="mt-comment-author">'.$proposal[$i]->judul.'</span>';
                                                    $date = new DateTime($proposal[$i]->tgl_pembuatan);
                                                    echo '    <span class="mt-comment-date">'.$date->format('d M Y H:i:s').'</span>';
                                                    echo '</div>';
                                                    echo '<div class="mt-comment-details">';
                                                    $status = '';
                                                    switch($proposal[$i]->statusProposal->status){
                                                        case "BARU":
                                                            $status = "Baru";
                                                            break;
                                                        case "BATAL":
                                                            $status = "Batal";
                                                            break;
                                                        case "REVIEW":
                                                            $status = "Review";
                                                            break;
                                                        case "REVISI":
                                                            $status = "Revisi";
                                                            break;
                                                        case "IN REVIEW":
                                                            $status = "In Review";
                                                            break;
                                                        case "SELEKSI":
                                                            $status = "Seleksi";
                                                            break;
                                                        case "DISIMPAN":
                                                            $status = "Disimpan";
                                                            break;
                                                        case "DITERIMA":
                                                            $status = "Diterima";
                                                            break;
                                                        case "DISCONTINUED":
                                                            $status = "Discontinued";
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    echo '    <span class="mt-comment-status mt-comment-status-pending">'.$status.'</span>';
                                                    echo '    <ul class="mt-comment-actions">';
                                                    echo '        <li>';
                                                    echo '            <a href="'.env('APP_URL').'/admin/inovator/proposal/'.$proposal[$i]->id.'/detail">View</a>';
                                                    echo '        </li>';
                                                    echo '    </ul>';
                                                    echo '</div>';
                                                    echo '       </div>';
                                                    echo '</div>';
                                                }
                                            }else{
                                                for($i=0;$i<5;$i++){
                                                    echo '<div class="mt-comment">';
                                                    echo '    <div class="mt-comment-img">';
                                                    echo '    </div>';
                                                    echo '    <div class="mt-comment-body">';
                                                    echo '<div class="mt-comment-info">';
                                                    echo '    <span class="mt-comment-author">'.$proposal[$i]->judul.'</span>';
                                                    $date = new DateTime($proposal[$i]->tgl_pembuatan);
                                                    echo '    <span class="mt-comment-date">'.$date->format('d M Y H:i:s').'</span>';
                                                    echo '</div>';
                                                    echo '<div class="mt-comment-details">';
                                                    $status = '';
                                                    switch($proposal[$i]->statusProposal->status){
                                                        case "BARU":
                                                            $status = "Baru";
                                                            break;
                                                        case "BATAL":
                                                            $status = "Batal";
                                                            break;
                                                        case "REVIEW":
                                                            $status = "Review";
                                                            break;
                                                        case "REVISI":
                                                            $status = "Revisi";
                                                            break;
                                                        case "IN REVIEW":
                                                            $status = "In Review";
                                                            break;
                                                        case "SELEKSI":
                                                            $status = "Seleksi";
                                                            break;
                                                        case "DISIMPAN":
                                                            $status = "Disimpan";
                                                            break;
                                                        case "DITERIMA":
                                                            $status = "DITERIMA";
                                                            break;
                                                        case "DISCONTINUED":
                                                            $status = "DISCONTINUED";
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    echo '    <span class="mt-comment-status mt-comment-status-pending">'.$status.'</span>';
                                                    echo '    <ul class="mt-comment-actions">';
                                                    echo '        <li>';
                                                    echo '            <a href="'.env('APP_URL').'/admin/inovator/proposal/'.$proposal[$i]->id.'/detail">View</a>';
                                                    echo '        </li>';
                                                    echo '    </ul>';
                                                    echo '</div>';
                                                    echo '       </div>';
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <!-- END: Comments -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    </div>
@stop