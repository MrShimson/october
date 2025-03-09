<?php namespace October\Management\Components;

use Cms\Classes\ComponentBase;
use October\Management\Models\Employee;

/**
 * Employees Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Employees extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Employees Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [];
    }

    public function get()
    {
        return Employee::orderBy('order', 'asc')->get();
    }
}
