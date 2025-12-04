<?php

namespace RBX\request;

use RBX\response\dto\client\BalanceRBXDto;
use RBX\response\dto\client\WalletListRBXDto;

class ClientCollection extends BaseRequest
{
    const PATH_BALANCE = 'client/balance';
    const PATH_WALLET_LIST = 'client/wallet-list';

    /**
     * @param int $currencyId
     * @return BalanceRBXDto
     * @throws \Exception
     */
    public function getBalance(int $currencyId): BalanceRBXDto
    {
        $response = $this->execute(self::PATH_BALANCE, self::METHOD_GET, ['currencyId' => $currencyId]);
        $result = new BalanceRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }

    /**
     * @return WalletListRBXDto
     * @throws \Exception
     */
    public function getWalletList(): WalletListRBXDto
    {
        $response = $this->execute(self::PATH_WALLET_LIST, self::METHOD_GET);
        $result = new WalletListRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }
}
