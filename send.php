<?php

$token = "8070678715:AAENUlMJmWV8dRz16x654SnM_zlDVMuAzCQ";
$apiURL = "https://api.telegram.org/bot$token/";
$chat_id = "ВАШ_CHAT_ID"; // або зберігай його динамічно

$data = json_decode(file_get_contents("php://input"), true);
$text = trim($data["message"] ?? "");

// Відповіді з JSON
$responses = json_decode(file_get_contents("responses.json"), true);
$responseText = $responses[$text] ?? "Невідома команда. Спробуйте /info або /bim.";

// Inline-кнопки
$inlineKeyboard = [
    [["text" => "/info", "callback_data" => "/info"]],
    [["text" => "/bim", "callback_data" => "/bim"]],
    [["text" => "/liadar", "callback_data" => "/liadar"]],
    [["text" => "/переваги", "callback_data" => "/переваги"]],
    [["text" => "/етапи", "callback_data" => "/етапи"]],
    [["text" => "/контакт", "callback_data" => "/контакт"]],
];

$replyMarkup = json_encode(["inline_keyboard" => $inlineKeyboard]);

// Надсилання повідомлення Telegram
$response = file_get_contents($apiURL . "sendMessage?" . http_build_query([
    "chat_id" => $chat_id,
    "text" => $responseText,
    "reply_markup" => $replyMarkup
]));

// Повернення відповіді на фронт
echo json_encode(["status" => "ok", "text" => $responseText]);
?>
