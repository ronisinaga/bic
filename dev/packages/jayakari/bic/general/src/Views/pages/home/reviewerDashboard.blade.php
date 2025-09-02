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
                <li class="active">Dashboard Reviewer</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Dashboard Reviewer</h1>
                    <p style="text-align: justify;font-size: 14px;">Tampilan dashboard reviewer adalah seperti pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Dashboard reviewer adalah menu yang merepresentasikan fitur dashboard untuk reviewer. Fitur ini akan menampilkan 2 informasi utama,yaitu seperti yang dijelaskan pada penjelasan dibawah ini:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Resume Jumlah Proposal Berdasarkan status proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Resume Jumlah Proposal Berdasarkan status proposal merupakan tampilan yang menampilkan jumlah proposal pada masing-masing status proposal seperti
                                yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_1.png"/>
                            <p style="text-align: justify;font-size: 14px;">Pada masing-masing resume ada link yang nantinya akan menampilkan list proposal sesuai dengan jumlah yang ditampilkan pada resume. Ketika link diklik
                                maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_2.png"/>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail dari proposal tersebut maka klik judul proposal. Setelah judul proposal di klik maka akan muncul tampilan seperti pada gambar dibawah
                                ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_3.png"/>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Fitur Shortcut</b></p>
                            <p style="text-align: justify;font-size: 14px;">Fitur shortcut ini memudahkan reviewer untuk mengakses data tanpa harus mengklik menu yang ada disebelah kiri. ada 9 shortcut pada dashboard reviewer yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Message dari Inovator</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat pesan-pesan yang dikirimkan oleh inovator. Pesan ini berupa pesan yang dituliskan
                                oleh inovator pada saat inovator ingin meminta review dari proposal yang dikirimkannya. Tampilan dari shortcut Message dari Inovator dapat dilihat
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail dari salah satu pesan inovator dapat dilakukan dengan klik link text View. Setelah di klik maka akan muncul
                                tampilan seperti pada gambar dibawah ini: </p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Seperti yang terlihat pada gambar diatas, reviewer bisa menuliskan langsung review terhadap proposal tersebut dengan mengklik
                            tombol Review. Detail dari proses pemberian review oleh reviewer terhadap proposal inovator dapat dilihat pada bagian dibawah.</p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut message ini maksimum berisikan 5 pesan terbaru dari inovator.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Daftar Proposal Baru</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal yang dibuat oleh inovator. pada shortcut ini, reviewer
                                akan melihat 5 proposal terbaru yang dibuat oleh inovator dengan status baru. Contoh tampilannya adalah seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_7.png"/>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal dari inovator dapat dilakukan dengan klik link text View. Setelah di klik maka akan muncul
                                tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal dengan status baru ini maksimum berisikan 5 pesan terbaru dari inovator.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Daftar Proposal Belum Review</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal yang dibuat oleh inovator yang belum direview oleh reviewer.
                                tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_6.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal dari inovator dapat dilakukan dengan klik link text View. Setelah di klik maka akan muncul
                                tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang belum direview oleh reviewer ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>4. Daftar Proposal Sudah Review</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal yang sudah direview oleh reviewer.
                                tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_8.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang sudah direview oleh reviewer dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang sudah direview oleh reviewer ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>5. Daftar Proposal Revisi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal dalam status revisi. Proposal dengan status revisi artinya adalah
                                inovator wajib merevisi proposal yang dikirimkan sebelum dikirim kembali kepada reviewer berdasarkan hasil temuan reviewer.
                                tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_9.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang direvisi dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang direvisi ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>6. Daftar Proposal Diseleksi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal dalam status diseleksi. Proposal dengan status diseleksi artinya adalah
                                bahwa proposal tersebut sudah masuk dalam tahap penyeleksian. Tahap penyeleksian adalah tahap dimana proposal-proposal tersebut akan dikelompokkan
                                kedalam bidang-bidang yang sudah ditentukan diawal. Setelah proposal-proposal tersebut masuk kedalam bidang-bidang tertentu maka juri-juri pada bidang
                                tersebut akan mulai melakukan penilaian terhadap proposal tersebut. Tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_10.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang diseleksi dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang diseleksi ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>7. Daftar Proposal Disimpan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal dalam status disimpan. Proposal dengan status disimpan artinya adalah
                                bahwa proposal tersebut tidak menjadi pemenang tetapi juga tidak ditolak. Proposal ini dapat diikutkan kembali pada tahapan berikutnya tahun depan
                                dengan catatan inovator wajib memperbaiki proposal tersebut berdasarkan komentar dari dewan juri.
                                Tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_11.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang disimpan dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang disimpan ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>8. Daftar Proposal Diterima</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal dalam status diterima. Proposal dengan status diterima artinya adalah
                                bahwa proposal tersebut menjadi pemenang. Tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_12.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang diterima dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang diterima ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>9. Daftar Proposal Ditolak</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal dalam status ditolak. Proposal dengan status ditolak artinya adalah
                                bahwa proposal tersebut ditolak. Tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_13.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang ditolak dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang ditolak ini maksimum berisikan 5 proposal terbaru.</p>
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