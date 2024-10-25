<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class results_examination extends Model
{
    public $timestamps = false;
    protected $guarded = []; 
    // protected $fillable = [
    //  'name','email','password', 'image_user','phone_user','birthday','story','type_user','status','token'
    // ];
    protected $primaryKey = 'id';
 	protected $table = 'results_examination';

 	public function schedule(): BelongsTo
    {
        return $this->belongsTo(schedule::class, 'id_schedule', 'id');
    }

    public function re_schedule(): BelongsTo
    {
        return $this->belongsTo(schedule::class, 're_examination_schedule', 'id');
    }

	public function results_test(): HasMany 
    {
        return $this->hasMany(results_test::class, 'id_result', 'id');
    }
}
