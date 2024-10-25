<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class schedule extends Model
{
    public $timestamps = false;
    protected $guarded = []; 
    // protected $fillable = [
    //  'name','email','password', 'image_user','phone_user','birthday','story','type_user','status','token'
    // ];
    protected $primaryKey = 'id';
 	protected $table = 'schedule';

    public function user_patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function user_doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_doctor', 'id');
    }

    public function service_doctor(): BelongsTo
    {
        return $this->belongsTo(service_doctor::class, 'service', 'id');
    }


    public function result_examination(): HasOne
    {
        return $this->hasOne(result_examination::class, 'id_schedule', 'id');
    }


}
