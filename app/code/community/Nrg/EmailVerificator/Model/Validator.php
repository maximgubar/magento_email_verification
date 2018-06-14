<?php

class Nrg_EmailVerificator_Model_Validator
{
    /**
     * @param string $email
     * @return bool
     */
    public function isValid($email)
    {
        if (!$this->getHelper()->isEnabled()) {
            return true;
        }

        try {
            $validationResult = $this->validate($email);
            foreach ($this->getHelper()->getEnabledChecks() as $propertyCode => $expectedValue) {
                $expectedValueAsString = $expectedValue ? 'true' : 'false';
                if ($validationResult[$propertyCode] != $expectedValueAsString) {
                    return false;
                }
            }
            return true;
        } catch (\Exception $exception) {
            Mage::logException($exception);
            return false;
        }
    }

    private function validate($email)
    {
        $client = new Zend_Http_Client(sprintf(
            "%s?apiKey=%s&emailAddress=%s",
            $this->getHelper()->getApiUrl(),
            $this->getHelper()->getApiKey(),
            $email
        ));
        $response = $client->request(Zend_Http_Client::GET);
        return json_decode($response->getBody(), true);
    }

    /**
     * @return Mage_Core_Helper_Abstract|Nrg_EmailVerificator_Helper_Data
     */
    private function getHelper()
    {
        return Mage::helper('nrg_emailverificator');
    }
}
