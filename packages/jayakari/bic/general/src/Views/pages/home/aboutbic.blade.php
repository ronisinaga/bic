@extends('jayakari.bic.general::layouts.default')
@section('header_page')
    <link href="<?php echo env('APP_URL'); ?>/assets/toastr/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/general/pages/css/loading.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/general/pages/home/css/registrasi.css" rel="stylesheet" type="text/css" />
@stop
@section('content')
    <div class="main">
        <div class="modal"></div>
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo env('APP_URL'); ?>">General</a></li>
                <li><a href="javascript:;">Utama</a></li>
                <li class="active">Mengenai BIC</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Mengenai BIC</h1>
                    <div class="content-page">
                        <div class="row">
                            <div class="col-md-12 blog-item">
                                <div class="blog-item-img">
                                    <!-- BEGIN CAROUSEL -->
                                    <div class="front-carousel">
                                        <div id="myCarousel" class="carousel slide">
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <img src="{{url('public/jayakari/bic/regular/pages/home/img/bic_small.jpg')}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END CAROUSEL -->
                                </div>
                                <h3><b>Pendahuluan</b></h3>
                                <p>Dalam hal pembangunan Nasional diperlukan fondasi yang kuat antara tiga pihak yaitu, Pemerintah, Akademisi, dan Pelaku Bisnis (ABG, Academician, Business, and Government), untuk menjembatani antara tiga sektor ini diperlukan sebuah lembaga/organisasi khusus. Oleh karena itu Kementerian Negara Riset dan Teknologi mendirikan BIC (Business Innovation Center), suatu organisasi  yang berfungsi untuk mengembangkan sinergi antara ABG dalam hal inovasi yang sampai saat ini belum optimal.</p>
                                <p>Saat ini ABG belum mengembangkan sinergi secara optimal. Diantara tiga sector ini masih melakukan kegiatan secara individu yang akhirnya tidak dapat mengoptimalkan kegiatan mereka. Dalam hal inovasi, Indonesia memiliki banyak inovasi yang sudah terkonsep oleh pihak-pihak akademisi dan pemerintah tetapi belum dapat berkembang karena beberapa hambatan diantaranya, keuangan dan masalah pengembangan ke pasar (market), hal ini terjadi karena belum terbukanya pihak ini terhadap pihal lain atau swasta (Bisnis) dalam hal kerjasama untuk mengoptimalkan proses pemasaran produk mereka.</p>
                                <p>Hal serupa terjadi oleh pihak bisnis yang harus selalu memenuhi kebutuhan pasar yang memiliki time cycle product yang cepat, pihak bisnis harus dapat mengembangkan produk inovasi dengan cepat oleh karna itu pihak ini sangat memerlukan keterlibatan pihak akademis dalam hal pengembangan produk-produk inovasi. BIC bertujuan untuk menggunakan kesempatan ini dalam hal melakukan intermediasi kepada tiga pihak ini dengan tujuan mengembangkan sinergi kerjasama antar ke tiga belah pihak.</p>
                                <p>Memberikan pelayanan sabagai lembaga yang mengoptimalkan komersialisasi terhadap teknologi atau inovasi, dengan adanya kelembagaan BIC diharapkan dapat mengembangkan proses berkembangnya inovasi sehingga dapat digunakan oleh pasar. Selama ini badan riset yang dimiliki negara atau pusat-pusat penilitian hanya memfokuskan diri kedalam pengkajian penelitian dan mengadakan studi banding dengan beberapa instansi negara di luar negri untuk mengoptimalkan hasil riset dan teknologi (inovasi), tetapi badan-badan/ kelembagaan ini   memiliki keterbatasan terhadap  pengetahuan pasar dan trend produk yang diminati oleh pasar yang nantinya akan menghambat penyampaian teknologi ke pasar, melihat kondisi tersebut, peran BIC adalah mengadakan analisa mengenai pasar dan trend produk di pasar yang nantinya akan digunakan sebagai informasi dalam pengembangan teknologi/inovasi yang pada proses akhir akan digunakan oleh pasar.</p>
                                <p>BIC juga diharapkan dapat membuat sebuah sinergi atau menjembatani ekosistem dunia usaha dengan pusat teknologi/inovasi. Karena perkembangan jaman atau pengaruh globalisasi yang membuat life cycle suatu produk menjadi semakin cepat, dunia usaha sangat memerlukan peran pusat-pusat kajian teknologi untuk membantu pengembangan produk usaha tersebut, oleh karna itu BIC harus dapat menjembatani permintaan daripada pihak dunia usaha tersebut.</p>
                                <p>Disini BIC diharapkan dapat melakukan analisa terhadap pihak-pihak usaha yang ingin melakukan investasi terhadap kajian-kajian pusat teknologi/inovasi, sehingga nantinya akan terjalin sebuah kerjasama dalam hal pengembangan anatara pihak pusat kajian teknologi dan pihak dunia usaha yang nantinya diharapkan pihak swasta akan memberikan modal terhadap pusat kajian teknologi. Tujuan dari BIC sendiri adalah menciptakan sebuah lingkungan yang kodusif terhdap ABG yang nantinya diharapkan akan menciptakan Teknologi/inovasi yang bisa dinikmati oleh pasar dan bahkan bisa berkembang pesat dan memajukan produk-produk inovasi Indonesia yang bisa bersaing di dunia.</p>
                                <h3><b>Business Innovation Center</b></h3>
                                <p>Pada tahun 2008 Kementerian Negara Riset dan Teknologi Republik Indonesia menetapkan sebagai Tahun Inovasi oleh karena itu Business Innovation Center yang disingkat BIC didirikan dengan tujuan mengoptimalkan pemberdayaan Inovasi di Indonesia dengan tujuan meningkatkan pembangunan nasional.</p>
                                <h3><b>Inisiasi BIC</b></h3>
                                <p>Program ini merupakan program yang ditujukan untuk memacu pengembangan inovasi melalui pemanfaatan teknologi. Di dalam kegiatannya Business Innovation Center (BIC) akan melibatkan semua unsur ABG</p>
                                <h3><b>Siapa yang bisa mendapatkan pelayanan BIC</b></h3>
                                <p>BIC memberikan pelayanan  terhadap tiga sektor inti yaitu akademisi, pelaku bisnis, dan pemerintah.</p>
                                <h3><b>Bagaimana menggunakan pelayanan BIC</b></h3>
                                <p>Pelayanan BIC dapat digunakan oleh pihak-pihak yang ingin memanfaatkan pelayanannya. Dengan menghubungi staff BIC dan melengkapi data-data yang nantinya akan disimpan dalam database dan proses selanjutnya adalah langkah mediasi/intermediasi</p>
                                <h3><b>Visi Misi</b></h3>
                                <p>Visi Misi BIC dalam mengembangkan inovasi di Indonesia dengan menjadi jembatan antara para peneliti dengan dunia industri</p>
                                <h4><b>Visi BIC</b></h4>
                                <p>Menjadi lembaga intermediasi inovasi bisnis yang terdepan, dalam menunjang daya saing ekonomi dan Bisnis Indonesia. Hal ini dilakukan dengan mensinergikan elemen-elemen Akademisi, Business, dan Government (A-B-G) dalam proses inovasi bisnis, sehingga dalam waktu 10 tahun, kegiatan inovasi di Indonesia akan menjadi unggulan (benchmark) negara-negara lain di ASEAN.</p>
                                <h4><b>Misi BIC</b></h4>
                                <p>Mendorong inovasi business di Indonesia, melalui kegiatan intermediasi antara inovator pengembangan teknologi dengan dunia bisnis. Menjadi lembaga intermediasi proses inovasi bisnis, untuk menciptakan nilai tambah ekonomi dan bisnis dan daya saing nasional Indonesia.</p>
                                <h3><b>Jasa dan Layanan BIC</b></h3>
                                <p>Business Innovation Center memberikan beberapa jenis layanan yaitu layanan umum, swasta, akademisi dan pemerintah yang sesuai dengan fungsi dan tujuan BIC. Jenis layanan tersebut antara lain adalah sebagai berikut:</p>
                                <h4><b>Layanan Umum</b></h4>
                                <p>Dalam menjalankan fungsinya BIC memberikan layanan-layanan dasar melalui pelayanan dalam bidang konsultasi Inovasi sebagai berikut:</p>
                                <ol>
                                    <li>Kunjungan ke perusahaan-perusahaan</li>
                                    <li>Menganalisa dan mengoptimalakan rangkaian nilai proses kerja, perusahaan, pemasok, membantu mencarikan mitra kerjasama yang tepat dari kalangan ipetek</li>
                                    <li>Mengadakan gathering dan seminar dalam hal menjembatani ABG</li>
                                    <li>Memberikan secara terus-menerus informasi tentang perkembangan teknologi baru dan proses produksi</li>
                                    <li>Mengidentifikasikan risiko dan mengenali potensinya</li>
                                    <li>Memberikan pendampingan pada perusahaan-perusahaan yang inovatif</li>
                                    <li>Membuat database yang menampung informasi mengenai proses-proses inovasi</li>
                                    <li>Mengatur pertukaran para pakar yang dibutuhkan dengan keahlian tertentu</li>
                                    <li>Mengatur pertemuan para pakar untuk dapat menjalin kerjasam</li>
                                </ol>
                                <h4><b>Layanan untuk Swasta/Bisnis</b></h4>
                                <ol>
                                    <li>Mempermudah proses pencarian Informasi mengenai Inovasi</li>
                                    <li>Mempermudah Pengembangan bisnis dengan penerapan Inovasi</li>
                                    <li>Memperluas hubungan dengan pemerintah dan akademisi</li>
                                    <li>Menghubungkan para pelaku bisnis dalm hal mendapatkan insentif yang diberikan oleh pemerintah</li>
                                    <li>Memberikan Informasi mengenai kajian-kajian teknologi yang sedang berlangsung</li>
                                    <li>Menyusun agenda dan pengaturan pertemuan dengan pusat-pusat kajian teknologi</li>
                                </ol>
                                <h4><b>Layanan untuk Akademisi/Teknisi</b></h4>
                                <ol>
                                    <li>Membantu mengembangkan produk Inovasi yang sudah ada untuk di komersilkan</li>
                                    <li>Membantu dalam hal finansial yang akan dibantu oleh pihak swasta/pelaku bisnis</li>
                                    <li>Memberikan jaringan/network pelaku bisnis dalam hal kerjasama terhadap pihak akademisi</li>
                                    <li>Memberikan pengetahuan mengenai pasar dan trend yang ada di pasar</li>
                                    <li>Membantu menghubungkan kepada pihak dunia usaha dalam hal kerjasama</li>
                                    <li>Membantu melakukan analisi terhadap pihak dunia usaha yang memiliki interest untuk berinvestasi terhadap riset yang dilakukan</li>
                                </ol>
                                <h4><b>Layanan untuk Pemerintah</b></h4>
                                <ol>
                                    <li>Memperat hubungan pemerintah dengan pihak swasta/bisnis dan akademisi/teknisi</li>
                                    <li>Memberikan dukungan terhadap program-program pemerintah dalam hal inovasi</li>
                                    <li>Memajukan pengembangan teknologi inovasi dalam skala nasional</li>
                                    <li>Memfasilitasi pemerintah dengan pihak swasta/bisnis dan akademisi/teknisi</li>
                                    <li>Memfasilitasi program incentif yang dibuat oleh pemerintah</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@stop
@section('footer_page')
    <script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/scripts/aboutbic.js" type="text/javascript"></script>
    <script type="text/javascript">
        var host = "<?php echo env('APP_URL'); ?>";
    </script>
@stop