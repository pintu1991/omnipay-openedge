<?php

namespace Omnipay\OpenEdge\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;
        $this->getCard()->validate();

        if ($this->getCard()) {

            $GatewayRequest = new \SimpleXMLElement('<?xml version="1.0"?><GatewayRequest></GatewayRequest>');
            $GatewayRequest->addChild('SpecVersion', $this->getSpecVersion());
            $GatewayRequest->addChild('XWebID', $this->getXWebID());
            $GatewayRequest->addChild('TerminalID', $this->getTerminalID());
            $GatewayRequest->addChild('AuthKey', $this->getAuthKey());
            $GatewayRequest->addChild('Industry', $this->getIndustry());

            $GatewayRequest->addChild('POSType', 'PC');
            $GatewayRequest->addChild('PinCapabilities', 'FALSE');
            $GatewayRequest->addChild('CustomerPresent', 'FALSE');
            $GatewayRequest->addChild('CardPresent', 'FALSE');
            $GatewayRequest->addChild('TrackCapabilities', 'NONE');
            $GatewayRequest->addChild('TransactionType', 'CreditAuthTransaction');
            $GatewayRequest->addChild('CreateAlias', 'TRUE');
            $GatewayRequest->addChild('Amount', 0.00);

            $GatewayRequest->addChild('AcctNum', $this->getCard()->getNumber());
            $GatewayRequest->addChild('ExpDate', $this->getCard()->getExpiryDate('my'));
            $GatewayRequest->addChild('CardCode', $this->getCard()->getNumberLastFour());
            $GatewayRequest->addChild('Address', $this->getCard()->getBillingCountry());
            $GatewayRequest->addChild('ZipCode', $this->getCard()->getBillingPostcode());

            $data = $GatewayRequest->asXML();
        }

        return preg_replace('/\n/', ' ', $data);
    }
}
