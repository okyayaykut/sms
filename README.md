# okyayaykut/sms

SMS API = İletiMerkezi
With our stable, high-capacity and fast SMS API you can easily integrate your applications in a short time and you can start today to send SMS from your own products.

SMS API = İletiMerkezi
Uygulamalarınıza kısa zamanda kolayca entegre edebileceğiniz, stabil çalışan, yüksek kapasiteli ve hızlı SMS API‘miz ile siz de kendi ürünlerinizden SMS gönderimi yapmaya bugün başlayabilirsiniz.

# Usage

<pre>

use ATTSMS;

$sms = new ATTSMS\SMS();
$sms::setConfig("username", "password", "smsheader");
$sms::sendSms("5325323232", "Sitenizin iletişim formu dolduruldu, ORNEK size mesaj gönderdi.?");

</pre>

# Composer Installation

<pre>
composer require "okyayaykut/sms":"dev-master"
</pre>