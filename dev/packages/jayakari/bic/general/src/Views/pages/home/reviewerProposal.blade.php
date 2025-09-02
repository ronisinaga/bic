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
                <li class="active">Proposal Reviewer</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Proposal Reviewer</h1>
                    <p style="text-align: justify;font-size: 14px;">Menu Proposal terdiri dari 8 sub menu yaitu Proposal Belum Review, Proposal Sudah Review, Proposal Revisi, Proposal Seleksi,
                        Proposal Disimpan, Proposal Diterima, Proposal Ditolak dan Proposal Baru seperti yang terlihat pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Berikut penjelasan dari ke 8 sub menu tersebut:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Belum Review</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Belum Review di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Seperti yang terlihat pada tampilan diatas, sistem akan menampilkan daftar proposal yang masuk tetapi belum direview oleh reviewer.
                            Ada 1 aksi yang ada pada bagian ini yaitu memberi review. Klik tombol Review pada baris proposal yang akan direview. Setelah di klik maka akan muncul tampilan
                            seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Reviewer dapat memberikan review terhadap proposal yang dikirimkan oleh inovator. Setelah selesai memberikan review, reviewer memilih opsi
                            apakah proposal dirubah ke revisi, dalam artian menurut reviewer proposal tersebut memerlukan revisi dari inovator. Opsi berikutnya adalah In Review.
                            Opsi ini dipilih reviewer ketika reviewer menyatakan proposal lengkap dan sudah layak untuk direview secara lebih mendalam lagi. Opsi lainnya yaitu tidak
                            memilih dari kedua opsi diatas, artinya reviewer hanya memberikan review saja tanpa mengubah status proposal. Reviewer masih ingin memberikan review terhadap
                            proposal dikemudian hari</p>
                            <p style="text-align: justify;font-size: 14px;">Klik tombol Kirim Review untuk memulai proses penyimpan review. Apabila status proposal diubah menjadi revisi maka proposal tersebut akan masuk
                            kedalam daftar proposal revisi. Apabila status proposal dirubah menjadi In Review maka proposal akan masuk kedalam daftar proposal sudah direvisi</p>
                            <p style="text-align: justify;font-size: 14px;">Ketika sistem berhasil menyimpan revisi maka akan muncul popup seperti tampilan pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_3.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Sudah Review</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Sudah Review di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada gambar
                            dibawah ini : </p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_5.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Revisi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Revisi di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_6.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal revisi ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Seleksi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Seleksi di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_7.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal seleksi ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Disimpan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Disimpan di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_8.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal disimpan ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Diterima</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Diterima di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_9.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal diterima ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Ditolak</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Ditolak di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_10.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal ditolak ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Baru</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu Proposal Baru di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/reviewer_proposal_11.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proposal baru ada, maka untuk melihat detail dari proposal, reviewer dapat mengklik judul proposal. Setelah klik judul proposal maka akan muncul tampilan seperti pada
                                bagian Proposal Sudah Review: </p>
                        </li>
                    </ul>
                </div>
                <!-- END CONTENT -->
            </div>
            <div class="row">
                <a href="<?php echo env('APP_URL'); ?>/general/manual/reviewer" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
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