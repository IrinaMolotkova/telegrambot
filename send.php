<?php
$token = "8070678715:AAGHdZk1F4agWke2Zz03QxwYew787K0YxhM";
$chat_id = "Geodezia"; // тимчасово — свій ID або групи

$data = json_decode(file_get_contents("php://input"), true);
$text = $data["message"] ?? "";

$url = "https://api.telegram.org/bot$token/sendMessage";
$params = [
    'chat_id' => $chat_id,
    'text' => $text
];

$response = file_get_contents($url . "?" . http_build_query($params));
echo json_encode(["ok" => true, "message_sent" => $text]);
