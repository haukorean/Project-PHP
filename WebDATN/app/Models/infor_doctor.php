<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class infor_doctor extends Model
{
    public $timestamps = false;
    protected $guarded = []; 
    // protected $fillable = [
    //  'name','email','password', 'image_user','phone_user','birthday','story','type_user','status','token'
    // ];
    protected $primaryKey = 'id';
 	protected $table = 'infor_doctor';

 	// public function user(): BelongsTo
  //   {
  //       return $this->belongsTo(User::class);
  //   }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
