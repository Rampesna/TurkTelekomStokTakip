<?php

session_start();

if(!$_SESSION['giris']==TRUE){
    header("Location:login.php");
}


include ("sistem/baglanti.php");
include ("sistem/fonksiyonlar.php");

$firma = $_POST["firma"];
$kargo = $_POST["kargo"];
$kod = $_POST["kod"];
$sehir = $_POST["sehir"];
$semt = $_POST["semt"];
$adres = $_POST["adres"];
$telno = $_POST["teleno"];
$mail = $_POST["mail"];


$tarih = date('Y/m/d');

$sorgu = $db->prepare("SELECT * FROM firmalar WHERE firma_id= :firma");
$sorgu->execute(array(

    "firma" => $firma

));
$sonuc = $sorgu->fetch();

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Türk Telekom</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="img/tlk.png" style="width:100%; max-width:300px;">
                        </td>
                        <td>
                            Gönderilen Kargo Firması : <b><?php echo $kargo; ?></b><br>
                            Anlaşmalı Kargo Kodu : <b><?php echo $kod; ?></b><br>
                            Gönderim Tarihi : <b><?php echo $tarih; ?></b><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <b>GÖNDERİCİ</b><br>
                            Türk Telekom Malatya İl Müdürlüğü<br>
                            Dabakhane Mh. Çarşı İçi Sk. No:2<br>
                            Battalgazi/MALATYA<br>
                            0(422) 555 12 28
                        </td>

                        <td>
                            <b></b><br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                        </td>
                    </tr>
                    <tr>
                        <td><center>
                            <b>ALICI</b><br>
                            <?php echo $sonuc["firma_adi"]; ?><br>
                            <?php echo $adres; ?><br>
                            <?php echo $semt.'/'.strtoupper($sehir); ?><br>
                            <?php echo $telno; ?><br>
                            <?php echo $mail; ?><br>
                            </center>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    $(document.ready(function(){
        window.print();
    }));
</script>
</body>
</html>
<?php
$logla = $db->prepare("INSERT INTO log SET
          islem_tipi = ?,
          islem_tarihi = ?,
          islem_ip = ?,
          islem_user = ?,
          islem_user_sicil = ?,
          detay = ?
          ");
date_default_timezone_set('Europe/Istanbul');
$ip = ip_bul();
$userx = ucwords($_SESSION['ad']) . ' ' . ucwords($_SESSION['soyad']);
$diger = 'Oluşturulan Fişin Gönderileceği Yer :' . $sonuc["firma_adi"];
$inserta = $logla->execute(array('Fiş Oluşturma', date('Y-m-d H-i-s'), $ip, $userx, $_SESSION['k_adi'], $diger));

?>
