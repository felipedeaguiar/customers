<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        //hook de before create
        self::creating(function($model){
            if($model->validate($model)){
                if($model->beforeCreate($model)){
                    return true;
                }
                return false;
            }
            return false;
        });

        self::updating(function($model){
            if($model->validate($model)){
                if($model->beforeCreate($model)){
                    return true;
                }
                return false;
            }
            return false;
        });
        //hook de after creat
        self::created(function($model){
            //code
        });

    }

    private function validate($model)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($model->attributes, $model::$rules);
        if ($validator->fails()) {
            $model->errors = $validator->messages()->all();
            return false;
        }

        return true;
    }

    abstract protected function beforeCreate($model);
    abstract protected function afterCreate();
    abstract protected function toApi();
}
