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
                <li class="active">Proposal Inovator</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Proposal Inovator</h1>
                    <p style="text-align: justify;font-size: 14px;">Menu proposal terdiri dari 2 sub menu yaitu sub menu profile seperti yang terlihat pada gambar dibawah ini:</p>
                    <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/proposal_inovator.png"/><br><br>
                    <p style="text-align: justify;font-size: 14px;">Berikut ini penjelasan dari kedua sub menu tersebut:</p>
                    <ul>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Lihat Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Tampilan fitur lihat proposal adalah seperti yang terlihat pada gambar dibawah:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tampilan_lihat_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pada tampilan ini ada beberapa aksi yang perlu untuk dijelaskan lebih detail diantaranya:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Buat Proposal Baru</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pada saat tombol buat proposal baru di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/buat_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">isi field judul proposal dengan judul proposal anda. Setelah judul proposal telah diisi ada beberapa aksi
                            yang dapat dilakukan yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1.1. Simpan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Tombol Simpan digunakan untuk menyimpan judul proposal yang telah dituliskan sebelumnya kedalam sistem.
                            Apabila sistem berhasil menyimpan judul proposal maka akan muncul popup seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/popup_sukses_buat_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila input inovator ada kesalahan maka akan muncul popup seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/popup_error_judul_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Apabila proses simpan berhasil dilakukan maka sistem akan meredirect tampilan ke tampilan awal lihat
                            proposal</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1.2. Simpan & Lanjut Pengisian</b></p>
                            <p style="text-align: justify;font-size: 14px;">Tombol Simpan & Lanjut Pengisian digunakan untuk menyimpan judul proposal yang dilanjutkan dengan mengisi field-field
                                yang tujuannya adalah menjelaskan secara detail proposal. Ketika tombol ini di klik maka sistem akan meredirect ke tampilan lengkapi
                            seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/inovator_proposal_lengkapi.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Proses pengisian field-field yang disediakan untuk melengkapi data proposal yang dibutuhkan dapat dilihat pada bagian 5 dibawah</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1.3. Batal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Tombol batal digunakan apabila kita batal untuk membuat judul proposal baru. Setelah tombol batal diklik maka sistem akan merespon
                            dengan meredirect tampilan ke tampilan awal lihat proposal</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Edit Judul</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pada saat tombol edit di klik maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/edit_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Aktifkan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pada saat tombol aktifkan di klik maka sistem akan memulai proses mengaktifkan kembali proposal dengan mengubah statusnya dari BATAL
                            menjadi BARU. apabila proses aktivasi sukses dilakukan maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/sukses_aktivasi_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>4. Revisi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pada saat tombol revisi di klik akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/edit_proposal_lengkapi.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Proses edit proposal dapat dilihat pada bagian 5 dibawah</p>
                            <p style="text-align: justify;font-size: 14px;"><b>5. Lengkapi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pada saat tombol lengkapi di klik akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/inovator_proposal_lengkapi.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Seperti yang terlihat pada gambar diatas, tampilan lengkapi dibagi atas 2 bagian besar yaitu bagian kelengkapan proposal dan aksi
                            yang direpresentasikan dengan tombol. Untuk lebih jelasnya akan dijelaskan seperti dibawah ini:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>5.1 Kelengkapan Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Kelengkapan proposal dibagi atas 3 bagian yaitu penjelasan naratif, data pendukung dan data & file pendukung. Untuk lebih jelasnya
                            dapat dilihat pada penjelasan dibawah ini:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>5.1.1 Penjelasan Naratif</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field-Field yang wajib diisi pada bagian penjelasan naratif terdiri atas 4 bagian yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a. Abstrak Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan abstraksi dari suatu proposal. Panjang karakter dari abstraksi proposal adalah 5000 karakter.
                                tampilan field ini dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/abstrak_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>b. Deskripsi Lengkap</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan deskripsi dari suatu proposal. Panjang karakter dari abstraksi proposal adalah 5000 karakter.
                                tampilan field ini dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/deskripsi_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>c. Keunggulan Teknologi Yang Ditawarkan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan keunggulan teknologi dari suatu proposal. tampilan field ini dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/keunggulan_teknologi_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>d. Potensi Aplikasi Yang Ditawarkan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan potensi aplikasi dari suatu proposal. tampilan field ini dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/potensi_aplikasi_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>5.1.2 Data Pendukung</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field-Field yang wajib diisi pada bagian data pendukung terdiri atas 7 bagian yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a. Tahapan Pengembangan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan tahapan pengembangan yang sudah dilakukan oleh inovator terkait proposal yang dikirimkan.
                                tampilan field ini dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tahapan_pengembangan_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Sistem membatasi tahapan pengembangan kedalam 10 kategori seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tahapan_pengembangan_proposal_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>b. Kebutuhan Akan Proteksi HAKI</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan status HAKI (Hak Atas Kekayaan Intelektual) dari produk yang nantinya dihasilkan.
                                tampilan field ini dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/haki_proposal.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Sistem membatasi tahapan pengembangan kedalam 4 kategori seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/haki_proposal_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">2 kategori teratas, yaitu Telah Memiliki Paten dan Dalam Proses Pendaftaran Paten mengharuskan inovator memasukkan nomor paten seperti yang
                            terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/haki_proposal_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">2 kategori terbawah, yaitu Ingin tapi belum dipaten dan tidak perlu paten tidak mengharuskan inovator memasukkan nomor paten seperti yang
                                terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/haki_proposal_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>c. Kata Kunci Teknologi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan kata kunci teknologi yang terkait dengan produk yang dihasilkan dari proposal. tampilan field ini dapat
                                dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_teknologi.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Field yang ada dalam kata kunci teknologi ini saling terkait dalam artian data dalam kata kunci teknologi level 2 akan bergantung pilihan pada
                            kata kunci teknologi level 1 dan data alam kata kunci teknologi level 3 akan bergantung pada pilihan kata kunci teknologi level 2. Yang perlu diperhatikan
                            adalah pemilihan kata kunci hanya diperbolehkan pada level 3. Selain itu yang perlu diingat adalah pemilihan kata kunci teknologi yang terkait dengan proposal
                            boleh dipilih lebih dari 1 kata kunci teknologi. Proses yang terjadi pada pemilihan kata kunci teknologi dapat dijelaskan seperti pada penjelasan dibawah ini:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>c.1 Pilih Kata Kunci Teknologi Level 1</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ketika kata kunci teknologi level 1 dipilih maka sistem akan merespon dengan melakukan pencarian kata kunci teknologi level 2 seperti yang terlihat
                            pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_teknologi_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses pencarian selesai dilakukan maka sistem akan menampilkan kata kunci teknologi level 2 yang terkait dengan kata kunci teknologi level 1
                            seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_teknologi_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>c.2 Pilih Kata Kunci Teknologi Level 2</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ketika kata kunci teknologi level 2 dipilih maka sistem akan merespon dengan melakukan pencarian kata kunci teknologi level 3 seperti yang terlihat
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_teknologi_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses pencarian selesai dilakukan maka sistem akan menampilkan kata kunci teknologi level 2 yang terkait dengan kata kunci teknologi level 1
                                seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_teknologi_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>c.3 Pilih Kata Kunci Teknologi Level 3</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pilih salah satu kata kunci teknologi level 3 yang dihasilkan dari pemilihan kata kunci teknologi level 2. setelah dipilih maka dilanjutkan dengan
                            mengklik tombol Pilih untuk memasukkan kata kunci teknologi level 3 kedalam tabel sebagai pilihan  yang hasilnya seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_teknologi_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>c.4 Pilih Kata Kunci Teknologi Level 3 Lainnya</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ulangi langkah c.3 untuk memilih kata kunci teknologi level 3 lainnya</p>
                            <p style="text-align: justify;font-size: 14px;">Ada 1 aksi lainnya yang hanya muncul ketika kata kunci teknologi level 3 dipilih. Aksi tersebut adalah hapus pilihan. klik tombol Hapus pada baris
                            dimana kita ingin menghapus kata kunci teknologi level 3</p>
                            <p style="text-align: justify;font-size: 14px;"><b>d. Kata Kunci Aplikasi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan kata kunci aplikasi yang terkait dengan produk yang dihasilkan dari proposal. tampilan field ini dapat
                                dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_aplikasi.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Field yang ada dalam kata kunci aplikasi ini saling terkait dalam artian data dalam kata kunci aplikasi level 2 akan bergantung pilihan pada
                                kata kunci aplikasi level 1 dan data alam kata kunci aplikasi level 3 akan bergantung pada pilihan kata kunci aplikasi level 2. Yang perlu diperhatikan
                                adalah pemilihan kata kunci aplikasi hanya diperbolehkan pada level 3. Selain itu yang perlu diingat adalah pemilihan kata kunci aplikasi yang terkait dengan proposal
                                boleh dipilih lebih dari 1 kata kunci aplikasi. Proses yang terjadi pada pemilihan kata kunci aplikasi dapat dijelaskan seperti pada penjelasan dibawah ini:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>d.1 Pilih Kata Kunci Aplikasi Level 1</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ketika kata kunci aplikasi level 1 dipilih maka sistem akan merespon dengan melakukan pencarian kata kunci aplikasi level 2 seperti yang terlihat
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_aplikasi_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses pencarian selesai dilakukan maka sistem akan menampilkan kata kunci aplikasi level 2 yang terkait dengan kata kunci aplikasi level 1
                                seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_aplikasi_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>d.2 Pilih Kata Kunci Aplikasi Level 2</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ketika kata kunci aplikasi level 2 dipilih maka sistem akan merespon dengan melakukan pencarian kata kunci aplikasi level 3 seperti yang terlihat
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_aplikasi_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses pencarian selesai dilakukan maka sistem akan menampilkan kata kunci aplikasi level 2 yang terkait dengan kata kunci teknologi level 1
                                seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_aplikasi_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>d.3 Pilih Kata Kunci Aplikasi Level 3</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pilih salah satu kata kunci aplikasi level 3 yang dihasilkan dari pemilihan kata kunci aplikasi level 2. setelah dipilih maka dilanjutkan dengan
                                mengklik tombol Pilih untuk memasukkan kata kunci aplikasi level 3 kedalam tabel sebagai pilihan  yang hasilnya seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kata_kunci_aplikasi_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>d.4 Pilih Kata Kunci Aplikasi Level 3 Lainnya</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ulangi langkah d.3 untuk memilih kata kunci aplikasi level 3 lainnya</p>
                            <p style="text-align: justify;font-size: 14px;">Ada 1 aksi lainnya yang hanya muncul ketika kata kunci aplikasi level 3 dipilih. Aksi tersebut adalah hapus pilihan. klik tombol Hapus pada baris
                                dimana kita ingin menghapus kata kunci aplikasi level 3</p>
                            <p style="text-align: justify;font-size: 14px;"><b>e. Fokus Bidang Riset</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan fokus dari bidang riset yang nantinya akan digunakan dalam proposal.
                                tampilan field ini dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/fokus_bidang_riset.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Sistem membatasi fokus bidang riset kedalam 9 kategori riset nasional seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/fokus_bidang_riset_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>f. Kolaborasi Yang Anda Inginkan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan jenis kolaborasi yang inovator harapkan dalam pengembangan produk. tampilan field ini dapat
                                dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kolaborasi.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Field yang ada dalam kolaborasi ini saling terkait dalam artian data dalam kolaborasi level 2 akan bergantung pilihan pada
                                kata kolaborasi 1. Selain itu yang perlu diingat adalah pemilihan kata kolaborasi yang terkait dengan proposal
                                boleh dipilih lebih dari 1 jenis kolaborasi. Proses yang terjadi pada pemilihan kolaborasi dapat dijelaskan seperti pada penjelasan dibawah ini:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>f.1 Kolaborasi Level 1</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ketika kolaborasi level 1 dipilih maka sistem akan merespon dengan melakukan pencarian kolaborasi level 2 seperti yang terlihat
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kolaborasi_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah proses pencarian selesai dilakukan maka sistem akan menampilkan kolaborasi level 2 yang terkait dengan kolaborasi level 1
                                seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kolaborasi_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>f.2 Kolaborasi Level 2</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pilih jenis kolaborasi level 2 yang dihasilkan dari pemilihan kolaborasi level 1. Pemilihan jenis kolaborasi level 2 bisa
                                lebih dari 1.setelah dipilih maka dilanjutkan dengan mengklik tombol Pilih untuk memasukkan kolaborasi level 2 kedalam tabel
                                sebagai pilihan  yang hasilnya seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kolaborasi_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>f.3 Pilih Kolaborasi Level 2 Lainnya</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ulangi langkah f.2 untuk memilih kolaborasi level 2 lainnya</p>
                            <p style="text-align: justify;font-size: 14px;">Ada 1 aksi lainnya yang hanya muncul ketika kolaborasi level 2 dipilih. Aksi tersebut adalah hapus pilihan. klik tombol Hapus pada baris
                                dimana kita ingin menghapus jenis kolaborasi</p>
                            <p style="text-align: justify;font-size: 14px;"><b>f.4 Catatan Bagi Mitra Kolaborasi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pada bagian ini inovator menuliskan catatan-catatan yang dianggap penting dan wajib diketahui oleh mitra kolaborasi. Tampilan
                            dari catatan bagi mitra kolaborasi ini adalah seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/kolaborasi_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>g. Data Institusi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan dari institusi mana inovator tersebut berasal. tampilan field ini dapat
                                dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/institusi.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Ada 3 Field yang wajib diisi oleh inovator berkaitan dengan asal institusi inovator yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>g.1 Nama Institusi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Inovator menuliskan nama institusi dimana inovator berada. Tampilan dari field nama institusi ini seperti pada gambar dbawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/institusi_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>g.2 Bidang Usaha Institusi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Inovator memilih satu dari 9 bidang usaha yang dijalankan institusi dimana inovator berada. Tampilan dari bidang usaha institusi dapat
                                dilihat seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/institusi_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>g.3 Jumlah Karyawan</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pilih jumlah karyawan dari institusi dimana inovator berada. Tampilan dari jumlah karyawan adalah seperti yang terlihat pada
                            gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/institusi_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>5.1.3 Data & File Pendukung</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field-Field yang wajib diisi pada bagian data & file pendukung terdiri atas 2 bagian yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a. Data Peneliti/Inovator/Tim Peneliti</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini nantinya akan menjelaskan tim peneliti/inovator yang terlibat dalam proposal yang diajukan.
                                tampilan field ini dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Secara garis besar data peneliti/inovator/tim peneliti dibagi atas 2 bagian besar:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a.1 Daftar Peneliti</b></p>
                            <p style="text-align: justify;font-size: 14px;">Daftar peneliti berisikan daftar peneliti yang mungkin tergabung dalam tim yang dimiliki inovator. Daftar peneliti bisa berisikan
                                inovator itu sendiri dan juga tim dimana inovator berada. tampilan daftar peneliti dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Seperti yang terlihat pada gambar diatas, ada 4 aksi yang dapat dilakukan pada bagian daftar peneliti diantaranya adalah sebagai
                            berikut:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a.1.1 Tambah Peneliti</b></p>
                            <p style="text-align: justify;font-size: 14px;">Tambah Peneliti adalah aksi untuk menambahkan anggota peneliti. Setelah tombol tambah peneliti diklik maka akan muncul tampilan
                                seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Isi field-field yang disediakan terutama untuk nama, email dan institusi. ketiga field ini wajib diisi, apabila tidak diisi maka akan
                                akan muncul pesan error seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Setelah diisi maka klik tombol Tambah untuk menambahkan inovator baru kedalam daftar peneliti</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a.1.2 Edit Peneliti</b></p>
                            <p style="text-align: justify;font-size: 14px;">Edit Peneliti adalah aksi untuk edit salah satu anggota peneliti yang ada dalam daftar peneliti. Setelah tombol edit diklik maka akan muncul tampilan
                                seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Proses update data peneliti mirip dengan proses penambahan peneliti</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a.1.3 Hapus Peneliti</b></p>
                            <p style="text-align: justify;font-size: 14px;">Hapus Peneliti adalah aksi untuk hapus salah satu anggota peneliti yang ada dalam daftar peneliti. Setelah tombol hapus diklik maka
                                sistem akan mulai melakukan proses penghapusan. Apabila proses penghapusan berhasil dilakukan maka akan muncul popup seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>a.1.4 Pilih Peneliti</b></p>
                            <p style="text-align: justify;font-size: 14px;">Pilih peneliti adalah suatu aksi untuk memilih peneliti mana aja yang akan diikutsertakan dalam proposal. Setelah di klik maka
                                akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_6.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Selanjtunya pilih posisi dari peneliti pada proposal. Setelah dipilih posisi peneliti maka klik tombol pilih untuk memilih
                            peneliti masuk dalam tim peneliti pada proposal. Hasil pemilihan tersebut dapat dilihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_7.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>a.2 Tim Peneliti Proposal ini</b></p>
                            <p style="text-align: justify;font-size: 14px;">Tim peneliti proposal berisikan peneliti-peneliti yang terpilih untuk terlibat dalam pengerjaan proposal. Tampilan dari tim
                                peneliti adalah seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_7.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Ada 2 aksi yang ada pada bagian tim peneliti proposal yaitu:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a.2.1 Edit</b></p>
                            <p style="text-align: justify;font-size: 14px;">Edit adalah aksi untuk edit posisi dari peneliti dalam proposal. Setelah tombol edit diklik maka akan muncul tampilan
                                seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_8.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Proses edit ini mirip dengan proses peneliti yang ada pada bagian a.1.4</p>
                            <p style="text-align: justify;font-size: 14px;"><b>a.2.2 Hapus Peneliti</b></p>
                            <p style="text-align: justify;font-size: 14px;">Hapus Peneliti adalah aksi untuk hapus salah satu anggota peneliti yang ada dalam tim peneliti pada proposal. Setelah tombol hapus diklik maka
                                sistem akan mulai melakukan proses penghapusan. Apabila proses penghapusan berhasil dilakukan maka akan muncul popup seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/tim_peneliti_5.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>b. File</b></p>
                            <p style="text-align: justify;font-size: 14px;">Field ini akan digunakan inovator untuk mengupload file-file yang terkait proposal yang mungkin akan membantu dewan juri dalam
                                memberikan penilaian terhadap proposal inovator. Tampilan dari field File adalah seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/file.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Aksi-aksi yang ada pada bagian File ini diantaranya adalah sebagai berikut:</p>
                            <p style="text-align: justify;font-size: 14px;"><b>b.1 Tambah File</b></p>
                            <p style="text-align: justify;font-size: 14px;">Ketika tombol tambah file di klik maka akan muncul tampilan seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/file_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Klik tombol Select File untuk memilih file yang upload terkait proposal. setelah tombol Select File di klik maka akan muncul tampilan
                                seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/file_2.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Pilih file yang akan diupload dan dilanjutkan dengan klik tombol Open. Setelah tombol Open di klik maka tampilannya adalah seperti
                                pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/file_3.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Bersamaan dengan file terpilih maka akan muncul 2 aksi baru, seperti yang terlihat pada gambar diatas, yaitu Change dan Remove. tombol
                                Change digunakan untuk mengganti file yang terpilih atau tombol Remove digunakan untuk remove file yang sudah terpilih.</p>
                            <p style="text-align: justify;font-size: 14px;">Setelah file terpilih maka inovator menekan tombol Upload untuk memulai proses upload. Apabila proses upload berhasil dilakukan maka akan
                                muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/file_4.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;"><b>b.2 Hapus File</b></p>
                            <p style="text-align: justify;font-size: 14px;">Aksi hapus file dilakukan untuk menghapus file yang sudah diupload keserver dengan mengklik tombol Hapus. apabila proses hapus berhasil
                            dilakukan maka akan muncul popup pesan berhasil seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/file_5.png"/><br><br>
                        </li>
                        <li>
                            <p style="text-align: justify;font-size: 14px;"><b>Aksi</b></p>
                            <p style="text-align: justify;font-size: 14px;">Aksi yang ada pada fitur lengkapi proposal, yang direpresentasikan dengan tombol, terdiri dari 3 aksi yaitu</p>
                            <p style="text-align: justify;font-size: 14px;"><b>1. Mohon Reviewe</b></p>
                            <p style="text-align: justify;font-size: 14px;">Aksi mohon review dilakukan oleh inovator apabila proposal sudah lengkap. Karena itu tombol Mohon Review akan aktif apabila proposal sudah
                                lengkap. Setelah tombol Mohon review di klik maka akan muncl tampilan seperti yang terlihat pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/mohon_review.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Inovator dapat menuliskan pesan atau catatan yang bisa dibaca oleh reviewer pada bagian Isi Pesan (lihat gambar). Pada bagian data Proposal
                            berisikan detail proposal dari inovator yang nantinya akan dicek kelengkapannya oleh inovator. Setelah selesai menuliskan isi pesan maka inovator dapat
                            mengirimkan mohon reviewnya dengan mengklik tombol Kirim Email. Apabila proses pengiriman email berhasil dilakukan maka akan muncul tampilan seperti pada
                            gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/mohon_review_1.png"/><br><br>
                            <p style="text-align: justify;font-size: 14px;">Sistem kemudian akan me redirect halaman web ke tampilan awal lihat proposal</p>
                            <p style="text-align: justify;font-size: 14px;"><b>2. Batalkan Proposal</b></p>
                            <p style="text-align: justify;font-size: 14px;">Aksi batalkan proposal adalah aksi untuk membatalkan proposal. Setelah tombol Batalkan proposal di klik maka akan muncul tampilan seperti pada
                                gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/batalkan_proposal.png"/>
                            <p style="text-align: justify;font-size: 14px;">Klik tombol Ya untuk membatalkan proposal dan Tidak untuk membatalkan proposal. Setelah tombol Ya di klik maka sistem memproses permintaan tersebut
                                dan apabila proses berhasil maka akan muncul tampilan seperti pada gambar dibawah ini:</p>
                            <img src="<?php echo env('APP_URL'); ?>/public/storage/manual/inovator/batalkan_proposal_1.png"/>
                            <p style="text-align: justify;font-size: 14px;">Sistem kemudian akan me redirect halaman web ke tampilan awal lihat proposal</p>
                            <p style="text-align: justify;font-size: 14px;"><b>3. Kembali</b></p>
                            <p style="text-align: justify;font-size: 14px;">Aksi kembali adalah aksi untuk me redirect halaman web ke tampilan awal lihat proposal</p>
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