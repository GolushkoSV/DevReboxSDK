<?php

namespace RBX\response\dto\payment\method;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class MethodListRBXDto extends BaseResponseRBXDto
{
    /**
     * @var MethodRBXDto[] $list
     */
    protected array $list = [];

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        foreach ($decodedResponse as $attributes) {
            $methodDto = new MethodRBXDto();
            $methodDto->setAttributes($attributes);
            $this->list [] = $methodDto;
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
