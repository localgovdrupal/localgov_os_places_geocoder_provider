<?php

declare(strict_types = 1);

namespace LocalgovDrupal\OsPlacesGeocoder\Model;

/**
 * Ordnance Survey Location record interface.
 *
 * Adds Ordnance Survey Grid reference support to UPRN-based Location records.
 */
interface LocationOsPlacesInterface extends LocationUprnInterface {

  /**
   * Getter for the OS grid reference object.
   */
  public function getOsGridRef() :OsGridRef;

}
