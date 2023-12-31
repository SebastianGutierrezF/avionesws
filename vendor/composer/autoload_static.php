<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb4999f3cacf77e50586039119334a462
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'models\\' => 7,
            'main\\' => 5,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'main\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb4999f3cacf77e50586039119334a462::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb4999f3cacf77e50586039119334a462::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb4999f3cacf77e50586039119334a462::$classMap;

        }, null, ClassLoader::class);
    }
}
