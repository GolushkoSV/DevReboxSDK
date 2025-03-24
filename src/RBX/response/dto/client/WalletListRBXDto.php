<?php

namespace RBX\response\dto\client;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class WalletListRBXDto extends BaseResponseRBXDto
{
    protected array $list;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        foreach ($decodedResponse as $item) {
            $this->addWallet($item['currencyId'], $item['balance']);
        }
    }

    /**
     * @param int $currencyId
     * @param float $amount
     * @return void
     */
    protected function addWallet(int $currencyId, float $amount)
    {
        $this->list[] = [
            'currency_id' => $currencyId,
            'amount' => $amount
        ];
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }
}
