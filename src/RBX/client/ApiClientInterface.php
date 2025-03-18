<?php

namespace RBX\client;

interface ApiClientInterface
{
    public function setSign(string $sign);
    public function setSerial(string $serial);
}
