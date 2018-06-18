<?php

namespace Omnipay\OpenEdge;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'OpenEdge';
    }

    public function getDefaultParameters()
    {
        return [
            'SpecVersion'=>'',
            'XWebID' => '',
            'TerminalID' => '',
            'AuthKey' => '',
            'Industry'=>'',
        ];
    }

    public function getSpecVersion()
    {
        return $this->getParameter('SpecVersio');
    }

    public function setSpecVersion($value)
    {
        return $this->setParameter('SpecVersion', $value);
    }

    public function getXWebID()
    {
        return $this->getParameter('XWebID');
    }

    public function setXWebID($value)
    {
        return $this->setParameter('XWebID', $value);
    }

    public function getTerminalID()
    {
        return $this->getParameter('TerminalID');
    }

    public function setTerminalID($value)
    {
        return $this->setParameter('TerminalID', $value);
    }

    public function getAuthKey()
    {
        return $this->getParameter('AuthKey');
    }

    public function setAuthKey($value)
    {
        return $this->setParameter('AuthKey', $value);
    }

    public function getIndustry()
    {
        return $this->getParameter('Industry');
    }

    public function setIndustry($value)
    {
        return $this->setParameter('Industry', $value);
    }

    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\OpenEdge\Message\CreateCardRequest', $parameters);
    }

    public function deleteCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\OpenEdge\Message\DeleteCardRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\OpenEdge\Message\PurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\OpenEdge\Message\RefundRequest', $parameters);
    }
}

