<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class MethodListRBXDto extends BaseResponseRBXDto
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
        foreach ($decodedResponse as $item) {
            $this->list [] = [
                "id" => $item["id"],
                "code" => $item["code"],
                "name" => $item["name"],
                "description" => $item["description"],
                "currency_id" => $item["currency_id"],
                "min_amount" => $item["min_amount"],
                "max_amount" => $item["max_amount"],
                "payment_fields" => $item["payment_fields"],
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
