<?php
namespace GFB\RestClientBundle\Rest\Vkontakte;

use GFB\RestClientBundle\AbstractApiHostDescription;
use GuzzleHttp\Psr7\Stream;

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
     * @inheritdoc
     */
    public function preDeserialize($content)
    {
        $content = json_decode($content, true);
        if (isset($content['response'])) {
            $content = $content['response'];
        }


        return json_encode($content);
    }
}