<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    use HasFactory;

    protected $fillable = ['title','manager','primary_mobile','secondary_mobile','phone','address','total_block', 'total_unit', 'description','state_id','city_id','area_id','created_at','updated_at'];

    
    //status
    const PUBLISHED = 1;
    const ARCHIVED = 2;

    public static function statusList()
    {
        return [
            self::PUBLISHED => 'منتشر شده',
            self::ARCHIVED => 'آرشیو شده',
        ];
    }

    public function getStatusStrAttribute()
    {
        $list = self::dealList();
        return isset($list[$this->status])
            ? $list[$this->status]
            : $this->status;
    }

    public function scopePublished($query)
    {
        $query->where('status', self::PUBLISHED);
    }


    public function scopeArchived($query)
    {
        $query->where('status', self::ARCHIVED);
    }
}
