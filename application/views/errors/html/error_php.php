<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$severity_label = isset($severity) ? $severity : 'PHP Error';
$message_text = isset($message) ? $message : 'Terjadi kesalahan pada server.';
$filepath_text = isset($filepath) ? $filepath : '';
$line_number = isset($line) ? (int) $line : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $severity_label; ?> - Error</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }
        .wrap {
            max-width: 820px;
            margin: 48px auto;
            padding: 24px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        }
        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        h1 {
            margin: 18px 0 12px;
            font-size: 28px;
        }
        .meta {
            margin-top: 18px;
            padding: 14px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            line-height: 1.7;
        }
        code {
            background: #eef2ff;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <span class="badge"><?= htmlspecialchars($severity_label, ENT_QUOTES, 'UTF-8'); ?></span>
        <h1>Server Error</h1>
        <p><?= nl2br(htmlspecialchars($message_text, ENT_QUOTES, 'UTF-8')); ?></p>

        <div class="meta">
            <div><strong>File:</strong> <code><?= htmlspecialchars($filepath_text, ENT_QUOTES, 'UTF-8'); ?></code></div>
            <div><strong>Line:</strong> <code><?= $line_number; ?></code></div>
        </div>
    </div>
</body>
</html>
