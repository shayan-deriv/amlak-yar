<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'url',
    ];

    public function property(){
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
