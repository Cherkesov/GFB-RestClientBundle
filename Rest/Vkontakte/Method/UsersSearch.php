<?php
namespace GFB\RestClientBundle\Rest\Vkontakte\Method;

use GFB\RestClientBundle\ApiMethodDescriptionInterface;

class UsersSearch implements ApiMethodDescriptionInterface
{
    const STATUS_SINGLE = 1;
    const STATUS_MEETS = 2;
    const STATUS_ENGAGED = 3;
    const STATUS_MARRIED = 4;
    const STATUS_ITS_COMPLICATED = 5;
    const STATUS_IN_LOVE = 7;
    const STATUS_ACTIVE_SEARCH = 6;

    const ONLINE_IS_TRUE = 0;
    const ONLINE_NEVER_MIND = 1;

    /**
     * @inheritdoc
     */
    public function getHttpMethod()
    {
        return self::HTTP_METHOD_GET;
    }

    /**
     * @inheritdoc
     */
    public function getUri()
    {
        return 'users.search';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultParameters()
    {
        return array(
            'q' => null,
            'sort' => null,
            'offset' => 0,
            'count' => 10,
            'status' => null,
            'age_from' => 0,
            'age_to' => 200,
            'online' => self::ONLINE_NEVER_MIND,
        );
    }

    /**
     * @inheritdoc
     */
    public function getParametersAllowedTypes()
    {
        return array(
            'q' => ['string'],
            'sort' => ['null', 'string'],
            'offset' => ['integer'],
            'count' => ['integer'],
            'status' => ['null','integer', 'array'],
            'age_from' => ['integer'],
            'age_to' => ['integer'],
            'online' => ['integer'],
        );
    }

    /**
     * @inheritDoc
     */
    public function getParametersAllowedValues()
    {
        return array(
            /*'status' => [
                self::STATUS_SINGLE,
                self::STATUS_MEETS,
                self::STATUS_ENGAGED,
                self::STATUS_MARRIED,
                self::STATUS_ITS_COMPLICATED,
                self::STATUS_ACTIVE_SEARCH,
                self::STATUS_IN_LOVE,
            ],*/
            'online' => [
                self::ONLINE_IS_TRUE,
                self::ONLINE_NEVER_MIND,
            ],
        );
    }

    /**
     * @inheritdoc
     */
    public function getResultModelType()
    {
        return 'array<GFB\RestClientBundle\Rest\Vkontakte\Model\Response>';
    }
}