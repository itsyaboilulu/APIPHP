<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
 
class BaseModel extends Model {

    public $timestamps = false;
    protected $fillable = [];
    protected $guarded = [];
}