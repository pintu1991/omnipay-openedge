<?php

namespace Omnipay\OpenEdge\Message;

class DeleteCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;
        $this->validate('cardReference');

        $GatewayRequest = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><GatewayRequest></GatewayRequest>');
        $GatewayRequest->addChild('SpecVersion', $this->getSpecVersion());
        $GatewayRequest->addChild('XWebID', $this->getXWebID());
        $GatewayRequest->addChild('TerminalID', $this->getTerminalID());
        $GatewayRequest->addChild('AuthKey', $this->getAuthKey());
        $GatewayRequest->addChild('Industry', $this->getIndustry());

        $GatewayRequest->addChild('POSType', 'PC');
        $GatewayRequest->addChild('PinCapabilities', 'FALSE');
        $GatewayRequest->addChild('TrackCapabilities', 'NONE');
        $GatewayRequest->addChild('TransactionType', 'AliasDeleteTransaction');

        $GatewayRequest->addChild('Alias', $this->getCardReference());

        $data = $GatewayRequest->asXML();

        return preg_replace('/\n/', ' ', $data);
    }
}
