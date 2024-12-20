<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://shazam-api6.p.rapidapi.com/shazam/recognize/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/x-www-form-urlencoded",
        "x-rapidapi-host: shazam-api6.p.rapidapi.com",
        "x-rapidapi-key: 63d2877444msh6cfc9acf6f36c94p18609cjsn43ff9cc94a00"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $result = json_decode($response, true);
    $url = $result['result'][0]['url'];
}
$cid = $_POST['chat_id'] ?? $_GET['chat_id'] ?? null;

bot('sendVideo', [
    'chat_id' => $cid,
    'video' => $url,
    'caption' => "Botimizga obuna bo'ling!\n\n<a href='https://t.me/SaveMusicfristBot'>Obuna bo'lish</a>",
    'parse_mode' => 'HTML',
    'reply_markup' => json_encode([
        'inline_keyboard' => [
            [
                [
                    "text" => "➕ Obuna bo'lish", "url" => "https://t.me/SaveMusicfristBot"
                ],
            ],
        ]
    ]),
]);