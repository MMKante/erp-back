<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9ac018f7e0c2a4a78aad0bea15bf48b0
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mmk\\ErBack\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mmk\\ErBack\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9ac018f7e0c2a4a78aad0bea15bf48b0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9ac018f7e0c2a4a78aad0bea15bf48b0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9ac018f7e0c2a4a78aad0bea15bf48b0::$classMap;

        }, null, ClassLoader::class);
    }
}
