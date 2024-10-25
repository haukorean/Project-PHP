<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class handbook extends Model
{
    public $timestamps = false;
    protected $guarded = []; 

    protected $primaryKey = 'id';
 	protected $table = 'handbook';

 	public function user_auth(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_doctor', 'id');
    }
}
