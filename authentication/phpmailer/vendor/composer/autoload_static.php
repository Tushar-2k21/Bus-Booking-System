<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfe081494a96cfc3b55649146218a8ed5
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfe081494a96cfc3b55649146218a8ed5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfe081494a96cfc3b55649146218a8ed5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfe081494a96cfc3b55649146218a8ed5::$classMap;

        }, null, ClassLoader::class);
    }
}
