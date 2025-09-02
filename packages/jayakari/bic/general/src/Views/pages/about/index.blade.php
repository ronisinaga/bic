@extends('jayakari.bic.general::layouts.default')
@section('content')
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="javascript:;">Pages</a></li>
                <li class="active">Contacts</li>
            </ul>
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12">
                    <h1>Kunjungi dan hubungi kami</h1>
                    <div class="content-page">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="map" class="gmaps margin-bottom-40" style="height:400px;">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6620266410932!2d106.87236050000007!3d-6.175979799999971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x5e40c82c9dbd5aa6!2sPQM+Consultant!5e0!3m2!1sen!2s!4v1437460732200" style="border: 0px none; pointer-events: none;" allowfullscreen="" width="1024" height="400" frameborder="0"></iframe>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <h2>Form Kontrak</h2>
                                <p>Apabila anda tertarik dengan kegiatan kami. Silahkan tinggalkan pesan kepada kami dengan mengisi form dibawah ini.</p>

                                <!-- BEGIN FORM-->
                                <form action="#" role="form">
                                    <div class="form-group">
                                        <label for="contacts-name">Nama</label>
                                        <input type="text" class="form-control" id="contacts-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="contacts-email">Email</label>
                                        <input type="email" class="form-control" id="contacts-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="contacts-message">Pesan</label>
                                        <textarea class="form-control" rows="5" id="contacts-message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Kirim</button>
                                    <button type="button" class="btn btn-default">Batal</button>
                                </form>
                                <!-- END FORM-->
                            </div>

                            <div class="col-md-3 col-sm-3 sidebar2">
                                <h2>Alamat Kami</h2>
                                <address class="margin-bottom-40">
                                    PQM Building, Ground Floor,<br>
                                    Cempaka Putih Tengah 17C no. 7a, Jakarta 10510, Indonesia.<br>
                                    Phone: (+62) 21 4288 5430<br>
                                    Fax: (0) 21 2147 2655<br>
                                    Mobile: (+62) 8118 242 558 (BIC-JKT)<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(+62) 8118 242 462 (BIC-INA)<br>
                                </address>
                                <address>
                                    <strong>Email</strong><br>
                                    <a href="mailto:info@bic.web.id">info@bic.web.id</a><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
@stop