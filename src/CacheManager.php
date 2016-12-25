<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 7:52 PM
 */

namespace Oveland\Placetopay;

use DateTime;

/**
 * Class CacheManager
 * @package App
 */
class CacheManager
{
    protected static $file=__DIR__.'\banks.json';

    /**
     * @return array|null
     */
    public static function loadBanksList(){
        if(file_exists(static::$file)){
            $file_data = json_decode(file_get_contents(static::$file),false);

            $lastUpdated = new DateTime( $file_data->last_updated );
            $now = new DateTime(date('Y-m-d'));
            $daysOutdated = $lastUpdated->diff($now);

            if( intval($daysOutdated->format('%a')) > 0 ){
                return null;
            }

            return $file_data->bank_list;
        }
        return null;
    }

    /**
     * @param array $bankList
     * @return array|null
     */
    public static function cacheBanksList($bankList=null){
        if(file_exists(static::$file)) {
            $file_data = [
                'last_updated' => date('Y-m-d'),
                'bank_list' => $bankList
            ];
            file_put_contents(static::$file, json_encode($file_data));
        }
        return $bankList;
    }
}