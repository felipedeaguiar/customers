<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 */
class Customer extends BaseModel
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name','email','phone'];

    /**
     * @var string[]
     */
    protected static $rules = [
        'name' => 'required|max:100',
        'email' => 'email|required|max:200',
        'phone' => 'required|celular_com_ddd'
    ];

    public function files()
    {
        return $this->belongsToMany(File::class, 'customer_files', 'id_customer', 'id_file');
    }

    /**
     * @param $model
     * @return bool
     */
    protected function beforeCreate($model)
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function afterCreate()
    {
        return true;
    }

    /**
     * @return array
     */
    protected function toApi()
    {
       return [];
    }
}
