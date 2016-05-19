<?php
/**
 * Created by PhpStorm.
 * User: scherk01
 * Date: 19.05.2016
 * Time: 13:22
 */

namespace GFB\RestClientBundle\Rest\Vkontakte;


use GFB\RestClientBundle\Service\RequestHttpClient;

class VkontakteRestClient extends RequestHttpClient
{
    /**
     * @return string
     */
    public function getDataFormat()
    {
        return self::DATA_FORMAT_JSON;
    }
}