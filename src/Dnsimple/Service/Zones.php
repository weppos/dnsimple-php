<?php

namespace Dnsimple\Service;


use Dnsimple\Response;
use Dnsimple\Struct\Zone;
use Dnsimple\Struct\ZoneDistribution;
use Dnsimple\Struct\ZoneFile;
use Dnsimple\Struct\ZoneRecord;

/**
 * The Zones Service handles the zones endpoint of the DNSimple API.
 *
 * @see https://developer.dnsimple.com/v2/zones
 * @package Dnsimple\Service
 */
class Zones extends ClientService
{
    /**
     * Lists the zones in the account.
     *
     * @see https://developer.dnsimple.com/v2/zones/#listZones
     *
     * @param int $account The account id
     * @param array $options key/value options to sort and filter the results
     * @return Response The list of zones requested
     */
    public function listZones($account, array $options = [])
    {
        $response = $this->get("/{$account}/zones", $options);
        return new Response($response, Zone::class);
    }

    /**
     * Gets a zone from the account
     *
     * @see https://developer.dnsimple.com/v2/zones/#getZone
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @return Response The zone requested
     */
    public function getZone($account, $zone)
    {
        $response = $this->get("/{$account}/zones/{$zone}");
        return new Response($response, Zone::class);
    }

    /**
     * Gets a zone file from the account
     *
     * @see https://developer.dnsimple.com/v2/zones/#getZoneFile
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @return Response The zone file requested
     */
    public function getZoneFile($account, $zone)
    {
        $response = $this->get("/{$account}/zones/{$zone}/file");
        return new Response($response, ZoneFile::class);
    }

    /**
     * Checks if a zone change is fully distributed to all DNSimple name servers across the globe.
     *
     * WARNING: This feature can’t be tested in our Sandbox environment.
     *
     * @see https://developer.dnsimple.com/v2/zones/#checkZoneDistribution
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @return Response The zone distribution
     */
    public function checkZoneDistribution($account, $zone)
    {
        $response = $this->get("/{$account}/zones/{$zone}/distribution");
        return new Response($response, ZoneDistribution::class);
    }

    /**
     * Lists the zone records in the account
     *
     * @see https://developer.dnsimple.com/v2/zones/records/#listZoneRecords
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @param array $options key/value options to sort and filter the results
     * @return Response The list of zone records in the account
     */
    public function listRecords($account, $zone, array $options = [])
    {
        $response = $this->get("/{$account}/zones/{$zone}/records", $options);
        return new Response($response, ZoneRecord::class);
    }

    /**
     * Create a record for the zone in the account
     *
     * @see https://developer.dnsimple.com/v2/zones/records/#createZoneRecord
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @param array $attributes The zone record attributes. Refer to the documentation for the list of available fields.
     * @return Response The newly created zone record
     */
    public function createRecord($account, $zone, array $attributes = [])
    {
        $response = $this->post("/{$account}/zones/{$zone}/records", $attributes);
        return new Response($response, ZoneRecord::class);
    }

    /**
     * Gets a zone record from the account
     *
     * @see https://developer.dnsimple.com/v2/zones/records/#getZoneRecord
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @param int $record The record id
     * @return Response The zone record requested
     */
    public function getRecord($account, $zone, $record)
    {
        $response = $this->get("/{$account}/zones/{$zone}/records/{$record}");
        return new Response($response, ZoneRecord::class);
    }

    /**
     * Updates a zone record in the account.
     *
     * @see https://developer.dnsimple.com/v2/zones/records/#updateZoneRecord
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @param int $record The record id
     * @param array $attributes The zone record attributes. Refer to the documentation for the list of available fields.
     * @return Response The updated zone record
     */
    public function updateRecord($account, $zone, $record, array $attributes = [])
    {
        $response = $this->patch("/{$account}/zones/{$zone}/records/{$record}", $attributes);
        return new Response($response, ZoneRecord::class);
    }

    /**
     * Deletes a zone record from the account.
     *
     * WARNING: this cannot be undone.
     *
     * @see https://developer.dnsimple.com/v2/zones/records/#deleteZoneRecord
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @param int $record The record id
     * @return Response An empty response
     */
    public function deleteRecord($account, $zone, $record)
    {
        $response = $this->delete("/{$account}/zones/{$zone}/records/{$record}");
        return new Response($response);
    }

    /**
     * Checks if a zone record is fully distributed to all DNSimple name servers across the globe.
     *
     * WARNING: This feature can’t be tested in our Sandbox environment.
     *
     * @see https://developer.dnsimple.com/v2/zones/records/#checkZoneRecordDistribution
     *
     * @param int $account The account id
     * @param string $zone The zone name
     * @param int $record The record id
     * @return Response The zone record distribution
     */
    public function checkZoneRecordDistribution($account, $zone, $record) {
        $response = $this->get("/{$account}/zones/{$zone}/records/{$record}/distribution");
        return new Response($response, ZoneDistribution::class);
    }
}
