<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\Core\Configure;
use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 */
class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadHelper('FileStorage.Image');
        $this->addHelper('Frontend.Template');
        $this->loadHelper('TinyAuth.AuthUser');

        if ($this->request->getParam('prefix') == 'Admin') {
            $this->addHelper('Panel.Files');
            $this->addHelper('Panel.Panel');
            $this->addHelper('Panel.PhoneNumbers');
            $this->addHelper('Form', [
                'className' => 'Panel.Form',
                'errorClass' => 'form-control is-invalid'
            ]);

            $this->loadHelper('Published');
        } else {
            $this->addHelper('Paginator', ['templates' => 'Frontend.paginator-templates']);
            $this->addHelper('Form', [
                'className' => 'Frontend.Form',
                'errorClass' => 'form-control is-invalid'
            ]);
        }

        $this->addHelper('Authentication.Identity');
        $this->addHelper('MetaRender', [
            'fb.app_id' => Configure::read('Settings.App.facebook'),
            'og.site_name' => Configure::read('Settings.App.site_name')
        ]);

        $this->addHelper('I18n');
        $this->addHelper('Tags.Tag');
    }
}
