<?php

namespace RBX\response\dto\reference;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class CurrencyListRBXDto extends BaseResponseRBXDto
{
    protected array $list = [];

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        foreach ($decodedResponse as $currency) {
            $this->list[] = [
                'id' => $currency['id'],
                'code' => $currency['code'],
                'title' => $currency['title'],
            ];
        }
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }
}
