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

        $builder->connect('/settings/key/{key}', ['controller' => 'Settings', 'action' => 'index'], ['_name' => 'settings'])->setPass(['key']);
        $builder->connect('/settings/edit', ['controller' => 'Settings', 'action' => 'edit'])->setExtensions(['json']);
    
        /**
         * ...Begin users
         */
        $builder->connect('/login', ['controller' => 'Users', 'action' => 'login'], ['_name' => 'login']);
        $builder->connect('/logout', ['controller' => 'Users', 'action' => 'logout'], ['_name' => 'logout']);
        /**
         * ...End users
         */

        $builder->fallbacks();
    });

    $routes->scope('/', function (RouteBuilder $builder) {
        $builder->setRouteClass(I18nRoute::class);

        /**
         * ...Begin dynamic pages
         */
        $builder->connect('/p/{slug}', ['controller' => 'Pages', 'action' => 'view'], ['_name' => 'page_view'])
            ->setPass(['slug']);
        /**
         * ...End dynamic pages
         */

        /**
         * ...Begin services
         */
        $builder->connect('/services/{slug}', ['controller' => 'Services', 'action' => 'view'], ['_name' => 'service_view'])
            ->setPass(['slug']);
        /**
         * ...End services
         */

        /**
         * ...Begin post categories
         */
        $builder->connect('/posts/c/{slug}', ['controller' => 'PostCategories', 'action' => 'view'], ['_name' => 'post_category_view'])
            ->setPass(['slug']);
        /**
         * ...End post categories
         */


        /**
         * ...Begin posts
         */
        $builder->connect('/posts/{slug}', ['controller' => 'Posts', 'action' => 'view'], ['_name' => 'post_view'])
            ->setPass(['slug']);
        /**
         * ...End posts
         */

        /**
         * ...Begin docs
         */
        $builder->connect('/docs/{slug}', ['controller' => 'Docs', 'action' => 'view'], ['_name' => 'doc_view'])
            ->setPass(['slug']);
        /**
         * ...End docs
         */

        /**
         * ...Begin faq pages
         */
        $builder->connect('/faq', ['controller' => 'Faqs', 'action' => 'index'], ['_name' => 'faq']);
        /**
         * ...End faq pages
         */
        $builder->connect('/', ['controller' => 'SystemicPages', 'action' => 'display'], ['_name' => 'home']);
        $builder->connect('/', ['controller' => 'SystemicPages', 'action' => 'display'], ['routeClass' => DashedRoute::class]);

        $builder->connect('/contacts', ['controller' => 'SystemicPages', 'action' => 'contacts'], ['_name' => 'contacts']);

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
