<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'version' => '1.0',

    'database' => [
        'adapter' => 'Postgresql',
        'host' => 'blockchain.videabiz.com',
        'port' => 5432,
        'username' => 'bc_subscriber_admin',
        'password' => 'Videa@2019',
        'dbname' => 'bc_subscriber',
        'charset' => 'utf8',
    ],
//    'database' => [
//        'adapter' => 'Postgresql',
//        'host' => 'localhost',
//        'port' => 5432,
//        'username' => 'postgres',
//        'password' => '1',
//        'dbname' => 'subscriber',
//        'charset' => 'utf8',
//    ],
    'subcriberConfig' => [
        'defaultDomain' => 'http://blockchain.videabiz.com'
    ],
    'application' => [
        'appDir' => APP_PATH . '/',
        'modelsDir' => APP_PATH . '/common/models/',
        'migrationsDir' => APP_PATH . '/migrations/',
        'cacheDir' => BASE_PATH . '/cache/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri' => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ],

    /**
     * if true, then we print a new line at the end of each CLI execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    'printNewLine' => true
]);
