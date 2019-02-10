<?php
require("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
$mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
$mail->SMTPSecure = 'tls'; // Normal bağlantı için tls , güvenli bağlantı için ssl yazın
$mail->Host = "mail.alanadi.com"; // Mail sunucusunun adresi (IP de olabilir)
$mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = "gonderen@alanadi.com"; // Gönderici adresinizin sunucudaki kullanıcı adı (e-posta adresiniz)
$mail->Password = "PAROLA"; // Mail adresimizin sifresi
$mail->SetFrom("gonderen@alanadi.com", "Adınız Soyadınız"); // Mail atıldığında gorulecek isim ve email (genelde yukarıdaki username kullanılır)
$mail->AddAddress("alici@alanadi.com"); // Mailin gönderileceği alıcı adres
$mail->Subject = "Mesaj Basligi"; // Email konu başlığı
$mail->Body = "Mesaj icerigi ve metni"; // Mailin içeriği
if(!$mail->Send()){
	echo "Email Gönderim Hatasi: ".$mail->ErrorInfo;
} else {
	echo "Email Gonderildi";
}
?>