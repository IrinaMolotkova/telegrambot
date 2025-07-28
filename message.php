<?php

$token = "8070678715:AAGHdZk1F4agWke2Zz03QxwYew787K0YxhM"; // <-- заміни на свій токен
$apiURL = "https://api.telegram.org/bot$token/";

// Отримати вхідні дані з Telegram
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (!isset($update["message"])) {
    exit;
}

$chat_id = $update["message"]["chat"]["id"];
$text = trim($update["message"]["text"]);

// Обробка команд
if ($text === "/start") {
    $reply = "Привіт! Я простий Telegram-бот на PHP.";
} else {
    $reply = "Ви написали: $text";
}

// Надіслати відповідь
file_get_contents($apiURL . "sendMessage?chat_id=$chat_id&text=" . urlencode($reply));

?>