<?php
namespace GFB\RestClientBundle\Rest\Vkontakte;

use GFB\RestClientBundle\ApiHostDescriptionInterface;

class VkontakteApiDescription implements ApiHostDescriptionInterface
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
}