<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require '../vendor/autoload.php';

$option = new Options();

$dompdf = new Dompdf(["enable_remote" => true]);
$dompdf->loadHtml("<h1>Olá Mundo!</h1><p>Esse é o meu primero PDF!</p>");
//$dompdf->setPaper("A4", "landscape");

//ob_start();
//require '../contentes/users.php';
//$dompdf->loadHtml(ob_get_clean());

ob_start();
require '../contentes/profile.php';
$dompdf->loadHtml(ob_get_clean());

$dompdf->setPaper("A4");

$dompdf->render();
$dompdf->stream("file.pdf", ["Attachment" => false]);