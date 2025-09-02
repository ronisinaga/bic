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
                <li class="active">Dashboard Admin Proses</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Dashboard Admin Proses</h1>
                    <p style="text-align: justify;font-size: 14px;">Tampilan dashboard admin proses adalah seperti pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_dashboard.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Dashboard admin proses adalah menu yang merepresentasikan fitur dashboard untuk admin proses. Fitur ini akan menampilkan 2 informasi utama,yaitu seperti yang dijelaskan pada penjelasan dibawah ini:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Resume Jumlah Proposal Berdasarkan status proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Resume Jumlah Proposal Berdasarkan status proposal merupakan tampilan yang menampilkan jumlah proposal pada masing-masing status proposal seperti
                                yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_dashboard_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pada masing-masing resume ada link yang nantinya akan menampilkan list proposal sesuai dengan jumlah yang ditampilkan pada resume. Ketika link diklik
                                maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_2.png"/>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail dari proposal tersebut maka klik judul proposal. Setelah judul proposal di klik maka akan muncul tampilan seperti pada gambar dibawah
                                ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_3.png"/>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Fitur Shortcut</b></p>
                            <p style="text-align: justify;font-size: 14px;">Fitur shortcut ini memudahkan admin proses untuk mengakses data tanpa harus mengklik menu yang ada disebelah kiri. ada 9 shortcut pada dashboard admin proses yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Message dari Reviewer</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan admin proses untuk melihat pesan-pesan yang dikirimkan oleh reviewer. Pesan ini berupa pesan yang dituliskan
                                oleh reviewer pada saat reviewer menyatakan bahwa proposal sudah di review dan dinyatakan lengkap serta siap untuk di review terkait isi dari
                                proposal. Tampilan dari shortcut Message dari Inovator dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_dashboard_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail dari salah satu pesan reviewer dapat dilakukan dengan klik link text View. Setelah di klik maka akan muncul
                                tampilan seperti pada gambar dibawah ini: </p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_dashboard_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Shortcut message ini maksimum berisikan 5 pesan terbaru dari reviewer.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Daftar Proposal Sudah Review</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal yang sudah direview oleh reviewer.
                                tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_8.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang sudah direview oleh reviewer dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang sudah direview oleh reviewer ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Daftar Proposal Diseleksi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal dalam status diseleksi. Proposal dengan status diseleksi artinya adalah
                                bahwa proposal tersebut sudah masuk dalam tahap penyeleksian. Tahap penyeleksian adalah tahap dimana proposal-proposal tersebut akan dikelompokkan
                                kedalam bidang-bidang yang sudah ditentukan diawal. Setelah proposal-proposal tersebut masuk kedalam bidang-bidang tertentu maka juri-juri pada bidang
                                tersebut akan mulai melakukan penilaian terhadap proposal tersebut. Tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_10.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang diseleksi dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang diseleksi ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>4. Daftar Proposal Disimpan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal dalam status disimpan. Proposal dengan status disimpan artinya adalah
                                bahwa proposal tersebut tidak menjadi pemenang tetapi juga tidak ditolak. Proposal ini dapat diikutkan kembali pada tahapan berikutnya tahun depan
                                dengan catatan inovator wajib memperbaiki proposal tersebut berdasarkan komentar dari dewan juri.
                                Tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_11.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang disimpan dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang disimpan ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>5. Daftar Proposal Diterima</b></p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut ini memungkinkan reviewer untuk melihat proposal-proposal dalam status diterima. Proposal dengan status diterima artinya adalah
                                bahwa proposal tersebut menjadi pemenang. Tampilan dari shortcut ini dapat dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/reviewer/dashboard_reviewer_12.png">
                            <p style="text-align: justify;font-size: 14px;">Untuk melihat detail proposal yang diterima dapat dilakukan dengan klik link text View.
                                Setelah di klik maka akan muncul tampilan detail proposal seperti pada gambar bagian resume jumlah proposal diatas. </p>
                            <p style="text-align: justify;font-size: 14px;">Shortcut proposal yang diterima ini maksimum berisikan 5 proposal terbaru.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>6. Daftar Proposal Ditolak</b></p>
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
                <a href="<?php echo env('APP_URL'); ?>/general/manual/proses" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
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