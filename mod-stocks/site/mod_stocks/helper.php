<?php
/**
 * @package     Stocks
 * @subpackage  mod_stocks
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_stocks
 *
 * @package     Joomla.Site
 * @subpackage  mod_stock
 */

class ModStocksHelper
{
    static protected $_cache;

    public static function getCache()
    {
        if (!self::$_cache)
        {
            $cache = JCacheController::getInstance();
            $cache->setCaching(true);
            $cache->setLifeTime(5);

            self::$_cache = $cache;
        }

        return self::$_cache;
    }

    public static function getStocks()
    {
        $cache   = self::getCache();
        $cacheid = 'mod-stocks';

        if (!$cache->get($cacheid))
        {
            $url = 'http://finance.yahoo.com/webservice/v1/symbols/TRS/quote?format=json&view=detail';

            $httpinfo = self::curl($url, $data);

            if ($httpinfo == 200)
            {
                $data = json_decode($data);

                $data              = $data->list->resources[0]->resource->fields;
                $data->price       = number_format($data->price, 2);
                $data->change      = ($data->change < 0) ? number_format($data->change, 2) : '+' . number_format($data->change, 2);
                $data->chg_percent = ($data->chg_percent < 0) ? number_format($data->chg_percent, 2) . '%' : '+' . number_format($data->chg_percent, 2) . '%';
                $data->utctime     = date('g:i A T', strtotime($data->utctime)) . ' on ' . date('F j, Y', strtotime($data->utctime));

                $cache->store($data, $cacheid);
            }
        }

        return $cache->get($cacheid);
    }

    public static function curl($url, &$output)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Linux; Android 6.0.1; MotoG3 Build/MPI24.107-55) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.81 Mobile Safari/537.36");
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        $output = curl_exec($ch);

        $httpinfo = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $httpinfo;
    }
}
