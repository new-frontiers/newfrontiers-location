<?php

namespace NewFrontiers\Location;

/**
 * Die Klasse stellt Methoden für den Umgang mit Geo-Koordinaten zur
 * Verfügung
 * @package NewFrontiers\Location
 */
class Geocode
{
    /**
     * Ermittelt zu einem übergebenen Entity die Koordinaten mithilfe der Google-Api
     * @param IHasLocation $location
     * @param $status
     * @return bool
     */
    public static function geoCode(IHasLocation $location, &$status): bool
    {
        if (strlen($location->getGeoString()) < 5) {
            $status = 'Geo-String zu kurz (min 5 Stellen)';
            return false;
        }

        $adresseUrl = urlencode($location->getGeoString());
        $geocodeURL = "https://maps.googleapis.com/maps/api/geocode/json?address=$adresseUrl&sensor=false";

        $ch = curl_init($geocodeURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ((int)$httpCode === 200) {
            $geocode = json_decode($result);
            $status = $geocode->status;

            if ($status !== 'OK') {
                return false;
            }

            $location->setLat($geocode->results[0]->geometry->location->lat);
            $location->setLng($geocode->results[0]->geometry->location->lng);

            return true;
        } else {
            $status = "HTTP_FAIL_$httpCode";
            return false;
        }
    }
}
