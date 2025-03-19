<?php

namespace RBX\client;

use RBX\request\ReferenceCollection;
use RBX\request\ClientCollection;

class RBXApiClient
{
    public function client()
    {
        return new ClientCollection();
    }

    public function reference()
    {
        return new ReferenceCollection();
    }
}
