# OS Places PHP Geocoder provider
Home for our OS Places [PHP Geocoder](https://geocoder-php.org/) provider.

PHP Geocoder plugin for the [Ordnance Survey Places API](https://osdatahub.os.uk/docs/places/overview).  Looks up addresses based on the given street address or postcode.  Both the DPA and LPI address datasets are queried for addresses.  Resultant addresses include both Easting and Northing as well as latitude and longitude as location coordinates.  The values of Easting and Northing are in the [All numeric grid reference](https://en.wikipedia.org/wiki/Ordnance_Survey_National_Grid#All-numeric_grid_references) format.  ONS (Office for National Statistics) Ward codes are also included.

Search results can be filtered based on the following criterion:
- For a single local authority based on its [Local custodian code](https://www.ordnancesurvey.co.uk/documents/product-support/support/addressbase-local-custodian-codes.zip).
- [Classification codes](https://docs.os.uk/os-downloads/products/addresses-and-names-portfolio/addressbase-fundamentals/classification-scheme).

This Geocoder requires an API key.

## Installation
```
$ composer require localgovdrupal/localgov_os_places_geocoder_provider
```

## Sample Usage
### Setup
```
$ composer require localgovdrupal/localgov_os_places_geocoder_provider:1.x-dev php-http/guzzle6-adapter php-http/message
```

### Code
```
use Http\Adapter\Guzzle6\Client as Guzzle;
use Geocoder\Query\GeocodeQuery;
use LocalgovDrupal\OsPlacesGeocoder\Provider\OsPlacesGeocoder;

$http_client        = new Guzzle();
$generic_query_url  = 'https://api.os.uk/search/places/v1/find';
$postcode_query_url = 'https://api.os.uk/search/places/v1/postcode';
$our_api_key        = 'API-KEY-GOES-HERE';

$provider = new OsPlacesGeocoder($http_client, $generic_query_url, $postcode_query_url, $our_api_key);
$result   = $provider->geocodeQuery(GeocodeQuery::create('BN1 1JE'));
$address  = $result->first()->toArray();
print_r($address);

// Restrict lookup to a single local authority.
$query    = GeocodeQuery::create('Brighton pier')->withData('local_custodian_code', 1445);
$result   = $provider->geocodeQuery($query);
$address  = $result->first()->toArray();
print_r($address);

// Restrict the above lookup to flats only.
$query    = $query->withData('address_classification_codes', ['RD06']);
$result   = $provider->geocodeQuery($query);
$address  = $result->first()->toArray();
print_r($address);
```
