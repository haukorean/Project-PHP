<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class service_doctor extends Model
{
    public $timestamps = false;
    protected $guarded = []; 
    // protected $fillable = [
    //  'name','email','password', 'image_user','phone_user','birthday','story','type_user','status','token'
    // ];
    protected $primaryKey = 'id';
 	protected $table = 'service_doctor';

    public function company(): BelongsTo
    {
        return $this->belongsTo(company_doctor::class, 'id_company', 'id');
    }

    public function service_medical(): BelongsTo
    {
        return $this->belongsTo(service_medical::class, 'id_service', 'id');
    }

    public function schedule(): HasMany
    {
        return $this->hasMany(schedule::class, 'service', 'id');
    }
}
