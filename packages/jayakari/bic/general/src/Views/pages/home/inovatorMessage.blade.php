@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/css/loading.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="main">
        <div class="modal"></div>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="javascript:;">General</a></li>
                <li><a href="<?php echo env('APP_URL'); ?>/general/login">Home</a></li>
                <li class="active">Message Inovator</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Message Inovator</h1>
                    <p style="text-align: justify;font-size: 14px;">Menu Message terdiri dari 2 sub menu yaitu sub menu yaitu Inbox dan Sent seperti yang terlihat pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/message.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Berikut penjelasan dari ke dua sub menu tersebut:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Inbox</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu inbox di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/message_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pesan-pesan dalam inbox berisikan pesan-pesan yang dikirim oleh reviewer kepada inovator yang merupakan tanggapan yang diberikan oleh reviewer
                            terhadap proposal inovator. Klik judul pesan untuk melihat detail dari pesan tersebut. Setelah di klik maka akan muncul tampilan seperti pada gambar dibawah ini</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/message_2.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Sent Message</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu sent message di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/message_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pesan-pesan dalam sent message berisikan pesan-pesan yang dikirim oleh inovator kepada reviewer ketika inovator meminta review kepada reviewer.
                                Setelah di klik maka akan muncul tampilan seperti pada gambar dibawah ini</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/message_4.png"/><br><br>
                        </li>
                    </ul>
                </div>
                <!-- END CONTENT -->
            </div>
            <div class="row">
                <a href="<?php echo env('APP_URL'); ?>/general/manual/inovator" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/assets/toastr/scripts/toastr.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/actions.js" type="text/javascript"></script>
@stop