<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(Cities::class, 'state_id', 'id');
    }
}
