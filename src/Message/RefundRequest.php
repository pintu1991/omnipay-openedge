<?php

namespace Omnipay\OpenEdge\Message;

class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'transactionReference');

        $GatewayRequest = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><GatewayRequest></GatewayRequest>');
        $GatewayRequest->addChild('SpecVersion', $this->getSpecVersion());
        $GatewayRequest->addChild('XWebID', $this->getXWebID());
        $GatewayRequest->addChild('TerminalID', $this->getTerminalID());
        $GatewayRequest->addChild('AuthKey', $this->getAuthKey());
        $GatewayRequest->addChild('Industry', $this->getIndustry());

        $GatewayRequest->addChild('POSType', 'PC');
        $GatewayRequest->addChild('CustomerPresent', 'FALSE');
        $GatewayRequest->addChild('CardPresent', 'FALSE');
        $GatewayRequest->addChild('PinCapabilities', 'FALSE');
        $GatewayRequest->addChild('TrackCapabilities', 'NONE');
        $GatewayRequest->addChild('DuplicateMode', 'CHECKING_OFF');
        $GatewayRequest->addChild('TransactionType', 'CreditReturnTransaction');

        $xmlData = simplexml_load_string($this->getTransactionReference());
        $GatewayRequest->addChild('TransactionID', $xmlData->TransactionID);
        $GatewayRequest->addChild('Amount', $this->getAmount());

        $data = $GatewayRequest->asXML();

        return preg_replace('/\n/', ' ', $data);
    }
}
