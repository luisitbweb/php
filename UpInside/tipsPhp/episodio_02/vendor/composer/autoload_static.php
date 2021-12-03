<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInited37a7e15ec43b56b429b7424ccf629d
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
            'CoffeeCode\\DataLayer\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'CoffeeCode\\DataLayer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/datalayer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInited37a7e15ec43b56b429b7424ccf629d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInited37a7e15ec43b56b429b7424ccf629d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}