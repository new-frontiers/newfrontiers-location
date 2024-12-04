<?php

namespace NewFrontiers\Location;

/**
 * Marker Interface für Entities, die mit Koordinaten arbeiten können
 *
 * @package NewFrontiers\Location
 */
interface IHasLocation
{
    public function getGeoString(): string;

    public function setLat(float $lat): void;

    public function setLng(float $lng): void;
}
