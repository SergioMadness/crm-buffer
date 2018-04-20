<?php namespace App\Drivers\PartnerBox\Services;

use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxIntegrationService;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxService as IPartnerBoxService;

/**
 * Service to work with Post Affiliate Network (http://partnerbox.org/)
 * @package App\Drivers\PartnerBox\Services
 */
class PartnerBoxService implements IPartnerBoxService
{
    /**
     * @var PartnerBoxIntegrationService
     */
    private $integrationService;

    /**
     * @var array
     */
    private $errorMessages = [];

    /**
     * @var string
     */
    private $leadEventName;

    /**
     * @var string
     */
    private $leadEventProductId;

    /**
     * @var string
     */
    private $contactEventName;

    /**
     * @var string
     */
    private $contactEventProductId;

    /**
     * @var bool
     */
    private $lastRequestSuccessful = false;

    public function __construct(PartnerBoxIntegrationService $integrationService)
    {
        $this->setIntegrationService($integrationService);
    }

    /**
     * Send lead to CRM
     *
     * @param array $data
     *
     * @return bool
     */
    public function sendLead(array $data): bool
    {
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            $this->setMessages($validator->errors()->all());

            return $this->lastRequestSuccessful = false;
        }

        $contact = $data['email'] ?? $data['phone'];

        $this->setMessages([$this->getIntegrationService()
            ->setVisitorId($data['visitorId'])
            ->sendEvent(
                $this->getLeadEventName(),
                $this->getLeadEventProductId(),
                'lead_' . time(),
                $contact,
                $data['name'] . ' | ' . $contact
            )]);

        return $this->lastRequestSuccessful = true;
    }

    /**
     * Send contact to CRM
     *
     * @param array $data
     *
     * @return bool
     */
    public function sendContact(array $data): bool
    {
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            $this->setMessages($validator->errors()->all());

            return $this->lastRequestSuccessful = false;
        }

        $contact = $data['email'] ?? $data['phone'];

        $this->setMessages([$this->getIntegrationService()
            ->setVisitorId($data['visitorId'])
            ->sendEvent(
                $this->getContactEventName(),
                $this->getContactEventProductId(),
                'contact_' . time(),
                $contact,
                $data['name'] . ' | ' . $contact
            )]);

        return $this->lastRequestSuccessful = true;
    }

    /**
     * Get response messages/errors
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->errorMessages;
    }

    /**
     * Check last request was successful
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->lastRequestSuccessful;
    }

    /**
     * Create validator for data
     *
     * @param array $data
     *
     * @return Validator
     */
    protected function getValidator(array $data): Validator
    {
        /** @var Validator $validator */
        $validator = ValidatorFacade::make($data, [
            'visitorId' => 'required',
            'email'     => 'required_without:phone|email',
            'phone'     => 'required_without:email',
        ]);

        return $validator;
    }

    //<editor-fold desc="Getters and setters" defaultstate="collapsed">

    /**
     * Get integration service
     *
     * @return PartnerBoxIntegrationService
     */
    public function getIntegrationService(): PartnerBoxIntegrationService
    {
        return $this->integrationService;
    }

    /**
     * Set integration service
     *
     * @param PartnerBoxIntegrationService $integrationService
     *
     * @return $this
     */
    public function setIntegrationService(PartnerBoxIntegrationService $integrationService): self
    {
        $this->integrationService = $integrationService;

        return $this;
    }

    /**
     * Set response messages
     *
     * @param array $messages
     *
     * @return PartnerBoxService
     */
    public function setMessages(array $messages): self
    {
        $this->errorMessages = $messages;

        return $this;
    }

    /**
     * Get lead event name
     *
     * @return string
     */
    public function getLeadEventName(): string
    {
        return $this->leadEventName;
    }

    /**
     * Set lead event name
     *
     * @param string $leadEventName
     *
     * @return $this
     */
    public function setLeadEventName(string $leadEventName): self
    {
        $this->leadEventName = $leadEventName;

        return $this;
    }

    /**
     * Get contact event name
     *
     * @return string
     */
    public function getContactEventName(): string
    {
        return $this->contactEventName;
    }

    /**
     * Set contact event name
     *
     * @param string $contactEventName
     *
     * @return $this
     */
    public function setContactEventName(string $contactEventName): self
    {
        $this->contactEventName = $contactEventName;

        return $this;
    }

    /**
     * Get lead event product id
     *
     * @return string
     */
    public function getLeadEventProductId(): string
    {
        return $this->leadEventProductId;
    }

    /**
     * Set lead event id
     *
     * @param string $leadEventProductId
     *
     * @return $this
     */
    public function setLeadEventProductId(string $leadEventProductId): self
    {
        $this->leadEventProductId = $leadEventProductId;

        return $this;
    }

    /**
     * Get product id for contact event
     *
     * @return string
     */
    public function getContactEventProductId(): string
    {
        return $this->contactEventProductId;
    }

    /**
     * Set contact event product id
     *
     * @param string $contactEventProductId
     *
     * @return $this
     */
    public function setContactEventProductId(string $contactEventProductId): self
    {
        $this->contactEventProductId = $contactEventProductId;

        return $this;
    }
    //</editor-fold>
}