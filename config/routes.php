<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use ADmad\I18n\Routing\Route\I18nRoute;

return static function (RouteBuilder $routes)
{
    $routes->setRouteClass(DashedRoute::class);

    $routes->prefix('founder', function (RouteBuilder $builder) {
        $builder->setRouteClass(I18nRoute::class);
        $builder->connect('/', ['controller' => 'SystemicPages', 'action' => 'dashboard']);
        $builder->connect('/i18n-messages/{domain}/{locale}', ['controller' => 'I18nMessages', 'action' => 'edit'])->setPass(['domain', 'locale']);
    
        $builder->fallbacks();
    });

    $routes->scope('/', function (RouteBuilder $builder) {
        $builder->setRouteClass(I18nRoute::class);
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'SystemicPages', 'action' => 'display'], ['_name' => 'home']);
        $builder->connect('/', ['controller' => 'SystemicPages', 'action' => 'display'], ['routeClass' => DashedRoute::class]);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });
};
