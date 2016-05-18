<?php
/**
 * Created by PhpStorm.
 * User: scherk01
 * Date: 18.05.2016
 * Time: 17:34
 */

namespace GFB\RestClientBundle;


interface ApiHostDescriptionInterface
{
    /**
     * @return string
     */
    public function getUrl();
}