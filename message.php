<?php

$token = "8070678715:AAENUlMJmWV8dRz16x654SnM_zlDVMuAzCQ";
$apiURL = "https://api.telegram.org/bot$token/";

// Отримати вхідне повідомлення
$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Перевірка повідомлення
if (!isset($update["message"])) {
    exit;
// Автоматичне перенаправлення на HTML-фронтенд
header("Location: index_json1.html");
exit;
}


$chat_id = $update["message"]["chat"]["id"];
$text = trim($update["message"]["text"]);

// Визначення словника команд і відповідей
$responses = [
    "/start" => "Привіт! Я бот Geodezia. Надішліть /info або будь-яке інше повідомлення.",
    "/info" => "Я надаю інформацію про інтеграцію лазерного сканування з BIM.",
    "/bim" => "BIM — це Building Information Modeling.",
    "/liadar" => "LiDAR — технологія лазерного сканування поверхні.",
    "/переваги" => "Переваги: точність, ефективність, цифровізація.",
    "/етапи" => "1. Сканування, 2. Обробка, 3. Інтеграція з BIM.",
    "/контакт" => "Контакт: example@example.com"
];

// Вибір відповіді
$response = $responses[$text] ?? "Невідома команда. Спробуйте /info або /start.";

// Надіслати відповідь
file_get_contents($apiURL . "sendMessage?chat_id=$chat_id&text=" . urlencode($response));

?>
