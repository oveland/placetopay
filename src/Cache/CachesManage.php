<?php
/**
 * Created by PhpStorm.
 * User: Oscar
 * Date: 24/12/2016
 * Time: 7:52 PM
 */

namespace Oveland\Placetopay\Cache;

use DateTime;

/**
 * Manages Bank list cache
 * Class CachesManage
 * @package Oveland\Placetopay\Cache
 */
trait CachesManage
{
    protected static $file = __DIR__ . '\banks.json';

    /**
     * Checks if list cache is outdated (one day vigency) and Returns a Bank list or null
     * @return array|null
     */
    public static function loadCachedBanksList()
    {
        if (file_exists(static::$file)) {
            $file_data = json_decode(file_get_contents(static::$file), false);

            $lastUpdated = new DateTime($file_data->last_updated);
            $now = new DateTime(date('Y-m-d'));
            $daysOutdated = $lastUpdated->diff($now);

            if (intval($daysOutdated->format('%a')) > 0) {
                return null;
            }

            return $file_data->bank_list;
        }
        return null;
    }

    /**
     * Stores Bank list into cache and update it vigency
     * @param array $bankList
     * @return array|null
     */
    public static function cacheBanksList($bankList = null)
    {
        $file_data = [
            'last_updated' => date('Y-m-d'),
            'bank_list' => $bankList
        ];

        if (file_exists(static::$file)) {
            file_put_contents(static::$file, json_encode($file_data));
        } else {
            $file = fopen(static::$file, "w") or die("Unable to open file!");
            fwrite($file, json_encode($file_data));
            fclose($file);
        }

        return $bankList;
    }
}