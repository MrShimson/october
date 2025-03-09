<?php namespace October\Management\Models;

use Model;

/**
 * Employee Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Employee extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'october_management_employees';

    /**
     * @var array rules for validation
     */
    public $rules = [
        'first_name' => ['required'],
        'last_name'  => ['required'],
        'position'   => ['required'],
        'order'      => ['required'],
    ];

    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;
//    protected $dateFormat = 'd-m-Y H:i:s';
    protected $fillable = ['first_name', 'last_name', 'avatar', 'position', 'order'];
}
