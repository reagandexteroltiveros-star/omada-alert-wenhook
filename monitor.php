<?php
include 'config.php';

function sendTelegramMessage($message) {
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
    $data = [
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    file_get_contents($url, false, $context);
}

// Simulate monitoring (replace with real OMADA API or SNMP polling)
$events = [
    'heartbeat_missed' => false,
    'provisioning' => false,
    'disconnected' => false,
    'connected' => true
];

foreach ($events as $event => $status) {
    if ($status) {
        $message = "OMADA ALERT: <b>$event</b> detected for WiFi: <b>".OMADA_WIFI_NAME."</b> at site: <b>".OMADA_SITE."</b>";
        file_put_contents(LOG_FILE, date('Y-m-d H:i:s') . " - $message\n", FILE_APPEND);
        sendTelegramMessage($message);
    }
}

echo "Monitoring complete.\n";
?>
