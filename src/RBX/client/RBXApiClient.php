<?php

namespace RBX\client;

use RBX\request\ClientCollection;

class RBXApiClient
{
    protected const API_HOST = 'http://api-public.rebox.local';

    public function getClient()
    {
        return new ClientCollection();
    }








    public function getBalance()
    {
    }

    public function getWalletList()
    {

    }


    public function getPaymentMethodList()
    {

    }

    public function payment()
    {

    }

    public function checkPayment()
    {

    }

    public function checkChainPayment()
    {

    }

    public function getCurrencyList()
    {

    }

    private function execute()
    {

    }
}
