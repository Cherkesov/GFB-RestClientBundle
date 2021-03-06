<?php
namespace GFB\RestClientBundle\Rest\Vkontakte\Model;

use JMS\Serializer\Annotation as Serialize;

class City
{
    /**
     * @var integer
     * @Serialize\Type(name="integer")
     */
    private $id;

    /**
     * @var string
     * @Serialize\Type(name="string")
     */
    private $title;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return City
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return City
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}