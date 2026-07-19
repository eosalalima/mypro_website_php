<?php
function clean($value) { return trim(strip_tags($value ?? '')); }
$name = clean($_POST['name'] ?? '');
$email = filter_var(clean($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$message = clean($_POST['message'] ?? '');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $name === '' || !$email || $message === '') {
    http_response_code(422);
    echo 'Please complete the inquiry form with a valid email address.';
    exit;
}
$logDir = __DIR__ . '/storage';
if (!is_dir($logDir)) { mkdir($logDir, 0775, true); }
$entry = json_encode(['date' => gmdate('c'), 'name' => $name, 'email' => $email, 'message' => $message], JSON_UNESCAPED_SLASHES) . PHP_EOL;
file_put_contents($logDir . '/inquiries.log', $entry, FILE_APPEND | LOCK_EX);
header('Location: /?sent=1#contact', true, 303);
