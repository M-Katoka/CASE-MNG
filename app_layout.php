<?php

function appEscape($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function appToken(): string
{
    if (empty($_SESSION['app_csrf_token'])) {
        $_SESSION['app_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['app_csrf_token'];
}

function appValidToken($token): bool
{
    return is_string($token)
        && isset($_SESSION['app_csrf_token'])
        && hash_equals($_SESSION['app_csrf_token'], $token);
}

function appStart(string $title, bool $useExistingHeader = false): void
{
    ?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="light">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= appEscape($title) ?> | NGO Portal</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet">

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
            rel="stylesheet">

        <link href="assets/style.css" rel="stylesheet">
        <link href="assets/professional.css" rel="stylesheet">

        <script src="assets/theme.js"></script>
    </head>
    <body class="ngo-ui">
    <?php
    if ($useExistingHeader) {
        include __DIR__ . '/header.php';
    } else {
        include __DIR__ . '/app_navigation.php';
    }
    ?>
    <main class="container py-4 fade-in">
    <?php
}

function appEnd(): void
{
    ?>
    </main>

    <footer class="container pb-4">
        <div class="border-top pt-3 d-flex flex-wrap justify-content-between gap-2 small text-body-secondary">
            <span>NGO Case Management Information System</span>
            <span>Authorized staff access</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}

function appAlert(string $message, string $type = 'success'): void
{
    $allowedTypes = ['success', 'danger', 'warning', 'info'];

    if (!in_array($type, $allowedTypes, true)) {
        $type = 'info';
    }
    ?>
    <div
        class="alert alert-<?= $type ?> alert-dismissible fade show"
        role="<?= $type === 'danger' ? 'alert' : 'status' ?>"
    >
        <?= appEscape($message) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>
    </div>
    <?php
}