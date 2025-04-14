<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'description',
        'user_id', // jika kamu simpan siapa yang melakukan aktivitas
    ];
}
