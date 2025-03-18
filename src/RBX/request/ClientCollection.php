<?php

namespace RBX\request;

class ClientCollection extends BaseRequest
{
    private $route = 'client/';


    public function getBalance()
    {
        $method = 'GET';
        $path = 'balance';
        try {
            $result = $this->execute($method, $path);
        } catch (\Exception $exception) {

        }
    }

    public function getWalletList()
    {
        $method = 'GET';
        $path = 'wallet-list';
        try {
            $result = $this->execute();
        } catch (\Exception $exception) {

        }
    }

    public function execute()
    {
    }
}
