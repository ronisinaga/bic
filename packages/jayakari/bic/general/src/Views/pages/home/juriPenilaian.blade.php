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
                <li class="active">Penilaian Juri</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Penilaian Juri</h1>
                    <p style="text-align: justify;font-size: 14px;">Menu Penilaian terdiri dari 2 sub menu yaitu sub menu profile seperti yang terlihat pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_penilaian.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Untuk lebi jelasnya mengenai kedua menu tersebut,dapat dilihat pada penjelasan dibawah ini:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Belum Dinilai</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu proposal belum dinilai di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_penilaian_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Ada 1 aksi yang dapat dilakukan pada bagian ini yaitu Beri Nilai. Beri Nilai adalah fitur yang digunakan oleh juri untuk memberikan nilai
                                dari suatu proposal. Setelah tombol Beri Nilai di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_penilaian_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Ada 9 kategori penilaian yang harus dinilai oleh dewan juri, yaitu :</p>
                            <p style="text-align: justify;font-size: 14px;">1. Keaslian/Originalitas</p>
                            <p style="text-align: justify;font-size: 14px;">Pada bagian ini dewan juri memberikan penilaian terhadap keaslian/originalitas ide dari inovasi yang dituangkan dalam proposal.</p>
                            <p style="text-align: justify;font-size: 14px;">2. Reka Ulang</p>
                            <p style="text-align: justify;font-size: 14px;">Kemudahan ditiru atau reka ulang (reverse engineering). Reka ulang yang dimaksud berkaitan dengan reka ulang teknis.</p>
                            <p style="text-align: justify;font-size: 14px;">3. Daya tarik</p>
                            <p style="text-align: justify;font-size: 14px;">Daya tarik yang dimaksud adalah perkiraan penerimaan inovasi oleh konsumen/pasar.</p>
                            <p style="text-align: justify;font-size: 14px;">4.Nilai Tambah</p>
                            <p style="text-align: justify;font-size: 14px;">Nilai tambah yang dimaksud adalah nilai tambah baru bagi konsumen/pasar.</p>
                            <p style="text-align: justify;font-size: 14px;">5. Pengembangan</p>
                            <p style="text-align: justify;font-size: 14px;">Pengembangan yang dimaksud adalah potensi pengembangan inovasi lebih lanjut.</p>
                            <p style="text-align: justify;font-size: 14px;">6. Potensi Ekspansi</p>
                            <p style="text-align: justify;font-size: 14px;">Potensi ekspansi yang dimaksud adalah potensi ekspansi(skalability) dari sisi market.</p>
                            <p style="text-align: justify;font-size: 14px;">7. Potensi Bisnis</p>
                            <p style="text-align: justify;font-size: 14px;">Potensi bisnis yang dimaksud adalah ditinjau dari persepsi bisnis.</p>
                            <p style="text-align: justify;font-size: 14px;">8. Resiko Bisnis</p>
                            <p style="text-align: justify;font-size: 14px;">Resiko bisnis yang dimaksud adalah ditinjau dari persepsi resiko bisnis.</p>
                            <p style="text-align: justify;font-size: 14px;">9. Rekomendasi Juri</p>
                            <p style="text-align: justify;font-size: 14px;">Rekomendasi juri merupakan pendapat pribadi dewan juri terhadap proposal yang dinilai.</p>
                            <p style="text-align: justify;font-size: 14px;">Setelah selesai memberikan nilai maka juri klik tombol Simpan. Apabila proses penyimpanan berhasil dilakukan maka akan muncul tampilan seperti
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_penilaian_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah berhasil menyimpan maka sistem akan meredirect halaman awal tampilan proposal belum dinilai.</p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Proposal Sudah Dinilai</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu proposal sudah dinilai di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_penilaian_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Ada 1 aksi yang dapat dilakukan pada bagian ini yaitu Revisi Nilai. Revisi Nilai adalah fitur yang digunakan oleh juri untuk melakukan revisi
                                nilai dari suatu proposal yang sebelumnya telah dilakukan oleh dewan juri. Setelah tombol Beri Nilai di klik maka akan muncul tampilan
                                seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_penilaian_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Silahkan lakukan revisi nilai sesuai dengan revisi yang ingin dilakukan.</p>
                            <p style="text-align: justify;font-size: 14px;">Setelah selesai melakukan revisi nilai maka juri klik tombol Simpan. Apabila proses revisi nilai berhasil dilakukan maka akan muncul tampilan seperti
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/juri/juri_penilaian_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah berhasil merevisi nilai maka sistem akan meredirect halaman awal tampilan proposal sudah dinilai.</p>
                        </li>
                    </ul>
                </div>
                <!-- END CONTENT -->
            </div>
            <div class="row">
                <a href="<?php echo env('APP_URL'); ?>/general/manual/juri" class="btn btn-purple"><i class="fa fa-arrow-left"></i> Kembali</a>
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