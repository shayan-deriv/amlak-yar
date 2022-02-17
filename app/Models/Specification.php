<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $table = 'specifications';
    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'tenant',
        'tenant_mobile',
        'total_price',
        'unit_price',
        'deposit',
        'rent',
        'sold',
        'is_empty',
        'rented',
        'exchangeable',
        'flexible',
        'cabinet',
        'cabinet_material',
        'parket',
        'heating',
        'cooling',
        'telephone',
        'water',
        'electricity',
        'gas',
        'farangi_toilet',
        'ceramic_floor',
        'evacuation_date'
    ];

    // powers type
    const DOESNT_HAVE = 0;
    const MUTUAl = 1;
    const EXCLUSIVE = 2;

    public static function powerTypeList()
    {
        return [
            self::DOESNT_HAVE => 'ندارد',
            self::MUTUAl => 'اختصاصی',
            self::EXCLUSIVE => 'مشترک',
        ];
    }

    public function getWaterTypeStrAttribute()
    {
        $list = self::powerTypeList();
        return isset($list[$this->water])
            ? $list[$this->water]
            : $this->water;
    }

    public function getElectricityTypeStrAttribute()
    {
        $list = self::powerTypeList();
        return isset($list[$this->electricity])
            ? $list[$this->electricity]
            : $this->electricity;
    }

    public function getGasTypeStrAttribute()
    {
        $list = self::powerTypeList();
        return isset($list[$this->gas])
            ? $list[$this->gas]
            : $this->gas;
    }

    // heating type
    const NO_HEATING = 0;
    const RADIATOR = 1;
    const HEATER = 2;
    const CENTERAL = 3;
    const FIREPLACE = 4;

    public static function heatingTypeList()
    {
        return [
            self::NO_HEATING => 'ندارد',
            self::RADIATOR => 'شوفاژ',
            self::HEATER => 'بخاری',
            self::CENTERAL => 'موتورخانه',
            self::FIREPLACE => 'شومینه',
        ];
    }

    public function getHeaterTypeStrAttribute()
    {
        $list = self::heaterTypeList();
        return isset($list[$this->heating_type])
            ? $list[$this->heating_type]
            : $this->heating_type;
    }
}
