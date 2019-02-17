<?php

namespace App\Infrastructure\Service;

use Eseath\SxGeo\SxGeo;
use App\Domain\Core\GeoService;

class AppGeoService implements GeoService
{
    /**
     * @var SxGeo
     */
    private $sxGeo;

    /**
     * @return \stdClass
     */
    public function geoInfoCountryByIp($ip)
    {
        if (!$this->sxGeo) {
            $this->init();
        }

        return $this->sxGeo->getCountry($ip);
    }

    /**
     * @param $ip
     * @return \stdClass
     */
    public function countryNameByIp($ip)
    {
        if (!$this->sxGeo) {
            $this->init();
        }
        try {
            return $this->sxGeo->get($ip)["country"]["name_ru"];
        } catch (\Exception $exception) {
           return $this->geoInfoCountryByIp($ip);
        }
    }

    private function init()
    {
        $this->sxGeo = new SxGeo(config("sxgeo.localPath"));
    }
}
