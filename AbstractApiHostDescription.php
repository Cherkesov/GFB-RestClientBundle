<?php
namespace GFB\RestClientBundle;

abstract class AbstractApiHostDescription implements ApiHostDescriptionInterface
{
    /**
     * @param string $rawData
     * @return string
     */
    public function preDeserialize($rawData)
    {
        return $rawData;
    }
}