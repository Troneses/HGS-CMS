<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     *
     * URL to your CodeIgniter root. Typically, this will be your base URL,
     * WITH a trailing slash.
     */
    public string $baseURL = 'http://hgs-cms.test:90/';

    /**
     * Allowed Hostnames in the Site URL other than the hostname in the baseURL.
     */
    public array $allowedHostnames = [];

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     *
     * Typically, this will be your `index.php` file. Set to empty string to remove it.
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     *
     * Determines which server global should be used to retrieve the URI string.
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Allowed URL Characters
     * --------------------------------------------------------------------------
     *
     * Only these are allowed: `a-z 0-9~%.:_-`
     */
    public string $permittedURIChars = 'a-z 0-9~%.:_-';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     *
     * The Locale for Russian language and location.
     */
    public string $defaultLocale = 'ru_RU';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     *
     * If true, automatically determine the language based on Accept-Language header.
     */
    public bool $negotiateLocale = false;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     *
     * List of supported locales in descending order of priority.
     */
    public array $supportedLocales = ['ru_RU'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     *
     * The default timezone for the application.
     */
    public string $appTimezone = 'Europe/Moscow';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     *
     * Character set used by default in various methods.
     */
    public string $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * Force Global Secure Requests
     * --------------------------------------------------------------------------
     *
     * If true, forces HTTPS. Not needed for local development.
     */
    public bool $forceGlobalSecureRequests = false;

    /**
     * --------------------------------------------------------------------------
     * Reverse Proxy IPs
     * --------------------------------------------------------------------------
     *
     * Whitelist proxy IPs if behind a reverse proxy. Not needed for Laragon.
     */
    public array $proxyIPs = [];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     *
     * Enables Content Security Policy. We'll configure it later if needed.
     */
    public bool $CSPEnabled = false;
}