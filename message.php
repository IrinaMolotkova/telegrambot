<?php

$token = "7794114943:AAG28JcVeoTiVv1DZBia0ExxZqvNEu1q11g"; // 🔁 Заміни на свій токен бота
$apiURL = "https://api.telegram.org/bot$token/";

$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Логування в log.txt (для налагодження)
file_put_contents("log.txt", $content . PHP_EOL, FILE_APPEND);

// Перевірка наявності повідомлення
if (!isset($update["message"])) exit;

$chat_id = $update["message"]["chat"]["id"];
$text = strtolower(trim($update["message"]["text"] ?? ""));

// Визначення відповіді
$responses = [
    "/start" => "Привіт! Я бот Geodezia. Надішліть /info, /bim, /lidar, переваги, етапи, контакти  або будь-яке інше повідомлення.",
    "/info" => "Я надаю інформацію про інтеграцію лазерного сканування з BIM.",
    "/bim" => "BIM — це Building Information Modeling.",
    "/lidar" => "LiDAR — технологія лазерного сканування поверхні.",
    "переваги" => "Переваги: точність, ефективність, цифровізація.",
    "етапи" => "1. Сканування, 2. Обробка, 3. Інтеграція з BIM.",
    "контакти" => "Контакт: example@example.com"
];

$reply = $responses[$text] ?? "Вибач, я не розпізнаю цю команду. Спробуй /info, /bim, /lidar тощо.";

// Надсилання відповіді
file_get_contents($apiURL . "sendMessage?chat_id=$chat_id&text=" . urlencode($reply));
?>
