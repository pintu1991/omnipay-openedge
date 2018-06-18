<?php

namespace Omnipay\OpenEdge\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        if (
            (
                isset($this->data->ResponseCode) &&
                $this->data->ResponseCode != null &&
                $this->data->ResponseCode == '005'
            ) && (
                isset($this->data->ResponseDescription) &&
                $this->data->ResponseDescription != null &&
                str_contains($this->data->ResponseDescription, 'Created')
            )
        )
        { return true; }
        else if(
            (
                isset($this->data->ResponseCode) &&
                $this->data->ResponseCode != null &&
                $this->data->ResponseCode == '005'
            ) && (
                isset($this->data->ResponseDescription) &&
                $this->data->ResponseDescription != null &&
                str_contains($this->data->ResponseDescription, 'Deleted')
            )
        )
        { return true; }
        else if (
            isset($this->data->ResponseCode) &&
            $this->data->ResponseCode != null &&
            $this->data->ResponseCode == '000' &&
            isset($this->data->ResponseDescription) &&
            $this->data->ResponseDescription != null &&
            $this->data->ResponseDescription == 'Approval'
            )
            { return true; }

        return false;
    }

    public function getCardReference()
    {
        return isset($this->data->Alias) ? (string) $this->data->Alias : null;
    }

    public function getCode()
    {
        return null;
    }

    public function getAuthCode()
    {
        return null;
    }

    public function getTransactionId()
    {
        return null;
    }

    public function getTransactionReference()
    {
        if( isset($this->data->TransactionID) && (string) $this->data->TransactionID != null)
            return $this->data->TransactionID;
        else
            return null;
    }

    public function getMessage()
    {
        return null;
    }

    public function getOrderNumber()
    {
        return  null;
    }

    public function getData()
    {
        return preg_replace('/\n/', '', ($this->data)->asXML());
    }
}
