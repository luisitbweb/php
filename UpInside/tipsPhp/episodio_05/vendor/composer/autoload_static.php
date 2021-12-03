<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd9e60074389b1756360d526c1d415762
{
    public static $files = array (
        '44250500414850ba69a36c6a2cc330e6' => __DIR__ . '/../..' . '/source/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
        'C' => 
        array (
            'CoffeeCode\\Paginator\\' => 21,
            'CoffeeCode\\DataLayer\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
        'CoffeeCode\\Paginator\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/paginator/src',
        ),
        'CoffeeCode\\DataLayer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/datalayer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd9e60074389b1756360d526c1d415762::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd9e60074389b1756360d526c1d415762::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}