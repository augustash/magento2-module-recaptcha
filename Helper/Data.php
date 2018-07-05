<?php
/**
 * Magento 2 Recaptcha for Contact Page, Customer Create, and Forgot Password
 * Copyright (C) 2017  Derek Marcinyshyn
 *
 * This file included in Monashee/Recaptcha is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Monashee\Recaptcha\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

use Augustash\Logger\Helper\Data as AshLogger;
use Magento\Framework\Exception\LocalizedException;

class Data extends AbstractHelper
{

    const XML_PATH_ENABLED = 'monashee_recaptcha/settings/enabled';
    const XML_PATH_SITE_KEY = 'monashee_recaptcha/settings/site_key';
    const XML_PATH_SECRET_KEY = 'monashee_recaptcha/settings/secret_key';

    const XML_PATH_ENABLED_IN_CUSTOMER_REGISTRATION = 'monashee_recaptcha/settings/enabled_in_customer_registration';
    const XML_PATH_ENABLED_IN_FORGOT_PASSWORD = 'monashee_recaptcha/settings/enabled_in_forgotpassword';
    const XML_PATH_ENABLED_IN_CONTACT_FORM = 'monashee_recaptcha/settings/enabled_in_contact_form';


    /**
     * @var \Augustash\Logger\Helper\Data
     */
    protected $logger;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Data constructor.
     * @param Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        AshLogger $logger,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->logger = $logger;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Is module enabled
     *
     * @param null $storeId
     * @return boolean
     */
    public function isEnabled($storeId = null)
    {
        return (bool)$this->getConfig(self::XML_PATH_ENABLED, $storeId);
    }

    /**
     * Get the site key
     *
     * @param null $storeId
     * @return string
     */
    public function getSiteKey($storeId = null)
    {
        return $this->getConfig(self::XML_PATH_SITE_KEY, $storeId);
    }

    /**
     * Get the secret key
     *
     * @param null $storeId
     * @return string
     */
    public function getSecretKey($storeId = null)
    {
        return $this->getConfig(self::XML_PATH_SECRET_KEY, $storeId);
    }


    /**
     * Is module enabled in customer registration form
     *
     * @param null $storeId
     * @return boolean
     */
    public function isEnabledInCustomerRegistration($storeId = null)
    {
        if (!$this->isEnabled($storeId)) {
            return false;
        }

        return (bool)$this->getConfig(self::XML_PATH_ENABLED_IN_CUSTOMER_REGISTRATION, $storeId);
    }

    /**
     * Is module enabled in forgot password form
     *
     * @param null $storeId
     * @return boolean
     */
    public function isEnabledInForgotPassword($storeId = null)
    {
        if (!$this->isEnabled($storeId)) {
            return false;
        }

        return (bool)$this->getConfig(self::XML_PATH_ENABLED_IN_FORGOT_PASSWORD, $storeId);
    }

    /**
     * Is module enabled in forgot password form
     *
     * @param null $storeId
     * @return boolean
     */
    public function isEnabledInContactForm($storeId = null)
    {
        if (!$this->isEnabled($storeId)) {
            return false;
        }

        return (bool)$this->getConfig(self::XML_PATH_ENABLED_IN_CONTACT_FORM, $storeId);
    }

    /**
     * Returns the ID of the current store
     *
     * @return int
     */
    public function getCurrentStoreId()
    {
        return $this->storeManager->getStore()->getStoreId();
    }

    /**
     * Utility function to ease fetching of values from the Stores > Configuration
     *
     * @param  string           $field      # see the etc/adminhtml/system.xml for field names
     * @param  null|integer     $storeId    # Magento store ID
     * @return mixed
     */
    protected function getConfig($field, $storeId = null)
    {
        $storeId = (!is_null($storeId)) ? $storeId : $this->getCurrentStoreId();
        return $this->scopeConfig->getValue(
            $field,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
