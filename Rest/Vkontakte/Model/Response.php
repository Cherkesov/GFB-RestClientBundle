<?php
namespace GFB\RestClientBundle\Rest\Vkontakte\Model;

use JMS\Serializer\Annotation as Serialize;

class Response
{
    /**
     * @var integer
     * @Serialize\Type(name="integer")
     */
    private $count;

    /**
     * @var object[]
     * @Serialize\Type(name="array")
     */
    private $items;
}