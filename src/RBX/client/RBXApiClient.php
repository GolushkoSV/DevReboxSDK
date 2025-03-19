<?php

namespace RBX\client;

use RBX\request\PaymentOutCollection;
use RBX\request\PaymentInCollection;
use RBX\request\ReferenceCollection;
use RBX\request\ClientCollection;

class RBXApiClient
{
    /**
     * @return ClientCollection
     */
    public function client(): ClientCollection
    {
        return new ClientCollection();
    }

    /**
     * @return ReferenceCollection
     */
    public function reference(): ReferenceCollection
    {
        return new ReferenceCollection();
    }

    /**
     * @return PaymentOutCollection
     */
    public function paymentOut(): PaymentOutCollection
    {
        return new PaymentOutCollection();
    }

    /**
     * @return PaymentInCollection
     */
    public function paymentIn(): PaymentInCollection
    {
        return new PaymentInCollection();
    }
}
