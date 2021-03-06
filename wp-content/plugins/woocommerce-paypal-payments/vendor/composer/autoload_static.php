<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf02c5bd9f6eb9b15933b2b810aafffd5
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WooCommerce\\WooCommerce\\Logging\\' => 32,
            'WooCommerce\\PayPalCommerce\\Webhooks\\' => 36,
            'WooCommerce\\PayPalCommerce\\WcGateway\\' => 37,
            'WooCommerce\\PayPalCommerce\\Vaulting\\' => 36,
            'WooCommerce\\PayPalCommerce\\Subscription\\' => 40,
            'WooCommerce\\PayPalCommerce\\StatusReport\\' => 40,
            'WooCommerce\\PayPalCommerce\\Session\\' => 35,
            'WooCommerce\\PayPalCommerce\\Onboarding\\' => 38,
            'WooCommerce\\PayPalCommerce\\Compat\\' => 34,
            'WooCommerce\\PayPalCommerce\\Button\\' => 34,
            'WooCommerce\\PayPalCommerce\\ApiClient\\' => 37,
            'WooCommerce\\PayPalCommerce\\AdminNotices\\' => 40,
            'WooCommerce\\PayPalCommerce\\' => 27,
            'Wikimedia\\Composer\\' => 19,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Container\\' => 14,
        ),
        'I' => 
        array (
            'Interop\\Container\\' => 18,
        ),
        'D' => 
        array (
            'Dhii\\Modular\\Module\\' => 20,
            'Dhii\\Container\\' => 15,
            'Dhii\\Collection\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WooCommerce\\WooCommerce\\Logging\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/woocommerce-logging/src',
        ),
        'WooCommerce\\PayPalCommerce\\Webhooks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-webhooks/src',
        ),
        'WooCommerce\\PayPalCommerce\\WcGateway\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-wc-gateway/src',
        ),
        'WooCommerce\\PayPalCommerce\\Vaulting\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-vaulting/src',
        ),
        'WooCommerce\\PayPalCommerce\\Subscription\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-subscription/src',
        ),
        'WooCommerce\\PayPalCommerce\\StatusReport\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-status-report/src',
        ),
        'WooCommerce\\PayPalCommerce\\Session\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-session/src',
        ),
        'WooCommerce\\PayPalCommerce\\Onboarding\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-onboarding/src',
        ),
        'WooCommerce\\PayPalCommerce\\Compat\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-compat/src',
        ),
        'WooCommerce\\PayPalCommerce\\Button\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-button/src',
        ),
        'WooCommerce\\PayPalCommerce\\ApiClient\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-api-client/src',
        ),
        'WooCommerce\\PayPalCommerce\\AdminNotices\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules/ppcp-admin-notices/src',
        ),
        'WooCommerce\\PayPalCommerce\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Wikimedia\\Composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/wikimedia/composer-merge-plugin/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Interop\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/container-interop/service-provider/src',
        ),
        'Dhii\\Modular\\Module\\' => 
        array (
            0 => __DIR__ . '/..' . '/dhii/module-interface/src',
        ),
        'Dhii\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/dhii/containers/src',
        ),
        'Dhii\\Collection\\' => 
        array (
            0 => __DIR__ . '/..' . '/dhii/collections-interface/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf02c5bd9f6eb9b15933b2b810aafffd5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf02c5bd9f6eb9b15933b2b810aafffd5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
