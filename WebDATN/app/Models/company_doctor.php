<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class company_doctor extends Model
{
   public $timestamps = false;
    protected $guarded = []; 
    // protected $fillable = [
    //  'name','email','password', 'image_user','phone_user','birthday','story','type_user','status','token'
    // ];
    protected $primaryKey = 'id';
 	protected $table = 'company_doctor';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function specialist(): HasOne
    {
        return $this->hasOne(specialist_doctor::class, 'id', 'id_specialist');
    }

   public function service_doctor(): HasMany
    {
        return $this->hasMany(service_doctor::class, 'id_company', 'id');
    }

}
