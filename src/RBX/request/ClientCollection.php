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
            $result = $this->execute($method, $this->route . $path);
        } catch (\Exception $exception) {

        }
    }

    public function getWalletList()
    {
        $method = 'GET';
        $path = 'wallet-list';
        try {
            $result = $this->execute($method, $this->route . $path);
        } catch (\Exception $exception) {

        }

        return $result;
    }
}
