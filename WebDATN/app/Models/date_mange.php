<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class date_mange extends Model
{
    public $timestamps = false;
    protected $guarded = []; 

    protected $primaryKey = 'id';
 	protected $table = 'date_mange';
}
