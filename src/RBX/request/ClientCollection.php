<?php

namespace RBX\request;

use RBX\response\dto\client\BalanceDto;
use RBX\response\dto\client\WalletListDto;

class ClientCollection extends BaseRequest
{
    const PATH_BALANCE = 'client/balance';
    const PATH_WALLET_LIST = 'client/wallet-list';

    /**
     * @param int $currencyId
     * @return BalanceDto
     * @throws \Exception
     */
    public function getBalance(int $currencyId): BalanceDto
    {
        $response = $this->execute(self::PATH_BALANCE, 'GET', ['currencyId' => $currencyId]);
        $result = new BalanceDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @return WalletListDto
     * @throws \Exception
     */
    public function getWalletList(): WalletListDto
    {
        $response = $this->execute(self::PATH_WALLET_LIST, 'GET');
        $result = new WalletListDto();
        $result->parseApiResponse($response);

        return $result;
    }
}
