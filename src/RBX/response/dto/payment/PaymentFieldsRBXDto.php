<?php

namespace RBX\response\dto\payment;

use RBX\response\dto\BaseResponseRBXDto;
use RBX\response\dto\CurlResponseDto;

class PaymentFieldsRBXDto extends BaseResponseRBXDto
{
    protected array $_list;

    /**
     * @param CurlResponseDto $response
     * @return void
     * @throws \Exception
     */
    public function parseApiResponse(CurlResponseDto $response): void
    {
        $decodedResponse = $this->decodeResponse($response);
        foreach ($decodedResponse as $paymentField) {
            $this->addPaymentField(
                $paymentField['code'],
                $paymentField['title'],
                $paymentField['label'],
                $paymentField['mask'],
                $paymentField['regexp'],
                $paymentField['minLen'],
                $paymentField['maxLen'],
            );
        }
    }
    
    /**
     * @param string $code
     * @param string $title
     * @param string $label
     * @param string $mask
     * @param string $regexp
     * @param int $minLen
     * @param int $maxLen
     * @return void
     */
    protected function addPaymentField(
        string $code,
        string $title,
        string $label,
        string $mask,
        string $regexp,
        int    $minLen,
        int    $maxLen
    ): void {
        $this->_list [] = [
            'code' => $code,
            'title' => $title,
            'label' => $label,
            'mask' => $mask,
            'regexp' => $regexp,
            'minLen' => $minLen,
            'maxLen' => $maxLen,
        ];
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->_list;
    }
}
