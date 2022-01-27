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

    public static function typeList()
    {
        return [
            self::DOESNT_HAVE => 'ندارد',
            self::MUTUAl => 'اختصاصی',
            self::EXCLUSIVE => 'مشترک',
        ];
    }

    public function getWaterTypeStrAttribute()
    {
        $list = self::typeList();
        return isset($list[$this->water])
            ? $list[$this->water]
            : $this->water;
    }

    public function getElectricityTypeStrAttribute()
    {
        $list = self::typeList();
        return isset($list[$this->electricity])
            ? $list[$this->electricity]
            : $this->electricity;
    }

    public function getGasTypeStrAttribute()
    {
        $list = self::typeList();
        return isset($list[$this->gas])
            ? $list[$this->gas]
            : $this->gas;
    }
}
