<?php

require '../vendor/autoload.php';

use Monolog\Handler\BrowserConsoleHandler;
use \Monolog\Handler\TelegramBotHandler;
use \Monolog\Formatter\LineFormatter;
use \Monolog\Handler\SendGridHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$logger = new Logger("web");
$logger->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
$logger->pushHandler(new StreamHandler("assets/log/log.txt", Logger::WARNING));
$logger->pushHandler(new SendGridHandler(
                SENDGRID["user"],
                SENDGRID["passwd"],
                "luiscarlosss2018@outlook.com",
                "d.luiscarlos92@gmail.com",
                "Erro em serverweb.local mensagem teste..." . date("d/m/Y H:i:s"),
                Logger::CRITICAL
));

$logger->pushProcessor(function ($record) {
    $record["extra"]["server"] = $_SERVER;
    return $record;
});

$tele_key = "954533559:AAHFteES0mlgqpBPlHgFvDyPU9eDjT1cvgM";
$tele_channel = "@MonologPHP_Bot";
$tele_handler = new TelegramBotHandler($tele_key, $tele_channel, Logger::EMERGENCY);
$tele_handler->setFormatter(new LineFormatter("%level_name%: %message%"));
$logger->pushHandler($tele_handler);

// DEBUG
$logger->debug("Olá Mundo!", ["logger" => true]);
$logger->info("Olá Mundo!", ["logger" => true]);
$logger->notice("Olá Mundo!", ["logger" => true]);

// FILE
$logger->warning("Olá Mundo!", ["logger" => true]);
$logger->error("Olá Mundo!", ["logger" => true]);

// EMAIL
$logger->critical("Olá Mundo!", ["logger" => true]);
$logger->alert("Olá Mundo!", ["logger" => true]);

$logger->emergency("Essa mensagem foi enviada pelo Monolog!");
