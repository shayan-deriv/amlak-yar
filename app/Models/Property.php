<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table = 'properties';

    protected $fillable = [
        'type',
        'landlord',
        'primary_mobile',
        'secondary_mobile',
        'phone',
        'house_phone',
        'address',
        'description',
        'registered_at',
        'deed',
        'usage',
        'for_rent',
        'for_sell',
        'for_pre_sell',
        'status',
        'parking',
        'storage',
        'elevator',
        'balcony',
        'yard',
        'share',
        'floor',
        'total_floor',
        'unit',
        'total_unit',
        'total_area',
        'built_area',
        'age',
        'total_rooms',
        'toilet_together',
        'for_colleague',
        'texture',
        'state_id',
        'city_id',
        'area_id',
        'complex_id',
    ];

    //type
    const VILLA = 1;
    const FIELD = 2;
    const APARTMENT = 3;
    const SHOP = 4;
    const LARGE_FIELD = 5;
    const OTHER_TYPES = 6;

    public static function typeList()
    {
        return [
            self::VILLA => 'ویلایی',
            self::FIELD => 'زمین',
            self::APARTMENT => 'آپارتمان',
            self::SHOP => 'مغازه',
            self::LARGE_FIELD => 'زمین بزرگ',
            self::OTHER_TYPES => 'سایر',
        ];
    }

    public function getTypeStrAttribute()
    {
        $list = self::typeList();
        return isset($list[$this->type])
            ? $list[$this->type]
            : $this->type;
    }

    //deed
    const SANAD = 1;
    const NASAGH = 2;
    const OTHER_DEEDS = 3;

    public static function deedList()
    {
        return [
            self::SANAD => 'سند',
            self::NASAGH => 'نسق',
            self::OTHER_DEEDS => 'سایر',
        ];
    }

    public function getDeedStrAttribute()
    {
        $list = self::deedList();
        return isset($list[$this->deed])
            ? $list[$this->deed]
            : $this->deed;
    }

    //usage
    const RESIDENTIAL = 1;
    const COMMERCIAL = 2;

    public static function usageList()
    {
        return [
            self::RESIDENTIAL => 'مسکونی',
            self::COMMERCIAL => 'تجاری',
        ];
    }

    public function getUsageStrAttribute()
    {
        $list = self::usageList();
        return isset($list[$this->usage])
            ? $list[$this->usage]
            : $this->usage;
    }

    //status
    const PUBLISHED = 1;
    const ARCHIVED = 2;

    public static function statusList()
    {
        return [
            self::PUBLISHED => 'منتشر شده',
            self::ARCHIVED => 'بایگانی شده',
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

    public function specification(){
        return $this->hasOne(Specification::class,'property_id','id');
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

    public function complex(){
        return $this->belongsTo(Complex::class,'complex_id','id');
    }
    public function attachments(){
        return $this->hasMany(Attachment::class, 'property_id', 'id');
    }
    
}
