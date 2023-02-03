<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 */
class File extends BaseModel
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['uri'];

    /**
     * @var string[]
     */
    protected static $rules = [
        'uri' => 'required|max:500'
    ];

    /**
     * @param $model
     * @return void
     */
    protected function beforeCreate($model)
    {
        return true;
    }

    /**
     * @return void
     */
    protected function afterCreate()
    {
        return true;
    }

    /**
     * @return void
     */
    protected function toApi()
    {
        return [];
    }
}
