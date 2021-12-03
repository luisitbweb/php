<?php

require __DIR__ . '/../vendor/autoload.php';

use Faker\Factory;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use Source\Models\User;

$output = false;
if ($output) {
    $users = (new User())->find()->fetch(true);
    $csv = Writer::createFromString("");
    $csv->insertOne([
        "first_name",
        "last_name",
        "genre"
    ]);

    foreach ($users as $user) {
        $csv->insertOne([
            $user->first_name,
            $user->last_name,
            $user->genre
        ]);
    }
    $csv->output("users.csv");
}

$create = false;
if ($create) {
    $users = (new User())->find()->fetch(true);
    $stream = fopen(__DIR__ . "/../source/csvs/users.csv", "w");

    $csv = Write::createFromStream($stream);

    $csv->insertOne([
        "first_name",
        "last_name",
        "genre"
    ]);

    foreach ($users as $user) {
        $csv->insertOne([
            $user->first_name,
            $user->last_name,
            $user->genre,
        ]);
    }
    echo true;
}

$edit = true;
if($edit){
    $stream = fopen(__DIR__ . "/../source/csvs/users.csv", "a+");
    $csv = Writer::createFromStream($stream);
    $faker = Factory::create("pt_BR");
    $genre = ["male", "female"][rand(0, 1)];
    
    $csv->insertOne([
        $faker->first_name($genre),
        $faker->last_name($genre),
        strtoupper(substr($genre, 0, 1))
    ]);
}

$read = false;
if ($read) {
    $stream = fopen(__DIR__ . "/../source/csvs/users.csv", "r");
    $csv = Reader::createFromStream($steam);
    
    $csv->setDelimiter(",");
    $csv->setHeaderOffset(null);
    
    $stmt = (new Statement())->offset(1)->limit(2);
    $users = $stmt->process($csv);
    
    foreach ($users as $user){
        var_dump((Object)$user);
    }
    
}
