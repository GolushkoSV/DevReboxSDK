<?php

namespace RBX\client;

use RBX\request\PaymentOutCollection;
use RBX\request\PaymentInCollection;
use RBX\request\ReferenceCollection;
use RBX\request\ClientCollection;

class RBXApiClient
{
    private string $host = 'https://api.rebox.pro';
    private string $_serial;
    private string $_secretKey;

    /**
     * @param string $serial
     * @param string $secretKey
     */
    public function __construct(string $serial, string $secretKey)
    {
        $this->_serial = $serial;
        $this->_secretKey = $secretKey;
    }

    /**
     * @return ClientCollection
     */
    public function client(): ClientCollection
    {
        return $this->createCollection(ClientCollection::class);
    }

    /**
     * @return ReferenceCollection
     */
    public function reference(): ReferenceCollection
    {
        return $this->createCollection(ReferenceCollection::class);
    }

    /**
     * @return PaymentOutCollection
     */
    public function paymentOut(): PaymentOutCollection
    {
        return $this->createCollection(PaymentOutCollection::class);
    }

    /**
     * @return PaymentInCollection
     */
    public function paymentIn(): PaymentInCollection
    {
        return $this->createCollection(PaymentInCollection::class);
    }

    /**
     * @param string $collectionClass
     * @return object
     */
    private function createCollection(string $collectionClass): object
    {
        return new $collectionClass($this->host, $this->_serial, $this->_secretKey);
    }
}
