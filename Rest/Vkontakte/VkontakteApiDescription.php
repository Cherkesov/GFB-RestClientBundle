<?php
namespace GFB\RestClientBundle\Rest\Vkontakte;

use GFB\RestClientBundle\AbstractApiHostDescription;

class VkontakteApiDescription extends AbstractApiHostDescription
{
    /**
     * @return string
     */
    public function getUrl()
    {
        return 'https://api.vk.com/method/';
    }

    /**
     * @return string
     */
    public function getDataFormat()
    {
        return self::DATA_FORMAT_JSON;
    }

    /**
     * @inheritDoc
     */
    public function preDeserialize($rawData)
    {
        $rawData = json_decode($rawData, true)['response'];
        return json_encode($rawData);
    }
}