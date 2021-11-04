<?php

declare(strict_types = 1);

namespace LocalgovDrupal\OsPlacesGeocoder\Model;

use Geocoder\Location;

/**
 * Adds UPRN and related property support to Location.
 *
 * New properties:
 * - UPRN
 * - Display name
 * - Flat number
 * - House name
 * - Organisation name.
 */
interface LocationUprnInterface extends Location {

  /**
   * Returns the Unique Property Reference Number.
   *
   * @see https://en.wikipedia.org/wiki/Unique_Property_Reference_Number
   */
  public function getUprn() :string;

  /**
   * Returns the full address in one line.
   */
  public function getDisplayName() :string;

  /**
   * Returns the flat number if any.
   */
  public function getFlat() :string;

  /**
   * Returns the house name if any.
   */
  public function getHouseName() :string;

  /**
   * Returns the organisation name if any.
   */
  public function getOrganisationName() :string;

}
