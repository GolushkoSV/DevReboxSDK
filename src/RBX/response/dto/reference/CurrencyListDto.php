<?php

namespace RBX\response\dto\reference;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class CurrencyListDto extends BaseResponseDto
{
    protected array $list = [];

    /**
     * @param ResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(ResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        foreach ($decodedResponse->list as $currency) {
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
