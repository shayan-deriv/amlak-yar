<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $table = 'specification';

    // powers type
    const DOESNT_HAVE = 1;
    const MUTUAl = 2;
    const EXCLUSIVE = 3;

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
    const RADIATOR = 1;
    const HEATER = 2;
    const CENTERAL = 3;
    const FIREPLACE = 4;

    public static function heatingTypeList()
    {
        return [
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
