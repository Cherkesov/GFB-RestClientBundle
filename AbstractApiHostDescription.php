<?php
namespace GFB\RestClientBundle;

abstract class AbstractApiHostDescription implements ApiHostDescriptionInterface
{
    /**
     * @inheritdoc
     */
    public function preDeserialize($rawData)
    {
        return $rawData;
    }
}