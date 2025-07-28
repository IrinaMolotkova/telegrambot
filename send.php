<?php
$token = "ТВОЇЙ_ТОКЕН";
$chat_id = "ID_ЧАТУ"; // тимчасово — свій ID або групи

$data = json_decode(file_get_contents("php://input"), true);
$text = $data["message"] ?? "";

$url = "https://api.telegram.org/bot$token/sendMessage";
$params = [
    'chat_id' => $chat_id,
    'text' => $text
];

$response = file_get_contents($url . "?" . http_build_query($params));
echo json_encode(["ok" => true, "message_sent" => $text]);
