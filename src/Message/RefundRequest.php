<?php

namespace Omnipay\OpenEdge\Message;

class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'transactionReference');

        $transactionReference = simplexml_load_string($this->getTransactionReference());
        $transactionReceipt = $transactionReference->receipt;

//        $soap = simplexml_load_string($this->getTransactionReference());
//        $body = $soap->children('http://www.w3.org/2003/05/soap-envelope')->Body->children();
//        $Token = (string) $body->SaleResponse->SaleResult->Token;
//        $res_add_cc4 = $res_add_cc2->addChild('PaymentData','');
//        $res_add_cc4->addChild('Source','PreviousTransaction');
//        $res_add_cc4->addChild('Token',$Token);

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
