<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class service_medical extends Model
{
    public $timestamps = false;
    protected $guarded = []; 
    // protected $fillable = [
    //  'name','email','password', 'image_user','phone_user','birthday','story','type_user','status','token'
    // ];
    protected $primaryKey = 'id';
 	protected $table = 'service_medical';

 	public function service_doctor(): HasMany
    {
        return $this->hasMany(service_doctor::class, 'id_service', 'id');
    }

}
