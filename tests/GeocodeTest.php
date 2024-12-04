<?php

namespace NewFrontiers\tests;

use NewFrontiers\Location\Geocode;
use NewFrontiers\Location\IHasLocation;
use PHPUnit\Framework\TestCase;

class GeocodeTest extends TestCase
{
    public function testGeoCode()
    {
        $hasLocation = new class () implements IHasLocation
        {
            public function getGeoString(): string
            {
                return 'Berlin';
            }

            public function setLat(float $lat): void
            {
            }

            public function setLng(float $lng): void
            {
            }
        };

        $result = Geocode::geoCode($hasLocation, $status);
        $this->assertEquals('REQUEST_DENIED', $status); // Since Google Maps wants an API key
        $this->assertFalse($result);
    }
}
