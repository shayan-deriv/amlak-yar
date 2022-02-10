<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colleague extends Model
{
    use HasFactory;

    protected $fillable = ['title','owner','primary_mobile','secondary_mobile','phone','address','city_id', 'state_id', 'area_id','created_at','updated_at'];

    
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

    public function state(){
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function area(){
        return $this->belongsTo(Area::class,'area_id','id');
    }
}
