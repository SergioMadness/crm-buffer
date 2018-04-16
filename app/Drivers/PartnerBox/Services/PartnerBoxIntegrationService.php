<?php namespace App\Drivers\PartnerBox\Services;

use App\Drivers\PartnerBox\Exceptions\WrongCredentialsException;
use App\Drivers\PartnerBox\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

/**
 * Service for integration with PartnerBox
 * @package App\Drivers\PartnerBox\Services
 */
class PartnerBoxIntegrationService implements IPartnerBoxIntegrationService
{
    /**
     * @var \Gpf_Api_Session
     */
    private $session;

    /**
     * @var string
     */
    private $serverUrl;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string|int
     */
    private $visitorId;

    /**
     * @var \Pap_Api_ClickTracker
     */
    private $clickTracker;

    /**
     * @var string|int
     */
    private $accountId;

    /**
     * Create session
     *
     * @return \Gpf_Api_Session
     * @throws WrongCredentialsException
     */
    protected function createSession(): \Gpf_Api_Session
    {
        if ($this->session === null) {
            $this->session = new \Gpf_Api_Session($this->getServerUrl());
            if (!$this->session->login($this->getLogin(), $this->getPassword())) {
                throw new WrongCredentialsException();
            }
        }

        return $this->session;
    }

    /**
     * Create click tracker
     *
     * @return \Pap_Api_ClickTracker
     * @throws WrongCredentialsException
     */
    protected function createClickTracker(): \Pap_Api_ClickTracker
    {
        if ($this->clickTracker === null) {
            $this->clickTracker = new \Pap_Api_ClickTracker($this->createSession());
            $this->clickTracker->setAccountId($this->getAccountId());
            if (!empty($visitorId = $this->getVisitorId())) {
                $this->clickTracker->setVisitorId($visitorId);
            }
        }

        return $this->clickTracker;
    }

    /**
     * Track visitor
     *
     * @return bool
     */
    public function track(): bool
    {
        ob_start();

        try {
            $this->createClickTracker()->track();
            $this->clickTracker->saveCookies();
        } catch (\Exception $e) {
            Log::error("PAP Track" . $e->getMessage());
        }

        if ($devNull) {
            $devNull = ob_get_contents();
            ob_end_clean();
        }


    }

    /**
     * Send event
     *
     * @param string     $eventName
     * @param string|int $productId
     * @param string|int $orderId
     * @param string     $data1
     * @param string     $data2
     *
     * @return bool
     */
    public function sendEvent(string $eventName, $productId, $orderId, $data1, $data2 = null): bool
    {
        // TODO: Implement sendEvent() method.
    }

    /**
     * Set status to transaction
     *
     * @param int|string $orderId
     * @param string     $status
     *
     * @return bool
     */
    public function setTransactionStatus($orderId, string $status): bool
    {
        // TODO: Implement setTransactionStatus() method.
    }

    //<editor-fold desc="Getters and setters">

    /**
     * Set server url
     *
     * @param string $url
     *
     * @return IPartnerBoxIntegrationService
     */
    public function setServerUrl(string $url): IPartnerBoxIntegrationService
    {
        $this->serverUrl = $url;

        return $this;
    }

    /**
     * Get server url
     *
     * @return string
     */
    public function getServerUrl(): string
    {
        return $this->serverUrl;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return IPartnerBoxIntegrationService
     */
    public function setLogin(string $login): IPartnerBoxIntegrationService
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return IPartnerBoxIntegrationService
     */
    public function setPassword(string $password): IPartnerBoxIntegrationService
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set visitor's ID
     *
     * @param mixed $visitorId
     *
     * @return IPartnerBoxIntegrationService
     */
    public function setVisitorId($visitorId): IPartnerBoxIntegrationService
    {
        $this->visitorId = $visitorId;

        return $this;
    }

    /**
     * Get visitor's ID
     *
     * @return int|string
     */
    public function getVisitorId()
    {
        return $this->visitorId;
    }

    /**
     * Set account id
     *
     * @return int|string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set account id
     *
     * @param int|string $accountId
     *
     * @return PartnerBoxIntegrationService
     */
    public function setAccountId($accountId): self
    {
        $this->accountId = $accountId;

        return $this;
    }

    //</editor-fold>
}