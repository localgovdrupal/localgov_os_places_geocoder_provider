<?php

declare(strict_types = 1);

namespace LocalgovDrupal\OsPlacesGeocoder\Model;

/**
 * Ordnance Survey places address record.
 *
 * Includes Ordnance Survey Grid reference in addition to everything a
 * UPRN-based address record would have.
 */
final class OsPlacesAddress extends UprnAddress implements LocationOsPlacesInterface {

  /**
   * All numeric Ordnance Survey National Grid reference.
   *
   * @var OsGridRef
   *
   * @see https://en.wikipedia.org/wiki/Ordnance_Survey_National_Grid#All-numeric_grid_references
   */
  protected $osGridRef;

  /**
   * Getter for the OS grid reference object.
   */
  public function getOsGridRef() :OsGridRef {

    return $this->osGridRef;
  }

  /**
   * Creates an Address from an array.
   *
   * @return static
   */
  public static function createFromArray(array $data) {

    $self = parent::createFromArray($data);

    if (isset($data['easting']) && isset($data['northing'])) {
      $self->osGridRef = new OsGridRef((int) $data['easting'], (int) $data['northing']);
    }

    return $self;
  }

  /**
   * Appends uprn and display value to Location array.
   *
   * {@inheritdoc}
   */
  public function toArray() :array {

    $array = parent::toArray();

    if ($this->osGridRef) {
      $array['easting']  = $this->osGridRef->getEasting();
      $array['northing'] = $this->osGridRef->getNorthing();
    }

    return $array;
  }

}
