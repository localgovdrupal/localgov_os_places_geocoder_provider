# OS Places PHP Geocoder provider
Temporary home for our OS Places [PHP Geocoder](https://geocoder-php.org/) provider.

PHP Geocoder plugin for the [Ordnance Survey Places API](https://osdatahub.os.uk/docs/places/overview).  Looks up addresses based on the given street address or postcode.  Resultant addresses include Easting and Northing as location coordinates instead of latitute and longitude.  The values of Easting and Northing are in the [All numeric grid reference](https://en.wikipedia.org/wiki/Ordnance_Survey_National_Grid#All-numeric_grid_references) format.

This Geocoder requires an API key.

## Installation
```
$ composer require localgovdrupal/localgov_os_places_geocoder_provider
```

## Sample Usage
### Setup
```
$ composer require localgovdrupal/localgov_os_places_geocoder_provider php-http/guzzle6-adapter php-http/message
```

### Code
```
use Http\Adapter\Guzzle6\Client as Guzzle;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Provider\LocalgovOsPlacesGeocoder;

$http_client        = new Guzzle();
$generic_query_url  = 'https://api.os.uk/search/places/v1/find';
$postcode_query_url = 'https://api.os.uk/search/places/v1/postcode';
$our_api_key        = 'API-KEY-GOES-HERE';

$provider = new LocalgovOsPlacesGeocoder($http_client, $generic_query_url, $postcode_query_url, $our_api_key);
$result   = $provider->geocodeQuery(GeocodeQuery::create('BN1 1JE'));
$address  = $result->first()->toArray();
print_r($address);
```
