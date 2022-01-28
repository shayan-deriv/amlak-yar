<?php
namespace App\Drivers;
/**
 * Number Conversion Library
 * this library is used to convert persian digits to english and vice versa
 *
 * @author  simti
 * @license GNU/LGPL
 * @version 1.0.0
 */
class ConvertNumber {
  const PERSIAN_DIGITS = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
  const ARABIC_DIGITS = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
  const ENGLISH_DIGITS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

  public static function PersianToEnglish($number) {
    $number = str_replace(ConvertNumber::PERSIAN_DIGITS, ConvertNumber::ENGLISH_DIGITS, $number);
    $number = str_replace(ConvertNumber::ARABIC_DIGITS, ConvertNumber::ENGLISH_DIGITS, $number);
    return $number;
  }

  public static function EnglishToPersian($number) {
    return str_replace(ConvertNumber::ENGLISH_DIGITS, ConvertNumber::PERSIAN_DIGITS, $number);
  }
  public static function FixCurrency($number) {
    return preg_replace("/\B(?=(\d{3})+(?!\d))/i", ",", $number);
  }
  public static function FixCurrencyInPersian($number) {
    return ConvertNumber::EnglishToPersian(preg_replace("/\B(?=(\d{3})+(?!\d))/i", ",", $number));
  }

}