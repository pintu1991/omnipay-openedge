<?php

namespace Omnipay\OpenEdge\Message;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = null;

        $this->validate('amount');

        $paymentMethod = $this->getPaymentMethod();

        switch ($paymentMethod)
        {
            case 'card' :
                break;

            case 'payment_profile' :

                if ($this->getCardReference()) {

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
                    $GatewayRequest->addChild('TransactionType', 'CreditSaleTransaction');

                    $GatewayRequest->addChild('OrderID', $this->getOrderNumber());
                    $GatewayRequest->addChild('Amount', $this->getAmount());
                    $GatewayRequest->addChild('Alias', $this->getCardReference());

                    $data = $GatewayRequest->asXML();
                }
                break;

            case 'token' :
                break;
            default :
                break;
        }

        return preg_replace('/\n/', ' ', $data);
    }
}

