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
                <li class="active">Penjurian Admin Proses</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Penjurian Admin Proses</h1>
                    <p style="text-align: justify;font-size: 14px;">Menu Penjuarian terdiri dari 7 sub menu yaitu sub menu Assign Juri, Batch, Bidang, Assign Proposal, Penilaian, Status Batch, Assign Pemenang seperti yang terlihat pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Berikut penjelasan dari ke dua sub menu tersebut:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu batch di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Batch merupakan suatu nama yang digunakan untuk seri tahunan perlombaan inovasi. Ada 4 aksi yang dapat dilakukan pada bagian ini,
                            seperti yang dijelaskan dibawah ini.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Batch Baru</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pembuatan batch baru dilakukan dengan mengklik tombol Tambah Batch. setelah tombol tambah batch di klik maka akan muncul tampilan
                            seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Isilah field-field yang ada dalam form tambah batch. Setelah selesai mengisi form maka langkah selanjtunya adalah menyimpan batch
                                dengan mengklik tombol Simpan. Setelah tombol Simpan di klik maka sistem akan mulai memproses penyimpanan batch. apabila proses penyimpanan
                                berhasil dilakukan maka akan muncul popup pesan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses penyimpanan berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal batch.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Edit Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Edit batch adalah fitur untuk edit batch yang sudah disimpan. setelah tombol edit di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Edit field dari form batch yang ingin dirubah. Setelah selesai edit klik tombol Update. Apabila update berhasil dilakukan maka
                            akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses update berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal batch.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Hapus Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Hapus batch adalah fitur untuk hapus batch yang sudah disimpan. setelah tombol hapus di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_6.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Klik tombol Hapus untuk memulai proses hapus batch. setelah proses hapus batch berhasil dilakukan maka akan muncul tampilan seperti pada gambar
                                dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_7.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses hapus berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal batch.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>4. Cari Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Cari batch adalah fitur untuk mencari batch yang ada dalam basis data. masukkan kata pencarian pada bagian Search seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_8.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pada saat kita ketikkan suatu kata atau kalimat, pada saat itu juga sistem akan menampilkan hasilnya seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_9.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Bidang</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu bidang di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_10.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Bidang merupakan suatu nama yang merepresentasikan bidang-bidang apa saja yang akan diperlombakan pada seri tahunan yang sedang
                                berlangsung. ada 3 aksi yang ada pada bagian ini seperti yang dijelaskan dibawah ini.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Bidang Baru</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pembuatan bidang baru dilakukan dengan mengklik tombol Tambah Bidang. setelah tombol tambah bidang di klik maka akan muncul tampilan
                                seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_11.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Isilah field-field yang ada dalam form tambah bidang. Setelah selesai mengisi form maka langkah selanjtunya adalah menyimpan bidang
                                dengan mengklik tombol Simpan. Setelah tombol Simpan di klik maka sistem akan mulai memproses penyimpanan bidang. apabila proses penyimpanan
                                berhasil dilakukan maka akan muncul popup pesan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses penyimpanan berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal bidang.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Edit Bidang</b></p>
                            <p style="text-align: justify;font-size: 14px;">Edit bidang adalah fitur untuk edit bidang yang sudah disimpan. setelah tombol edit di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_12.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Edit field dari form bidang yang ingin dirubah. Setelah selesai edit klik tombol Update. Apabila update berhasil dilakukan maka
                                akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses update berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal batch.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Cari Bidang</b></p>
                            <p style="text-align: justify;font-size: 14px;">Cari bidang adalah fitur untuk mencari bidang yang ada dalam basis data. masukkan kata pencarian pada bagian Search seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_13.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pada saat kita ketikkan suatu kata atau kalimat, pada saat itu juga sistem akan menampilkan hasilnya seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_14.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Assign Juri</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu assign juri di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_15.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Assign Juri merupakan suatu fitur untuk assign juri ke bidang tertentu. ada 4 aksi yang ada pada bagian ini seperti yang dijelaskan
                            dibawah ini</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Tambah Juri</b></p>
                            <p style="text-align: justify;font-size: 14px;">Tambah Juri dilakukan dengan mengklik tombol Tambah Juri. setelah tombol tambah juri di klik maka akan muncul tampilan
                                seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_16.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Isilah field-field yang ada dalam form tambah juri. Setelah selesai mengisi form maka langkah selanjtunya adalah assign juri
                                dengan mengklik tombol Simpan. Setelah tombol Simpan di klik maka sistem akan mulai memproses assign juri. apabila proses penyimpanan
                                berhasil dilakukan maka akan muncul popup pesan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_20.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses penyimpanan berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal assign juri.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Edit Assign Juri</b></p>
                            <p style="text-align: justify;font-size: 14px;">Edit assign juri adalah fitur untuk edit assign juri yang sebelumnya dilakukan. setelah tombol edit di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_17.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Edit field dari form assign juri yang ingin dirubah. Setelah selesai edit klik tombol Update. Apabila update berhasil dilakukan maka
                                akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses update berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal assign juri.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Hapus Assign Juri</b></p>
                            <p style="text-align: justify;font-size: 14px;">Hapus assign juri adalah fitur untuk hapus assign juri yang sebelumnya dilakukan. setelah tombol hapus di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_18.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Klik tombol Hapus untuk memulai proses hapus assign juri. setelah proses hapus assign juri berhasil dilakukan maka akan muncul tampilan seperti pada gambar
                                dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_19.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses hapus berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal assign juri.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>4. Cari Data Assign Juri</b></p>
                            <p style="text-align: justify;font-size: 14px;">Cari bidang adalah fitur untuk mencari bidang yang ada dalam basis data. masukkan kata pencarian pada bagian Search seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_13.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pada saat kita ketikkan suatu kata atau kalimat, pada saat itu juga sistem akan menampilkan hasilnya seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_21.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Assign Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu assign proposal di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_22.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Assign Proposal merupakan suatu fitur untuk assign proposal ke bidang tertentu. ada 4 aksi yang ada pada bagian ini seperti yang dijelaskan
                                dibawah ini</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Tambah Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Tambah Proposal dilakukan dengan mengklik tombol Tambah Proposal. setelah tombol tambah proposal di klik maka akan muncul tampilan
                                seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_23.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Isilah field-field yang ada dalam form tambah proposal. Setelah selesai mengisi form maka langkah selanjtunya adalah assign proposal
                                ke bidang yang sudah dipilih dengan mengklik tombol Simpan. Kita dapat melihat detail proposal dengan mengklik tombol Lihat Proposal. Setelah
                                tombol di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_25.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah tombol Simpan di klik maka sistem akan mulai memproses assign proposal
                                ke bidang yang sudah dipilih. apabila proses penyimpanan berhasil dilakukan maka akan muncul popup pesan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_24.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses penyimpanan berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal assign proposal.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Edit Assign Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Edit assign proposal adalah fitur untuk edit assign proposal yang sebelumnya dilakukan. setelah tombol edit di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_26.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Edit field dari form assign juri yang ingin dirubah. Setelah selesai edit klik tombol Update. Apabila update berhasil dilakukan maka
                                akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_27.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses update berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal assign proposal.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Hapus Assign Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Hapus assign proposal adalah fitur untuk hapus assign proposal yang sebelumnya dilakukan. setelah tombol hapus di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_28.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Klik tombol Hapus untuk memulai proses hapus assign proposal. setelah proses hapus assign proposal berhasil dilakukan maka akan muncul tampilan seperti pada gambar
                                dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_29.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses hapus berhasil dilakukan maka sistem akan me redirect tampilan ke halaman awal assign proposal.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>4. Sebaran Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Sebaran proposal adalah fitur untuk menampilkan sebaran assign proposal yang sudah dilakukan. Setelah tombol Sebarang Proposal di klik maka akan muncul tampilan seperti
                            pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penjurian_30.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Penilaian</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu penilaian di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penilaian.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Penilaian adalah suatu fitur bagi admin proses untuk melihat hasil penilaian dari dewan juri. Ada beberapa variasi hasil penilaian
                            yang dapat dilihat diantaranya penilaian terurut, yaitu hasil yang ditampilkan adalah mulai dari penilaian terbesar sampai dengan terkecil dan
                            sebaliknya atau penilaian tanpa urutan.</p>
                            <p style="text-align: justify;font-size: 14px;">Misalkan kita ingin melihat hasil penilaian terurut dari penilaian terbesar samapai dengan terkecil dari suatu batch. Langkah-langkah yang dilakukan
                            adalah sebagai berikut:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Pilih Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pada langkah ini admin proses akan memilh batch mana yang ingin dilihat hasil penilaian dewan juri. Setelah batch dipilih maka
                            akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penilaian_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Sistem akan memproses pilihan batch dan menampilkan bidang-bidang apa saja yang diperlombakan pada batch yang terpilih.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Urutkan Nilai</b></p>
                            <p style="text-align: justify;font-size: 14px;">Langkah berikutnya adalah memilih jenis urutan nilai. karena kita ingin melihat urutan nilai dari nilai yang terbesar sampai
                            dengan urutan terkecil maka kita memilih opsi besar ke kecil seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penilaian_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Tampilkan Hasil Penjurian</b></p>
                            <p style="text-align: justify;font-size: 14px;">Langkah selanjutnya adalah dengan mengklik tombol Tampilkan hasil penjurian untuk memulai proses menampilkan hasil penilaian
                            dewan juri yang dimulai dari nilai terbesar sampai dengan nilai terkecil. Hasil dari pencarian tersebut dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_proses_penilaian_3.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Status Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu status batch di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_status_batch.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Ada 1 aksi yang dapat dilakukan oleh admin proses yaitu Update Status. Klik tombol Update Status pada baris dimana batch ingin
                            dirubah update statusnya. Setelah tombol Update Status di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_status_batch_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Ada 3 jenis status batch yang dapat dipilih oleh admin proses yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Aktif</b></p>
                            <p style="text-align: justify;font-size: 14px;">Status batch aktif artinya adalah perlombaan suatu batch sedang berlangsung. status ini memungkinkan dewan juri masih bisa
                            memberikan peniliaian ataupun merevisi nilai</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Penentuan Pemenang</b></p>
                            <p style="text-align: justify;font-size: 14px;">Status batch penentuan pemenang artinya adalah perlombaan sudah usai dan dewan juri tidak bisa lagi memberikan nilai ataupun
                            merevisi nilai. Pada tahapan ini akan ditentukan pemenangnya</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Selesai</b></p>
                            <p style="text-align: justify;font-size: 14px;">Status batch selesai artinya adalah proses perlombaan dari suatu batch telah usai. Para pemenang sudah ditentukan.</p>
                            <p style="text-align: justify;font-size: 14px;">Tampilan dari ketiga status tersebut dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_status_batch_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah dipilih status batch maka selanjutnya adalah mengklik tombol Update untuk update status batch. setelah tombol Update
                                di klik maka proses update status dilakukan. Apabila proses update status berhasil dilakukan maka akan muncul tampilan seperti pada
                            gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_status_batch_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Kemudian sistem akan me redirect tampilan ke tampilan awal status batch</p>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Assign Pemenang</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah menu assign pemenang di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_assign_pemenang.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Langkah-langkah yang dilakukan dalam proses assign pemenang adalah sebagai berikut:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Pilih Batch</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pada langkah ini admin proses memilih batch yang akan ditentukan proposal-proposal mana saja yang akan jadi pemenang. Sebagai
                            catatan batch yang ditampilkan dalam list adalah batch dengan status penentuan pemenang. Tampilan pilihan batch dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_assign_pemenang_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Tampilkan Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Langkah selanjutnya adalah klik tombol Tampilkan Proposal untuk menampilkan seluruh proposal yang ada pada batch yang terpilih. Setelah diklik
                            maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_assign_pemenang_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Sebagai catatan bahwa proposal yang ditampilkan sudah dalam urutan nilai yang didapat dari dewan juri yang terbesar sampai dengan yang terkecil</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Pilih Pemenang</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah seluruh proposal muncul, maka disetiap barisnya dibagian kolom terakhir ada kolom status. Pada kolom ini admin proses akan menentukan
                            apakah proposal masuk dalam kategori disimpan, diterim ataupun discontinued seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_assign_pemenang_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pengertian dari ketiga status diatas adalah sebagai berikut:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a. Disimpan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pengertian Disimpan adalah proposal tidak menjadi pemenang dalam batch ini tetapi masih bisa diikutsertakan pada batch berikutnya dengan catatan
                            inovator memperbaiki proposalnya sesuai dengan saran yang diberikan oleh dewan juri</p>
                            <p style="text-align: justify;font-size: 14px;"><b>b. Diterima</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pengertian Diterima adalah proposal menjadi pemenang dalam batch ini.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>c. Discontinued</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pengertian Discontinued adalah proposal tidak menjadi pemenang dan tidak bisa diikutsertakan
                                dalam batch berikutnya.</p>
                            <p style="text-align: justify;font-size: 14px;"><b>4. Simpan Data</b></p>
                            <p style="text-align: justify;font-size: 14px;">Setelah selesai menentukan status dari seluruh proses yang ada maka langkah selanjutnya adalah
                            admin proses klik tombol Simpan Data untuk mulai menyimpan perubahan status disetiap proposal yang telah dilakukan admin proses. Setelah tombol
                            Simpan Data diklik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/adminproses/admin_assign_pemenang_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Kemudian sistem akan me redirect tampilan ke tampilan awal assign pemenang</p>
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