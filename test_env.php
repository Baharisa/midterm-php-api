<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->load();

echo "DB_HOST: " . $_ENV['DB_HOST'] . "<br>";
echo "DB_PORT: " . $_ENV['DB_PORT'] . "<br>";
echo "DB_NAME: " . $_ENV['DB_NAME'] . "<br>";
echo "DB_USER: " . $_ENV['DB_USER'] . "<br>";
?>
