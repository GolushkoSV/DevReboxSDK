<?php

namespace RBX\response\dto\client;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class WalletListDto extends BaseResponseDto
{
    protected array $list;

    /**
     * @param ResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(ResponseDto $response): void
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
