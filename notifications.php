<?php

include_once "mail.php";
$mail = new Mail();

echo "Notification success";

$message = "JSON: ".json_encode($_REQUEST)."<br>";
$message .= '<pre>'.print_r($_REQUEST, true).'</pre>';

$mail->send([
    'to' => 'fer@gestionmx.net',
    'tittle' => 'Notifications Mercado',
    'message' => $message,
]);