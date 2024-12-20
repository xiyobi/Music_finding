<?php


const API_KEY = '7732157295:AAFN9JpPw0zd6He42idqnjihdy6rHjL3H-4';

$admin = "-1002450501336";
$adminuser = "5777562832";
function bot($method, $data = [])
{

    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        return ['ok' => false, 'error' => curl_error($ch)];
    } else {
        return json_decode($res, true);
    }
}

$update = json_decode(file_get_contents('php://input'), true);
var_dump($update);
if (!$update) {
    exit;
}

$message = $update['message'] ?? null;
if ($message) {
    $cid = $message['chat']['id'];
    $name = $message['chat']['first_name'] ?? 'Foydalanuvchi';
    $tx = $message['text'] ?? '';

    if ($tx === "/start") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Assalomu alaykum, <b>$name!</b> Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'HTML',
        ]);
    } elseif ($tx === "😔 Bekor qilish") {
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Bekor qilindi. Qandaydir savol bo'lsa, yozing.",
        ]);
    } else {
        if (file_exists('api.php')) {
            include 'api.php';
        } else {
            bot('sendMessage', [
                'chat_id' => $cid,
                'text' => "Xatolik: API moduli topilmadi.",
            ]);
        }
    }
}
