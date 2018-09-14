<?php namespace professionalweb\IntegrationHub\Drivers\PartnerBox\Services;

use professionalweb\IntegrationHub\Drivers\PartnerBox\Exceptions\WrongCredentialsException;
use professionalweb\IntegrationHub\Drivers\PartnerBox\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

/**
 * Service for integration with PartnerBox
 * @package professionalweb\IntegrationHub\Drivers\PartnerBox\Services
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
    private $saleUrl;

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
     * @var \Pap_Api_SaleTracker
     */
    private $saleTracker;

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
     * Create sale tracker
     *
     * @return \Pap_Api_SaleTracker
     * @throws WrongCredentialsException
     */
    protected function createSaleTracker(): \Pap_Api_SaleTracker
    {
        if ($this->saleTracker === null) {
            $this->saleTracker = new \Pap_Api_SaleTracker($this->getSaleUrl());
            $this->saleTracker->setAccountId($this->getAccountId());
            $this->saleTracker->setVisitorId($this->getVisitorId());
        }

        return $this->saleTracker;
    }

    /**
     * Track visitor
     *
     * @return bool
     */
    public function track(): bool
    {
        try {
            $this->createClickTracker()->track();
            $this->clickTracker->saveCookies();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Send event
     *
     * @param string     $eventName
     * @param string|int $productId
     * @param string|int $orderId
     * @param array      $data
     *
     * @return mixed
     * @throws WrongCredentialsException
     */
    public function sendEvent(string $eventName, $productId, $orderId, ...$data)
    {
        $saleTracker = $this->createSaleTracker();
        $action = $saleTracker->createAction($eventName)
            ->setProductId($productId)
            ->setOrderId($orderId);
        $dataParamsQty = min(5, \count($data));
        for ($i = 0; $i < $dataParamsQty; $i++) {
            $methodName = 'setData' . ($i + 1);
            $action->$methodName($data[$i]);
        }

        $saleTracker->register();

        return $saleTracker->getTrackerResponse();
    }

    /**
     * Set status to transaction
     *
     * @param int|string $orderId
     * @param string     $status
     *
     * @return mixed
     */
    public function setTransactionStatus($orderId, string $status)
    {
        $request = new \Pap_Api_TransactionsGrid($this->session);
        $request->addFilter('orderid', \Gpf_Data_Filter::EQUALS, $orderId);
        $request->sendNow();
        $grid = $request->getGrid();
        $recordSet = $grid->getRecordset();
        if ($rec = $recordSet->get(0)) {
            try {
                $sale = new \Pap_Api_Transaction($this->session);
                $sale->setTransid($rec->get('id'));
                if ($sale->load()) {
                    $sale->setStatus($status);
                    if ($sale->save()) {
                        return true;
                    }
                }
            } catch (\Exception $ex) {
                return false;
            }
        }

        return false;
    }

    //<editor-fold desc="Getters and setters" defaultstate="collapsed">

    /**
     * Set server url
     *
     * @param string $url
     *
     * @return $this
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
    public function getServerUrl(): ?string
    {
        return $this->serverUrl;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return $this
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
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return $this
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
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set visitor's ID
     *
     * @param mixed $visitorId
     *
     * @return $this
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

    /**
     * Get sale url
     *
     * @return string
     */
    public function getSaleUrl(): string
    {
        return $this->saleUrl;
    }

    /**
     * Set sale url
     *
     * @param string $saleUrl
     *
     * @return $this
     */
    public function setSaleUrl(string $saleUrl): self
    {
        $this->saleUrl = $saleUrl;

        return $this;
    }


    //</editor-fold>
}