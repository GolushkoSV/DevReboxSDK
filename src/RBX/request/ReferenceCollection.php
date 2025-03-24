<?php

namespace RBX\request;

use RBX\response\dto\reference\CurrencyListRBXDto;

class ReferenceCollection extends BaseRequest
{
    const PATH_CURRENCY_LIST = 'reference/currency-list';

    /**
     * @return CurrencyListRBXDto
     * @throws \Exception
     */
    public function getCurrencyList(): CurrencyListRBXDto
    {
        $response = $this->execute(self::PATH_CURRENCY_LIST, self::METHOD_GET);
        $result = new CurrencyListRBXDto();
        $result->parseApiResponse($response);

        return $result;
    }
}
