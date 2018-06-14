<?php

class Nrg_EmailVerificator_IndexController extends Mage_Core_Controller_Front_Action
{
    public function validateAction()
    {
        /** @var Nrg_EmailVerificator_Model_Validator $validator */
        $validator = Mage::getModel('nrg_emailverificator/validator');
        $this->getResponse()->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0');
        $this->getResponse()->setHeader('Pragma', 'no-cache');
        $this->sendJsonResponse([
            'valid' => $validator->isValid($this->getRequest()->getParam('email')),
        ]);
    }

    private function sendJsonResponse(array $data)
    {
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(
            Mage::helper('core')->jsonEncode($data)
        );
    }
}
