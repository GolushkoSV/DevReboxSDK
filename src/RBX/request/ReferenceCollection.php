<?php

namespace RBX\request;

use RBX\response\dto\reference\CurrencyListDto;

class ReferenceCollection extends BaseRequest
{
    const PATH_CURRENCY_LIST = 'reference/currency-list';

    /**
     * @return CurrencyListDto
     * @throws \Exception
     */
    public function getCurrencyList(): CurrencyListDto
    {
        $response = $this->execute(self::PATH_CURRENCY_LIST, 'GET');
        $result = new CurrencyListDto();
        $result->parseApiResponse($response);

        return $result;
    }
}