<?php

class Nrg_EmailVerificator_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_ENABLE_PATH = 'customer/email_verification/enable';
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_API_URL_PATH = 'customer/email_verification/api_url';
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_API_KEY_PATH = 'customer/email_verification/api_key';

    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FORMAT_PATH_ENABLE = 'customer/email_verification/validation_format_check_enable';
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FORMAT_PATH = 'customer/email_verification/validation_format_check';

    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_SMTP_PATH_ENABLE = 'customer/email_verification/validation_smtp_check_enable';
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_SMTP_PATH = 'customer/email_verification/validation_smtp_check';

    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DNS_PATH_ENABLE = 'customer/email_verification/validation_dns_check_enable';
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DNS_PATH = 'customer/email_verification/validation_dns_check';

    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FREE_PATH_ENABLE = 'customer/email_verification/validation_free_check_enable';
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FREE_PATH = 'customer/email_verification/validation_free_check';

    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DISPOSABLE_PATH_ENABLE = 'customer/email_verification/validation_disposable_check_enable';
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DISPOSABLE_PATH = 'customer/email_verification/validation_disposable_check';

    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_CATCHALL_PATH_ENABLE = 'customer/email_verification/validation_catchall_check_enable';
    const XML_PATH_CUSTOMER_EMAIL_VERIFICATION_CATCHALL_PATH = 'customer/email_verification/validation_catchall_check';

    /**
     * Map of {API response property code} => {XML Path to config}
     *
     * @var array
     */
    private $checkMap = [
        'formatCheck' => [
            'enable_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FORMAT_PATH_ENABLE,
            'value_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FORMAT_PATH,
        ],
        'smtpCheck' => [
            'enable_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_SMTP_PATH_ENABLE,
            'value_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_SMTP_PATH,
        ],
        'dnsCheck' => [
            'enable_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DNS_PATH_ENABLE,
            'value_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DNS_PATH,
        ],
        'freeCheck' => [
            'enable_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FREE_PATH_ENABLE,
            'value_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FREE_PATH,
        ],
        'disposableCheck' => [
            'enable_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DISPOSABLE_PATH_ENABLE,
            'value_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DISPOSABLE_PATH,
        ],
        'catchAllCheck' => [
            'enable_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_CATCHALL_PATH_ENABLE,
            'value_path' => self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_CATCHALL_PATH,
        ],
    ];

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)(int)Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_ENABLE_PATH);
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_API_URL_PATH);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_API_KEY_PATH);
    }

    /**
     * @return bool
     */
    public function isValidatedFormat()
    {
        return (bool)(int)Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FORMAT_PATH);
    }

    /**
     * @return bool
     */
    public function isValidatedSmtp()
    {
        return (bool)(int)Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_SMTP_PATH);
    }

    /**
     * @return bool
     */
    public function isValidatedDns()
    {
        return (bool)(int)Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DNS_PATH);
    }

    /**
     * @return bool
     */
    public function isValidatedFree()
    {
        return (bool)(int)Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_FREE_PATH);
    }

    /**
     * @return bool
     */
    public function isValidatedDisposable()
    {
        return (bool)(int)Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_DISPOSABLE_PATH);
    }

    /**
     * @return bool
     */
    public function isValidatedCatchAll()
    {
        return (bool)(int)Mage::getStoreConfig(self::XML_PATH_CUSTOMER_EMAIL_VERIFICATION_CATCHALL_PATH);
    }

    /**
     * @return array
     */
    public function getEnabledChecks()
    {
        $checks = [];

        foreach ($this->checkMap as $apiPropertyCode => $configXmlPathes) {
            if ((bool)(int)Mage::getStoreConfig($configXmlPathes['enable_path'])) {
                $checks[$apiPropertyCode] = (bool)(int)Mage::getStoreConfig($configXmlPathes['value_path']);
            }
        }

        return $checks;
    }
}
