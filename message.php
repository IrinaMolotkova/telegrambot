<?php

$token = "8070678715:AAGHdZk1F4agWke2Zz03QxwYew787K0YxhM";
$apiURL = "https://api.telegram.org/bot$token/";

$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Логування на випадок помилок
file_put_contents("log.txt", $content . PHP_EOL, FILE_APPEND);

// Перевірка, чи є повідомлення
if (!isset($update["message"]["chat"]["id"])) {
    exit;
}

$chat_id = $update["message"]["chat"]["id"];
$text = isset($update["message"]["text"]) ? trim($update["message"]["text"]) : "";

// Команди
switch ($text) {
    case "/start":
        $reply = "Привіт! Я бот Geodezia. Надішліть /info або будь-яке інше повідомлення.";
        break;
    case "/info":
        $reply = "Цей бот створено для демонстрації BIM, LiDAR і геодезії.";
        break;
    default:
        $reply = "Ви написали: $text";
}

file_get_contents($apiURL . "sendMessage?chat_id=$chat_id&text=" . urlencode($reply));

?>
