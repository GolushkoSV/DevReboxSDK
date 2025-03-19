<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class MethodListDto extends BaseResponseDto
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
