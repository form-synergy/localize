# Localize Fallback

This script will download and localize all modules within a strategy. If the connection between the API and FS service is broken, the javaScript client will re-rout simple interactions locally.

## Install using composer
```bash
composer require form-synergy/custom-module
```

## Include the library
```php
require '/vendor/autoload.php';
```

##  Enable session management
```PHP
\FormSynergy\Session::enable();
```

## Import the Form Synergy class
```PHP
use \FormSynergy\Fs as FS;
```

You will need to retrieve your credentials in the Form Synergy console.

Console Access: https://formsynergy.com/console/

- $profileid = '';
- $apikey = '';
- $apisecret = '';

If you are a reseller
- $resellerid = '';




## Configuration
```PHP
FS::Config([
    'version' => 'v1',
    'protocol' => 'https',
    'endpoint' => 'api.formsynergy.com',
    'apikey' => $apikey,
    'secretkey' => $secretkey,
     //'resellerid' => $resellerid,  If you are a reseller
    'max_auth_count' => 15,
]);
```

## local storage
Enable local storage to store downloads and responses. 
```PHP
FS::Storage( '/', 'local-storage' );
```

## Load account
Load and start managing an account.
```PHP
$api = FS::Api()->Load($profileid);
```

## Run script
Update modid, the unique identifier of the strategy.
```PHP
\FormSynergy\Localize_Fallback::Run([
    'modid' => '',
])
```