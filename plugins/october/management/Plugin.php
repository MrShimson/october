<?php namespace October\Management;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Management',
            'description' => 'No description provided yet...',
            'author' => 'October',
            'icon' => 'icon-user-group',
            'hint' => 'management'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            Components\Employees::class => 'employees',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'october.management.some_permission' => [
                'tab' => 'Management',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'management' => [
                'label' => 'Management',
                'url' => Backend::url('management/employees'),
                'icon' => 'icon-user-group',
                'permissions' => ['october.management.*'],
                'order' => 150,
            ],
        ];
    }
}
