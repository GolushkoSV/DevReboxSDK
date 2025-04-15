<?php

namespace RBX\response\dto;

abstract class BaseDto
{
    /**
     * @param array $attributes
     * @return void
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $property => $value) {
            if (isset($this->$property)) {
                $this->$property = $value;
            }
        }
    }
}
