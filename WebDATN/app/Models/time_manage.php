<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time_manage extends Model
{
    public $timestamps = false;
    protected $guarded = []; 

    protected $primaryKey = 'id';
 	protected $table = 'time_manage';
}
