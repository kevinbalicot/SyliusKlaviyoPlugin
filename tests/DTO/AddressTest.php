<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusKlaviyoPlugin\DTO;

use Setono\SyliusKlaviyoPlugin\DTO\Address;

/**
 * @covers \Setono\SyliusKlaviyoPlugin\DTO\Address
 */
final class AddressTest extends DTOTestCase
{
    protected function getDTO(): Address
    {
        $properties = new Address();
        $properties->firstName = 'John';
        $properties->lastName = 'Smith';
        $properties->address1 = '123 abc street';
        $properties->address2 = 'apt 1';
        $properties->zip = '02110';
        $properties->city = 'Boston';
        $properties->region = 'Massachusetts';
        $properties->regionCode = 'MA';
        $properties->country = 'United States';
        $properties->countryCode = 'US';
        $properties->phone = '5551234567';

        return $properties;
    }

    protected function getExpectedData(): array
    {
        return [
            'FirstName' => 'John',
            'LastName' => 'Smith',
            'Address1' => '123 abc street',
            'Address2' => 'apt 1',
            'Zip' => '02110',
            'City' => 'Boston',
            'Region' => 'Massachusetts',
            'RegionCode' => 'MA',
            'Country' => 'United States',
            'CountryCode' => 'US',
            'Phone' => '5551234567',
        ];
    }
}