<?php namespace October\Management\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use October\Management\Models\Employee;

/**
 * Employees Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Employees extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['october.management.employees'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.Management', 'management', 'employees');
    }

    public function index()
    {
        $this->makeLists();
    }

    public function create()
    {
        $employee = new Employee();
        $this->initForm($employee);
    }

    public function update($id)
    {
        $employee = Employee::find($id);
        $this->initForm($employee);
    }
}
