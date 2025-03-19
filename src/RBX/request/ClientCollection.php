<?php

namespace RBX\request;

use RBX\response\dto\client\BalanceDto;
use RBX\response\dto\client\WalletListDto;

class ClientCollection extends BaseRequest
{
    private $route = 'client/';


    public function getBalance(int $currencyId): BalanceDto
    {
        $method = 'GET';
        $path = 'balance';
        $response = $this->execute($this->route . $path, $method, ['currencyId' => $currencyId]);
        $result = new BalanceDto();
        $result->parseApiResponse($response);

        return $result;
    }

    public function getWalletList()
    {
        $method = 'GET';
        $path = 'wallet-list';
        try {
            $response = $this->execute($this->route . $path, $method);
            $result = new WalletListDto();

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return $result;
    }
}
