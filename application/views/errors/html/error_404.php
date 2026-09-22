<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$heading = isset($heading) ? $heading : '404 Page Not Found';
$message_html = isset($message) ? $message : 'Halaman yang Anda cari tidak ditemukan.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f8fafc; color: #0f172a; }
        .wrap { max-width: 760px; margin: 64px auto; background: #fff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 28px; box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08); }
        h1 { margin: 0 0 12px; font-size: 32px; }
        p { margin: 0; line-height: 1.7; }
    </style>
</head>
<body>
    <div class="wrap">
        <h1><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8'); ?></h1>
        <p><?= $message_html; ?></p>
    </div>
</body>
</html>
