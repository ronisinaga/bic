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
                <li class="active">Testimoni</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Apa kata mereka tentang BIC</h1><br>
                    <div class="content-page">
                        <div class="row">
                            <div class="col-md-12 blog-posts">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/Kristanto-Santosa.jpg')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Kristanto Santosa - Business Innovation Center</a></h2>
                                        <h4><b>Akhir  2007:</b></h4>
                                        <p>Semuanya cuma berawal dari "wacana"?</p>
                                        <p>Ditambah sejumput semangat dan keyakinan</p>
                                        <p>Walau semula tak tahu kami mau ke mana?</p>
                                        <p>Semangatpun kami angkat  jadi  "master-plan"</p><hr>
                                        <h4><b>2008:</b></h4>
                                        <p>Jadi awalnya kami rajin mendatangkan pakar</p>
                                        <p>Modusnya mengantar, tapi sejujurnya kami belajar</p>
                                        <p>Agar eksis kami berkonferensi inovasi dan seminar akbar</p>
                                        <p>Ternyata "100 Inovasi Indonesia" yang lebih gempar</p><hr>
                                        <h4><b>2009:</b></h4>
                                        <p>Missi utama kami adalah  intermediasi  inovasi<p>
                                        <p>Konkritnya jadi “mak comblang“ litbang dan industri</p>
                                        <p>Kami  kira MOU target gampang, secuplis, dan teknis</p>
                                        <p>Tak sangka ternyata “sadis”, tragis, berpeluh, dan tangis</p><hr>
                                        <h4><b>Awal 2010:</b></h4>
                                        <p>Resiko kami gendong terus memasuki  hari depan<p>
                                        <p>Tapi, resiko bukan lagi dalam agenda tantangan kami</p>
                                        <p>Resiko adalah sumber harapan dan kehidupan</p>
                                        <p>Karena, resiko adalah bagian dari proses berinovasi</p><br><br>
                                        <p><b>With Our Compliments:</b></p>
                                        <p>Terimakasih pada tim BIC semua yang luar biasa,</p>
                                        <p>Ternyata Anda menyimpan energi inovasi raksasa.</p>
                                        <p>Terimakasih pada segenap anggota BOD Ristek,</p>
                                        <p>Sebagai mitra kerja, berbagi  teori  dibanding praktek.</p><br>
                                        <p>Terimakasih untuk para juri, sponsor, dan para mitra kerja,</p>
                                        <p>Untuk dedikasi, sumbangan, dan kerja keras Anda semua.</p>
                                        <p>Anda mencengangkan kami , saat menengok ke belakang,</p>
                                        <p>Dan menyadari betapa banyaknya yang Anda telah sumbang.</p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/Pudjianto-Tirtomuljono.jpg')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Pudjianto Tirtomuljono - Business Innovation Center</a></h2>
                                        <p>Tanggal 13 Maret 2010 , mengingatkan perjalanan BIC dari 2 tahun lalu , walau saya bergabung  diakhir tahun 2008 ( berarti 1,5 tahun lalu) , banyak hal yang dapat diingat  dan masih harus diperjuangkan.</p><hr>
                                        <p>Melihat begitu banyak teknologi dan penelitian yang diam ditempat  yg tentunya sangat bermanfaat bila dapat dimasyarakatkan secara komersil , sesuai misi dan visi BIC . Benturan – benturan dan maslah terjadi dalam pengembangannya , tidak cukup hanya menjodohkan saja.  Pihak sawata tertarik , pihak peneliti belum siap , pihak peneliti siap – pihak swasta tdk tertarik , tarik ulur ini begitu mempengaruhi pengembangan BIC , dan perlu ekstra semangat dan kerja dan tidak cukup hanya berbekal idealisme dan kepandaian saja tapi harus juga berpikir keras dan baik. Sangat kompleks untuk menjadikan nilai suatu pekerjaan untuk berhasil, diperlukan fleksibilitas dan pengetahuan yang luas, tentunya juga seperti perusahaan pada umumnya yang berbasis bisnis murni  bahkan lebih berat untuk menjadikan BIC mempunyai nilai dan dikenal masyarakat yg memerlukannya.</p>
                                        <p>Relationship perlu , tetapi tidak cukup , nilai bisnis saja juga tidak cukup, penggabungan semua positif point diperlukan untuk BIC berhasil , masih panjang jalannya walau sudah mulai terlihat hasilnya, diperlukan teamwork yang baik , padahal kita kita di didik individualistic oleh sekeliling kita.</p>
                                        <p><b>Selamat Ulang Tahun BIC</b> , mudah mudahan mental dan semangat tetap terjaga dan maju terus untuk mencapai misi dan visi BIC yang baik bagi masyarakat dan bangsa Indonesia kedepan.</p>
                                        <p>BIC mendapat kado pada tgl 12 Maret 2010 , yaitu dua (2) MoU , kerjasama Balai Besar Keramik – Bandung dengan Dwitunggal Cipta Makmur untuk pengembangan bahan baku keramik , dan industri PCP-Permeable Ceramik Paving.</p>
                                        <p>Salut juga buat teman teman di Ristek yang begitu kuatnya mendorong konsep ABG menjadi kenyataan. Kita dapat merenungkan , act nya dari yang punya konsep pertama kali dalam mendirikan BIC perlu dicontoh.</p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/Hariyanto-Salim1.jpg')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Hariyanto Salim - Business Innovation Center</a></h2>
                                        <p>Hari ini dua tahun yang lalu, saya pertama kalinya datang ke BIC, dan agak terkejut dengan desain bangunannya yang modern dan futuristik. Lokasi BIC di dalam kompleks Mega Kemayoran juga sangat menguntungkan karena fasilitas parkirnya yang luas dan nyaman. Ada kolam dengan ikan koi di depan kantor, taman kecil yang asri, membuat suasana depan kantor BIC sangat nyaman.</p><hr>
                                        <p>Masuk ke dalam bangunan kita langsung melihat ruang yang lapang bisa digunakan untuk pertemuan dengan jumlah 100+ orang. Kantor BIC sendiri ada di Lt. 2, dan menempati ruangan yang paling luas dan kemudian disekat menjadi 2 ruangan yang lebih kecil untuk kantor dan pertemuan.</p>
                                        <p>Ruangan kantor diisi dengan beberapa perabotan dan peralatan kantor, berupa meja, kursi, dan lain-lain. Peralatan kantor masih banyak yang swadaya, menggunakan peralatan yang dimiliki pribadi, seperti laptop dan proyektor. Maklum lah, institusi not for profit baru.</p>
                                        <p>Sejalan dengan waktu, BIC berhasil melakukan beberapa hal, dan perlahan-lahan bisa mendandani diri. Beberapa laptop dapat dibeli, begitu pula komputer desktop, projector. Ruangan BIC pun diperbesar, dan kini menempati ruangan yang dulunya digunakan sebagai Unit Peraga Apartemen. Karena sebagai show unit, desain interiornya betul-betul seperti rumah di apartemen. Sangat comfy. Kalau bekerja di BIC, seperti kerja di rumah. Apalagi orang-orangnya sangat ramah dan baik hati.</p>
                                        <p>Melihat kilas balik 2 tahun yang lalu, saya berpikir, untung waktu itu saya ikut membantu di BIC.</p>
                                        <p><b>Selamat Ulang Tahun BIC.</b></p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/Dimas-Sandy-Yuditya.jpg')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Dimas Sandy Yuditya - Business Innovation Center</a></h2>
                                        <p>Hari ini 13 Maret dua tahun yang lalu, atau tepatnya tanggal 26 Maret 2008 menjadi sebuah momen bersejarah bagi diri saya. Tanggal tersebut menjadi hari pertama saya bekerja sebagai pegawai tetap di sebuah organisasi atau perusahaan. Saat itu saya baru saja menyelesaikan program studi sarjana saya di Malaysia, saya kembali ke Jakarta untuk mengisi waktu luang selagi menunggu moment wisuda pada bulan Agustus mendatang. Selagi di Jakarta saya ditawari sebuah pekerjaan oleh kerabat keluarga, dan akhirnya saya memutuskan untuk mengambil kesempatan berharga tersebut.</p><hr>
                                        <p>Hari Pertama saya memulai bekerja diawali dengan sebuah wawancara dengan Bapak Kristanto Santosa. Wawancara dilakukan di tower A, Mega Kemayoran. Seperti pada umumnya, wawancara dilakukan dengan menanyakan visi dan misi dan beberapa pertanyaan formal seputar diri saya. Ada satu statement dari Pak Kristanto yang saya ingat pada saat itu, beliau mengatakan bahwa : Jika Anda bertanya kepada saya, mengenai apa yang harus dilakukan dalam Organisasi ini, Saya juga tidak tahu. Beliau menyarankan agar saya terus berani dan tidak takut salah dalam mencoba.  Hal tersebut menjadi pemacu semangat saya dalam mengembangkan diri.</p>
                                        <p>Memang pada saat itu Organisasi yang dikenal dengan Business Innovation Center adalah sebuah lembaga/institusi baru yang didirikan atas inisiasi dasar Kementerian Negara Riset dan Teknologi. Dengan mengedepankan aktivitas dalam menciptakan sinergi antara A-B-G (Academics, Business, and Government). Memang pada saat itu lembaga seperti BIC masih dinilai baru khususnya di Indonesia, BIC  adalah badan independent yang menjalankan tugasnya dengan aktivitas intermediasi A-B-G.</p>
                                        <p>Di awal-awal perjalanan BIC merupakan hal yang saya tidak bisa lupakan. Berbekal jaringan dari Bapak Kristanto Santosa, BIC menjadi sebuah lembaga yang disoroti oleh khalayak luas khususnya dunia bisnis. Banyak para pebisnis ternama yang menjadi pendukung BIC. Hal tersebut menjadi sebuah hambatan awal diri saya dalam berkomunikasi. Berbekal status sebagai fresh graduate menjadi sebuah hambatan ketidakpercayaan diri bagi saya untuk berkomunikasi dengan expertise tersebut . Namun dukungan dan kepercayaan yang diberikan kepada saya menjadi sebuah dorongan untuk memacu kearah pengembangan yang lebih baik. Belajar dari setiap kesalahan dan tentunya dari rekan-rekan di BIC menjadihal yang paling baik dalam pengembangan diri saya sampat saat ini.</p>
                                        <p>Terima Kasih Business Innovation Center, Terima Kasih Rekan-rekan BIC.</p>
                                        <p>Saya mengucapkan selamat Ulang tahun yang ke 2 bagi BIC. Semoga menjadikan BIC lebih sukses dan menjadi  lebih solid…</p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/Aditya-Chaerunissa1.jpg')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Aditya Chaerunissa - Business Innovation Center</a></h2>
                                        <p>Pada Tanggal 20 Oktober 2009 BIC mendapat support dari MCI untuk ikut serta dalam pameran Medihealth Expo (20 - 24 Oktober 2009) di Mal Taman Anggrek.</p><hr>
                                        <p>Di sana saya ditugaskan untuk mempersiapkan stand pameran BIC, pada saat itu jujur saya masih bingung apa saja yang harus dipersiapkan agar BIC tampil semenarik mungkin di pameran tersebut.</p>
                                        <p>Tetapi setelah saya ikut technical meeting dari MCI dan juga bantuan dari Pak Eko dan Pak Yusman Progressio, akhirnya saya bisa memahami dan mengerti dalam mempersiapan stand pameran yang akan diselenggarakan.</p>
                                        <p>Akhirnya saya di berikan tantangan oleh Pak Kristanto dan Pak Pudji, mereka yakin kalau saya bisa melakukannya sendiri untuk persiapan  awal hingga selesai pamerannya.</p>
                                        <p>Rasa ketakutan dan bimbang saya berubah menjadi percaya diri penuh, walaupun menurut saya kurang memuaskan penampilan dari stand BIC pada saat pameran. Tetapi dengan kegiatan tersebut, saya bisa mengambil hikmah bahwa ternyata tidak mudah mengerjakan stand pameran jika tidak ada konsep yang terarah sebelumnya.</p>
                                        <p>Demikian momen yang tak terlupakan dari saya dan <b>Selamat Ulang Tahun BIC.</b></p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/Ayudiya-Erwitasari.jpg')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Ayudiya Erwitasari - Business Innovation Center</a></h2>
                                        <p>Februari 2008 merupakan awal saya bergabung untuk membantu mempersiapkan suatu Organisasi  Inovasi yang di bentuk oleh Kementerian Negara Riset dan Teknologi (RISTEK).</p><hr>
                                        <p>Organisasi tersebut diberi nama Business Innovation Center (BIC) yang resmi lahir pada tanggal 13 Maret 2008, 2 tahun yang lalu. Pada awalnya saya masih bingung  apa itu BIC dan bagaimana cara Organisasi Inovasi ini berjalan karena jujur saja ini adalah pengalaman pertama saya bekerja di dalam suatu badan atau organisasi. Tetapi seiring berjalannya waktu saya terus belajar juga terus diberi semangat  dan keyakinan oleh Bapak  Kristanto Santosa bahwa saya bisa menjalankan tugas dan aktifitas yang menjanjikan di Organisasi ini.</p>
                                        <p>BIC adalah rumah kedua saya, banyak sekali pelajaran dan  ilmu yang saya dapatkan selama bergabung di BIC juga suasana kekeluargaan yang sangat kuat sekali saya rasakan pada saat itu. Pelajaran bagaimana saya bisa bersosialisasi dengan para peneliti di lembaga LitBang pemerintahan maupun akademisi, bersosialisai dengan teman-teman swasta/bisnis yang mungkin tidak akan saya dapatkan jika tidak bergabung di Business Innovation Center.</p>
                                        <p>Terima kasih BIC, terimakasih rekan-rekan semuanya...selama lebih kurang 1 (satu) tahun 3 bulan saya menjadi bagian dari keluarga BIC merupakan kenangan dan pengalaman yang sangat berharga dalam perjalanan hidup saya.</p>
                                        <p>Dan semua kegiatan yang saya telah lakukan di BIC adalah momen-momen yang paling membanggakan. Selamat Ulang Tahun Business Innovation Center, sukses selalu dan SALAM INOVASI!!!</p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/kusmayanto-kadiman.png')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Kusmayanto Kadiman-Menteri Negara Riset dan Teknologi RI (2004-2009)</a></h2>
                                        <p>Banyak faktor yang menyebabkan Iptek nasional belum memberikan kontribusi besar terhadap pertumbuhan ekonomi. Bukan hanya bila dilakukan perbandingan terhadap negara maju bahkan new emerging industralizing countries (AS dan Kelompok Negara Barat serta Korea Selatan, Cina, India, Brazil, bahkan Malaysia, tetangga kita). Mereka telah memposisikan iptek menjadi lokomotif pertumbuhan ekonomi. Sektor Iptek nasional belum bisa terhitung sebagai topik yang wajib dibahas dalam berbagai diskusi tentang perkembangan ekonomi negara tercinta.</p><hr>
                                        <p>Jalan pintas dengan orientasi jangka ‘super pendek’ guna mencari keuntungan finansial masih memerangkap sikap sebagian besar anggota sektor produksi. Hal ini menyebabkan Iptek dilihat dengan kacamata penuh kecurigaan, terutama dianggap sebagai pemberat anggaran dan bukan penggembung pundi hasil pembangunan.</p>
                                        <p>Salah satu faktor yang telah banyak diidentifikasi oleh para analis adalah ketidakharmonisan cara pandang dan ‘perilaku relasional’ antara kelompok pelaku industri/distribusi (Bisnis, B) serta pelaku Litbang Nasional (Akademik, A). Pemerintah (Government, G) pun jelas tidak lepas dari kewajiban bertanggungjawab. Kebijakan pemerintah yang dilansir selama ini belum mengusung semangat agar relasi keduanya bisa berjalan dengan lebih mulus. ABG di Indonesia perlu mengalami transformasi pola pikir agar bisa saling bersinergi dengan lebih mulus, persis seperti pada pola yang terjadi dalam berbagai negara yang disebutkan di atas.</p>
                                        <p>Kehadiran Business Innovation Center (BIC) tentu merupakan angin segar dalam upaya sinkronisasi ketiga elemen ABG. Inisiatif pembentukan BIC dengan misi membentuk jembatan bagi unsur A dengan unsur B, B dengan G, dan A dengan G.</p>
                                        <p>Dengan inovasi sebagai kata kunci BIC telah memulai langkah dengan tepat. Bukan hanya inovasi pada peciptaan produk utuh dan proses, melainkan inovasi menjadikan manusia Indonesia mau dan mampu melihat, menangkap, dan memberikan nilai tambah pada kekayaan Indonesia yang terkenal sebagai zamrud khatulistiwa ini.</p>
                                        <p>Paradoks kekayaan alam yang melimpah namun kemakmuran rakyat lemah, terlalu lama hidup di Indonesia. ABG adalah senjata yang perlu diajukan untuk menghapuskan paradoks tersebut dari bumi pertiwi.</p>
                                        <p>Saya memberikan acungan jempol dan tentu mendukung sepenuhnya pemikiran dan upaya strategis dan taktis BIC. Sepenuh hati, saya berikhtiar untuk turut mendorong semangat BIC menjadikan iptek memiliki posisi sepatutnya dalam tata kelola seluruh lapisan dan golongan yang ada di Indonesia. BIC adalah bagian lembaran baru transformasi ekonomi Indonesia yang tidak hanya menjamin ketersediaan lapangan kerja baru dan mengurangi jumlah orang miskin, namun kembali menjadikan negara kita kembali diperhitungkan di peta politik dunia.</p>
                                        <p>Selamat atas dibentuknya BIC. Saya ucapkan “Selamat”, karena saya percaya BIC adalah monumen hidup terbangunnya kembali kepercayaan diri Bangsa.</p><br><br>
                                        <p>Kusmayanto Kadiman</p>
                                        <p>Menteri Negara Riset dan Teknologi,  Republik Indonesia</p>
                                        <p>2004-2009</p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Dr. Hitendra Patel - Managing Director of the IXL Center</a></h2>
                                        <p><b>Chair of the innovation and growth program at the Hult International Business School Cambridge, MA., USA.</b></p>
                                        <p>BIC menjalankan peranan yang sangat penting dan ‘time-critical’ untuk mensinergikan universitas, Enterprise (Usaha) Kecil dan Menengah, Industri, Institusi Riset dan Organisasi Pemerintah untuk mengembangkan ekonomi berbasis inovasi yang sehat dan terus berkembang!” “Tim BIC mempunyai jiwa kepemimpinan yang berpikir jauh ke depan, sangat antusias dan secara disiplin akan membawa hasil yang sangat positif bagi masa depan Indonesia. Sukses selalu untuk BIC</p><hr>
                                        <p>Salam Inovasi!</p><br>
                                        <p>Dr. Hitendra Patel</p>
                                        <p>Managing Director of the IXL Center & chair of the innovation and growth program at the Hult International Business School</p>
                                        <p>Cambridge, MA., USA</p>
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/logos/logo-ixl.gif')}}">
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/tvg-krishnamurthy.png')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">TVG Krishnamurthy-Young Entrepreneur & Innovation Mentor - Bangalore, India.</a></h2>
                                        <p>Saya gembira mengetahui telah diluncurkannya prakarsa BIC oleh Kementerian Negara Riset dan Teknologi. Sebagai salah seorang yang terlibat sejak awal pengembangan konsep ini, saya secara pribadi senang karena gagasan ini telah mulai dilaksanakan.</p>
                                        <p>Sudah jelas bila seseorang menegaskan kembali pentingnya kemampuan sosialisasi, interpretasi, dan fasilitasi proses inovasi; serta pentingnya peran intermediator untuk mempertemukan para inovator dan dunia bisnis. Para ilmuwan dan pakar teknologi, khususnya mereka yang mau berwirausaha, umumnya tidak cukup memahami hakekat “kebutuhan” (needs), aturan main bisnis, dan tuntutan dari dunia industri. Mereka membutuhkan bantuan untuk memahami hal-hal tersebut.  Pada sisi lain, industri juga membutuhkan akses atas ilmu pengetahuan dan teknologi baru, yang kredibel dan berpotensi praktis, agar para pebisnis bisa memperbaharui teknologi mereka, agar bisa memenuhi tuntutan para pelanggan mereka lebih baik, dan terlebih penting lagi, bisa membuat bisnis mereka menjadi lebih menguntungkan.</p><hr>
                                        <p>Adalah tugas utama BIC untuk membawa kedua konstituen utama inovasi ini agar bisa bertemu, membangun keyakinan mereka akan kekuatan gagasan/ide, membuka akses pasar,  dan mensosialisasikan pentingnya inovasi.  Dengan bekal pengalaman praktis yang mereka bawa dari dunia bisnis, serta kemampuan mereka sebagai konsultan bisnis,  BIC dan timnya pasti akan berguna dalam mengartikulasikan konsep-konsep inovasi, menyampaikan “suara” para usahawan pada para ilmuwan dan pakar teknologi, serta membangun kredibilitas BIC.</p><br>
                                        <p>Selamat dan sukses !</p><br>
                                        <p>TVG Krishnamurthy</p>
                                        <p>Mentor Wirausahawan Muda & Guru Inovasi – Bangalore, India</p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <img class="img-responsive" alt="" src="{{url('public/jayakari/bic/regular/corporates/img/people/alihaliman.jpg')}}">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h2><a href="javascript:;">Alisjahbana Haliman, CEO - PT Haldin Pacific Semesta</a></h2>
                                        <p>Dengan sangat antusias Saya telah menjadi saksi dibentuknya Pusat Inovasi Bisnis - "Business Innovation Center (BIC)"</p>
                                        <p>Pimpinan di Kementrian Negara Riset & Teknologi telah merealisasikan ide tersebut, dan sangat meyakini perlunya prakarsa ini bagi Indonesia.</p>
                                        <p>Saya sangat setuju dengan hal ini!</p><hr>
                                        <p>Indonesia, negeri Kita yang diberkahi dengan sumberdayanya yang berlimpah, tertinggal dibandingkan negeri-negeri tetangga. Eksploitasi sumber dayanya pada banyak kasus tidak mengindahkan azas kelestarian dan sangat berlebihan, sedangkan di beberapa bidang, belum didayagunakan dengan optimal dan bahkan belum didaya gunakan sama sekali.</p>
                                        <p>Indonesia membutuhkan sangat banyak gagasan inovatif yang cemerlang dan eksekusi yang cerdik. Besar harapan Saya bahwa BIC yang telah terbentuk ini menjadi inisiatif baru yang menggerakkan hal ini. Misi BIC untuk menjembatani "gagasan dan realisasi" perlu mendapatkan acungan jempol dan pendekatan Pemerintah dari sisi bisnis yang bersahabat ke dunia bisnis pasti akan mendapatkan sambutan yang antusias.</p>
                                        <p>Kepada tim BIC, sekali lagi, selamat !! Perhitungkan Haldin sebagai salah satu pendukung BIC. Marilah kita mulai dengan gagasan-gagasan inovasi yang bisa mengubah kehidupan ribuan, bahkan jutaan rakyat Indonesia.</p>
                                        <p>Gagasan yang sederhana yang diperlukan masyarakat, yang praktis, dan yang segera memberikan manfaat. Menurut saya, di situlah BIC bisa berperan.</p><br>
                                        <p>Mari berinovasi !!!</p><br><br>
                                        <p>Alisjahbana Haliman</p>
                                        <p>CEO - PT Haldin Pacific Semesta</p>
                                    </div>
                                </div>
                                <hr class="blog-post-sep">
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