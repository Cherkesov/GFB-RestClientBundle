<?php
namespace GFB\RestClientBundle\Rest\Vkontakte\Model;

use JMS\Serializer\Annotation as Serialize;

class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Serialize\SerializedName("first_name")
     */
    private $firstName;

    /**
     * @var string
     * @Serialize\SerializedName("last_name")
     */
    private $lastName;

    /**
     * @var City
     * @Serialize\Type("\GFB\RestClientBundle\Rest\Vkontakte\Model\City")
     */
    private $city;

    /**
     * @var string
     * @Serialize\SerializedName("photo_50")
     */
    private $photo50;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto50()
    {
        return $this->photo50;
    }

    /**
     * @param string $photo50
     * @return User
     */
    public function setPhoto50($photo50)
    {
        $this->photo50 = $photo50;

        return $this;
    }
}