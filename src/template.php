<?php
namespace FormSynergy;

/**
 * FormSynergy PHP Api template.
 *
 * This template requires the FormSynergy PHP Api.
 *
 * This script will download and localize all modules within a strategy.
 *
 * If the connection between the API and FS service is broken,
 * the javaScript client will re-rout simple interactions locally.
 *
 * Package repository: https://github.com/form-synergy/localize-fallback
 *
 * @author     Joseph G. Chamoun <formsynergy@gmail.com>
 * @copyright  2019 FormSynergy.com
 * @licence    https://github.com/form-synergy/template-essentials/blob/dev-master/LICENSE MIT
 * @package    web-essentials
 */

/**
 * This package requires the FormSynergy PHP API
 * Install via composer: composer require form-synergy/php-api
 */
require_once 'vendor/autoload.php';

/**
 * Enable session manager
 */
\FormSynergy\Session::enable();

/**
 * Import the FormSynergy class
 */
use \FormSynergy\Fs as FS;

/**
 *
 * Web Essentials Class
 *
 * @version 1.0
 */
class Localize_Fallback
{

    public static function Run($data)
    {

        /**
         * Load account, this action requires the profile id
         */
        $api = FS::Api()->Load($data['profileid']);

        /**
         * The domain name in question must be already
         * registered and verified with FormSynergy.
         *
         * For more details regarding domain registration
         * API documentation: https://formsynergy.com/documentation/websites/
         *
         * You can clone the verification package from Github
         * Github repository: https://github.com/form-synergy/domain-verification
         *
         * Alternatively it can be installed via composer
         * composer require form-synergy/domain-verification
         */

        /**
         * Localize modules.
         */
        $api->Download('strategy')
            ->Where([
                'modid' => $data['modid'],
            ])
            ->As('modules');

        foreach ($api->_modules() as $module) {
            FS::Store(
                /**
                 * Each module will be stored as a file,
                 * its important to name each file with it's moduleid
                 */
                $module['moduleid'],
                'html',
                /**
                 * Localized modules are base64 encoded.
                 * Simply decode the html data and store.
                 */
                base64_decode($module['html'])
            );
        }

        /**
         * To store resources and data
         **/
        FS::Store($api->_all());
    }
}
