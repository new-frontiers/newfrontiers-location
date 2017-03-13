<?php

namespace NewFrontiers\Location;

/**
 * Marker Interface für Entities, die mit Koordinaten arbeiten können
 *
 * @package NewFrontiers\Location
 */
interface IHasLocation
{
    public function getGeoString();

    public function setLat($lat);

    public function setLng($lng);
}
