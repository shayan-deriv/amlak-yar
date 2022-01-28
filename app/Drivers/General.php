<?php
if (!function_exists('env_put')) {
  function env_put($key, $value) {
    $path = app()->environmentFilePath();
    $escaped = preg_quote('=' . env($key), '/');
    file_put_contents($path, preg_replace("/^{$key}{$escaped}/m", "{$key}={$value}", file_get_contents($path)));
  }
}
if (!function_exists('eng_to_per')) {
  function eng_to_per($number) {
    return \App\Drivers\ConvertNumber::EnglishToPersian($number);
  }
}

if (!function_exists('currency_to_per')) {
  function currency_to_per($number) {
    return \App\Drivers\ConvertNumber::FixCurrencyInPersian($number);
  }
}