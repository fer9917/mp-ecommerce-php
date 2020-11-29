<?php

error_reporting(1);
error_log(E_ALL);

include_once "mail.php";
$mail = new Mail();

echo "Notification success";

$message = "JSON: ".json_encode($_REQUEST)."<br>";
$message .= '<pre>'.print_r($_REQUEST, true).'</pre>';

file_put_contents('info.log', "\n".date("Y-m-d H:i:s")."\n", FILE_APPEND);
file_put_contents('info.log', "\n".json_encode($_REQUEST)."\n", FILE_APPEND);
file_put_contents('info.log', print_r($_REQUEST, true), FILE_APPEND);

$mail->send([
    'to' => 'fer@gestionmx.net',
    'tittle' => 'Notifications Mercado',
    'message' => $message,
]);