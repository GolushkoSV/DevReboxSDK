<?php

namespace RBX\response\dto\client;

use RBX\response\dto\BaseResponseDto;
use RBX\response\dto\ResponseDto;

class WalletListDto extends BaseResponseDto
{
    protected array $list;

    public function parseApiResponse(ResponseDto $response): void
    {
//        $decodedResponse = $this->decodeResponse($response);
//
//        foreach ($decodedResponse->data as $item) {
//
//            $this->list []=
//        }
    }
}