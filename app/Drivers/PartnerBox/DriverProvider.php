<?php namespace App\Drivers\PartnerBox;

use App\Repositories\RequestRepository;
use Illuminate\Support\ServiceProvider;
use App\Drivers\PartnerBox\Services\PartnerBoxService;
use App\Drivers\PartnerBox\Services\PartnerBoxIntegrationService;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxService as IPartnerBoxService;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

class DriverProvider extends ServiceProvider
{
    public const DRIVER_NAME = 'partnerbox';

    public function register(): void
    {
        $accountId = config('systems.pap.account_id');
        $login = config('systems.pap.login');
        $password = config('systems.pap.password');
        $saleUrl = config('systems.pap.sale_url');
        $serverUrl = config('systems.pap.server_url');

        if (!empty($accountId) && !empty($login) && !empty($password) && !empty($saleUrl) && !empty($serverUrl)) {
            $this->app->register(EventProvider::class);

            $integrationService = (new PartnerBoxIntegrationService())
                ->setAccountId($accountId)
                ->setLogin($login)
                ->setPassword($password)
                ->setSaleUrl($saleUrl)
                ->setServerUrl($serverUrl);
            $this->app->instance(IPartnerBoxIntegrationService::class, $integrationService);

            $papService = (new PartnerBoxService($integrationService))
                ->setContactEventName(config('systems.pap.contact_event_name'))
                ->setContactEventProductId(config('systems.pap.contact_event_product_id'))
                ->setLeadEventName(config('systems.pap.lead_event_name'))
                ->setLeadEventProductId(config('systems.pap.lead_event_product_id'));
            $this->app->instance(IPartnerBoxService::class, $papService);

            RequestRepository::registerSystem(self::DRIVER_NAME);
        }
    }
}