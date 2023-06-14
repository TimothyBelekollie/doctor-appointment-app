<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable=[
        'doc_id',
        'category',
        'patients',
        'experience',
        'bio_data',
        'status',

    ];

 /**
         * Get the user that owns the Doctor
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
    
}
