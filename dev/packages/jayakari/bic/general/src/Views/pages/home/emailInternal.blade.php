<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
    <!--[if gte mso 9]><xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <title>Pendaftaran Baru</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
    <meta name="format-detection" content="telephone=no">
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!--<![endif]-->
</head>
<?php $json = json_decode($data); ?>
<body class="em_body" style="margin:0px; padding:0px;" bgcolor="#efefef">
<table class="em_full_wrap" valign="top" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
    <tbody>
        <tr>
            <td>
                <h3 style="font-family:'Open Sans', Arial, sans-serif; font-size:26px; line-height:30px; color:#000000;">Data Peserta Baru:</h3>
                <table class="em_main_table" style="width:600px;" width="600" cellspacing="0" cellpadding="0" border="0" align="left" bgcolor="#0d1121">
                    <tbody>
                        <tr>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">Nama</td>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">{{$json->fullname}}</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">Jenis Kelamin</td>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">{{$json->jk}}</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">Telepon/HP</td>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">{{$json->telp}}</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">Email</td>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">{{$json->email}}</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">Perusahaan</td>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">{{$json->perusahaan}}</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">Jabatan</td>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">{{$json->jabatan}}</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">Alamat Perusahaan</td>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">{{$json->alamat}}</td>
                        </tr>
                        <tr>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">Kegiatan Yang Diikuti</td>
                            <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="left">{{$json->hadir}}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<div class="em_hide" style="white-space: nowrap; display: none; font-size:0px; line-height:0px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
</body></html>