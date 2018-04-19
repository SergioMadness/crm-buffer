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
        $this->app->register(EventProvider::class);

        $integrationService = (new PartnerBoxIntegrationService())
            ->setAccountId(config('systems.pap.account_id'))
            ->setLogin(config('systems.pap.login'))
            ->setPassword(config('systems.pap.password'))
            ->setSaleUrl(config('systems.pap.sale_url'))
            ->setServerUrl(config('systems.pap.server_url'));
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