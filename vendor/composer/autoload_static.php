<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdbb30cbeaa4aaf4741d29da26af6e0af
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'v' => 
        array (
            'view\\' => 5,
        ),
        'm' => 
        array (
            'model\\' => 6,
        ),
        'c' => 
        array (
            'controller\\' => 11,
        ),
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'view\\' => 
        array (
            0 => __DIR__ . '/../..' . '/view',
        ),
        'model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/model',
        ),
        'controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controller',
        ),
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdbb30cbeaa4aaf4741d29da26af6e0af::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdbb30cbeaa4aaf4741d29da26af6e0af::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitdbb30cbeaa4aaf4741d29da26af6e0af::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitdbb30cbeaa4aaf4741d29da26af6e0af::$classMap;

        }, null, ClassLoader::class);
    }
}
