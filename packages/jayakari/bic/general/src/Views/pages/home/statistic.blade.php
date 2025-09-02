<?php
/**
 * Created by PhpStorm.
 * User: alienware
 * Date: 5/4/2018
 * Time: 7:24 PM
 */
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Statistic</title>
<link href="<?php echo env('APP_URL'); ?>/public/jayakari/bic/regular/pages/home/css/statistic.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table border="0" align="center" cellpadding="2" cellspacing="0">
<tr>
<td colspan="2"><h2>
<!--<a href="/i2/9000.php" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,');return false;"><span>LOGIN</span></a> |
<a href="/i2/9001.php" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,');return false;"><span>REGISTRASI</span></a>-->
<a href="/users" onClick="window.open(this.href,'targetWindow');return false;"><span>LOGIN</span></a> |
<a href="/users/general/registrasi" onclick="window.open(this.href,'targetWindow');return false;"><span>REGISTRASI</span></a>
</h2></td>
</tr>
<tr>
<td>USER</td>
<td align="right"><?php echo count($user); ?></td>
</tr>
<tr>
    <td width="100"><strong> STATUS </strong></td>
    <td width="25" align="center"><strong> JUMLAH </strong></td>
</tr>
<?php
        /*foreach($statistic as $item){
            echo '<tr>';
            echo '<td>'.$item['status'].'</td>';
            if ($item['jumlah'] == 0){
                echo '<td align="right">-</td>';
            }else{
                echo '<td align="right">'.$item['jumlah'].'</td>';
            }
            echo '</tr>';
        }*/

        //status baru
        echo '<tr>';
        echo '<td>'.$statistic[0]['status'].'</td>';
        if ($statistic[0]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[0]['jumlah'].'</td>';
        }
        echo '</tr>';

        //status batal
        echo '<tr>';
        echo '<td>'.$statistic[1]['status'].'</td>';
        if ($statistic[1]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[1]['jumlah'].'</td>';
        }
        echo '</tr>';

        //status revisi
        echo '<tr>';
        echo '<td>'.$statistic[3]['status'].'</td>';
        if ($statistic[3]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[3]['jumlah'].'</td>';
        }
        echo '</tr>';

        //status review
        echo '<tr>';
        echo '<td>'.$statistic[2]['status'].'</td>';
        if ($statistic[2]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[2]['jumlah'].'</td>';
        }
        echo '</tr>';

        //status inreview
        echo '<tr>';
        echo '<td>'.$statistic[4]['status'].'</td>';
        if ($statistic[4]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[4]['jumlah'].'</td>';
        }
        echo '</tr>';

        //status seleksi
        echo '<tr>';
        echo '<td>'.$statistic[5]['status'].'</td>';
        if ($statistic[5]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[5]['jumlah'].'</td>';
        }
        echo '</tr>';

        //status disimpan
        echo '<tr>';
        echo '<td>'.$statistic[6]['status'].'</td>';
        if ($statistic[6]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[6]['jumlah'].'</td>';
        }
        echo '</tr>';

        //status diterima
        echo '<tr>';
        echo '<td>'.$statistic[7]['status'].'</td>';
        if ($statistic[7]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[7]['jumlah'].'</td>';
        }
        echo '</tr>';

        //status discontinued
        echo '<tr>';
        echo '<td>'.$statistic[8]['status'].'</td>';
        if ($statistic[8]['jumlah'] == 0){
            echo '<td align="right">-</td>';
        }else{
            echo '<td align="right">'.$statistic[8]['jumlah'].'</td>';
        }
        echo '</tr>';

        //total proposal
        echo '<tr>';
        echo '<td><b>Total</b></td>';
        echo '<td align="right"><b>'.$total.'</b></td>';
        echo '</tr>';
?>
</table>
</body>
</html>