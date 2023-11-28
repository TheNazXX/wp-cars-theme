<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit47eae758e9ea1002a27723fd3530a051
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Extendify\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Extendify\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit47eae758e9ea1002a27723fd3530a051::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit47eae758e9ea1002a27723fd3530a051::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
