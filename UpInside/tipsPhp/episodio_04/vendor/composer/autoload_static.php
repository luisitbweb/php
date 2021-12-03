<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7ac9497cfac1589e04088f9d1b001c35
{
    public static $files = array (
        '44250500414850ba69a36c6a2cc330e6' => __DIR__ . '/../..' . '/source/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'C' => 
        array (
            'CoffeeCode\\Router\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7ac9497cfac1589e04088f9d1b001c35::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7ac9497cfac1589e04088f9d1b001c35::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}