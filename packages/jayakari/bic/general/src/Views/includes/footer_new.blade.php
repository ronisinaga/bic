<!-- All modals added here for the demo. You would of course just have one, dynamically created -->
<div class="md-modal md-effect-13" id="modal-1">
    <div class="md-content">
        <h3>Layanan Untuk Umum</h3>
        <div>
            <ul>
                <li><b>1. </b>Kunjungan ke perusahaan-perusahaan.</li>
                <li><b>2. </b>Menganalisa dan mengoptimalakan rangkaian nilai proses kerja, perusahaan, pemasok, membantu mencarikan mitra kerjasama yang tepat dari kalangan ipetek.</li>
                <li><b>3. </b>Mengadakan gathering dan seminar dalam hal menjembatani ABG.</li>
                <li><b>4. </b>Memberikan secara terus-menerus informasi tentang perkembangan teknologi baru dan proses produksi.</li>
                <li><b>5. </b>Mengidentifikasikan risiko dan mengenali potensinya.</li>
                <li><b>6. </b>Memberikan pendampingan pada perusahaan-perusahaan yang inovatif.</li>
                <li><b>7. </b>Membuat database yang menampung informasi mengenai proses-proses inovasi.</li>
                <li><b>8. </b>Mengatur pertukaran para pakar yang dibutuhkan dengan keahlian tertentu.</li>
                <li><b>9. </b>Mengatur pertemuan para pakar untuk dapat menjalin kerjasama.</li>
            </ul>
            <button class="md-close">Tutup halaman!</button>
        </div>
    </div>
</div>
<div class="md-modal md-effect-1" id="modal-2">
    <div class="md-content">
        <h3>Layanan Untuk Swasta/Bisnis</h3>
        <div>
            <ul>
                <li><b>1. </b>Mempermudah proses pencarian Informasi mengenai Inovasi.</li>
                <li><b>2. </b>Mempermudah Pengembangan bisnis dengan penerapan Inovasi.</li>
                <li><b>3. </b>Memperluas hubungan dengan pemerintah dan akademisi.</li>
                <li><b>4. </b>Menghubungkan para pelaku bisnis dalm hal mendapatkan insentif yang diberikan oleh pemerintah.</li>
                <li><b>5. </b>Memberikan Informasi mengenai kajian-kajian teknologi yang sedang berlangsung.</li>
                <li><b>6. </b>Menyusun agenda dan pengaturan pertemuan dengan pusat-pusat kajian teknologi.</li>
            </ul>
            <button class="md-close">Tutup halaman!</button>
        </div>
    </div>


</div>
<div class="md-modal md-effect-1" id="modal-3">
    <div class="md-content">
        <h3>Layanan Untuk Akademisi/Teknisi</h3>
        <div>
            <ul>
                <li><b>1. </b>Membantu mengembangkan produk Inovasi yang sudah ada untuk di komersilkan.</li>
                <li><b>2. </b>Membantu dalam hal finansial yang akan dibantu oleh pihak swasta/pelaku bisnis.</li>
                <li><b>3. </b>Memberikan jaringan/network pelaku bisnis dalam hal kerjasama terhadap pihak akademisi.</li>
                <li><b>4. </b>Memberikan pengetahuan mengenai pasar dan trend yang ada di pasar.</li>
                <li><b>5. </b>Membantu menghubungkan kepada pihak dunia usaha dalam hal kerjasama.</li>
                <li><b>6. </b>Membantu melakukan analisi terhadap pihak dunia usaha yang memiliki interest untuk berinvestasi terhadap riset yang dilakukan.</li>
            </ul>
            <button class="md-close">Tutup halaman!</button>
        </div>
    </div>
</div>
<div class="md-modal md-effect-1" id="modal-4">
    <div class="md-content">
        <h3>Layanan Untuk Pemerintah</h3>
        <div>
            <ul>
                <li><b>1. </b>Memperat hubungan pemerintah dengan pihak swasta/bisnis dan akademisi/teknisi.</li>
                <li><b>2. </b>Memberikan dukungan terhadap program-program pemerintah dalam hal inovasi.</li>
                <li><b>3. </b>Memajukan pengembangan teknologi inovasi dalam skala nasional.</li>
                <li><b>4. </b>Memfasilitasi pemerintah dengan pihak swasta/bisnis dan akademisi/teknisi.</li>
                <li><b>5. </b>Memfasilitasi program incentif yang dibuat oleh pemerintah.</li>
            </ul>
            <button class="md-close">Tutup halaman!</button>
        </div>
    </div>
</div>
<footer style="background-color: #ffffff;text-align: left">
    <div id="last">
        <div class="row" style="background-color: #52caf5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" style="height: 10px;">
                        <p></p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row" style="background-color: #52caf5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12" style="color: #ffffff;text-align: center">
                        <img src="<?php echo env('APP_URL')?>/public/jayakari/bic/regular/img/logo_bic.png" id="logo" name="logo"><br><br>
                        <h5>Business Innovation Center</h5>
                        <h5>PQM Building, Ground Floor</h5>
                        <h5>Cempaka Putih Tengah, 17C No. 7A</h5>
                        <h5>Jakarta - 10510, Indonesia</h5>
                        <h5>(+62) 21 4288 5430</h5>
                        <h5>(+62) 8118 242 558</h5>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div id="googleMap" style="width:100%;height:400px;"></div>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEsXAiJX7kv3X1LzN2niYfRw-K1iM4cCg"></script>
                        <script>
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(-6.1759675,106.8729285,17),
                                title: 'Business Innovation Center (BIC)',

                                label: {

                                    text: 'Business Innovation Center (BIC)',

                                    color: '#ea4335',

                                    fontSize: '18px'

                                },
                                animation: google.maps.Animation.BOUNCE,
                                url: 'https://www.google.com/maps/place/Business+Innovation+Center+(BIC)/@-6.1759675,106.8729285,15z/data=!4m5!3m4!1s0x0:0x638ea197281417!8m2!3d-6.1759675!4d106.8729285',
                                mapTypeId:google.maps.MapTypeId.ROADMAP
                            });
                            function myMap() {
                                var mapProp= {
                                    center:new google.maps.LatLng(-6.1759675,106.8729285,17),
                                    zoom:17,
                                };
                                var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                                marker.setMap(map);
                            }
                            google.maps.event.addDomListener(window, 'load', myMap);
                            google.maps.event.addListener(marker, 'click', function() {window.location.href = marker.url;});
                        </script>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12" style="margin-top: 80px;">
                        <div style="text-align: center">
                            <h4 style="color: #ffffff">Email: info@bic.web.id</h4>
                            <h4 style="color: #ffffff">We're on social networks</h4>
                            <h4 style="color: #ffffff"><i class="fa fa-whatsapp"></i> +62 8118 242 558</h4>
                            <a href="https://twitter.com/InfoBIC"><h4 style="color: #ffffff"><i class="fa fa-twitter"></i> @infoBIC</h4></a>
                            <a href="https://www.facebook.com/JawaraInovasi/"><h4 style="color: #ffffff"><i class="fa fa-facebook"></i> JAWARA INOVASI</h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row" style="background-color: #52caf5;text-align: center">
            <div class="col-md-12 col-lg-12">
                <div class="wow shake" data-wow-delay="0.4s">
                    <div class="page-scroll marginbot-30" style="z-index:10">
                        <a href="#home" id="totop" class="btn btn-circle">
                            <i class="fa fa-angle-double-up animated"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<div class="md-overlay"></div>
<!--[if lt IE 9]>
<script src="<?php echo env('APP_URL'); ?>/assets/respond.min.js"></script>
<![endif]-->
<script src="<?php echo env('APP_URL'); ?>/assets/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo env('APP_URL'); ?>/assets/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo env('APP_URL'); ?>/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
<script src="<?php echo env('APP_URL'); ?>/assets/owl.carousel/owl.carousel.js" type="text/javascript"></script><!-- slider for products -->
<script src="<?php echo env('APP_URL'); ?>/assets/owl.carousel/owl-tube.min.js" type="text/javascript"></script>
<script src="<?php echo env('APP_URL'); ?>/assets/magnific-popup/scripts/jquery.magnific-popup.js" type="text/javascript"></script>
<script src="<?php echo env('APP_URL'); ?>/assets/jquery.easing/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo env('APP_URL'); ?>/assets/wow/js/wow.min.js" type="text/javascript"></script>
<script src="<?php echo env('APP_URL'); ?>/assets/jquery.scrollTo/js/jquery.scrollTo.js" type="text/javascript"></script>
<!--<script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/js/custom.js" type="text/javascript"></script>-->
<script src="<?php echo env('APP_URL'); ?>/assets/classie/js/classie.js" type="text/javascript"></script>
<script src="<?php echo env('APP_URL'); ?>/assets/modalEffect/js/modalEffects.js" type="text/javascript"></script>
<script src="<?php echo env('APP_URL'); ?>/assets/cssParser/js/cssParser.js" type="text/javascript"></script>
<!--<script src="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/js/main.js" type="text/javascript"></script>-->
@yield('footer_page');