<?php
/**
 * Created by PhpStorm.
 * User: scherk01
 * Date: 18.05.2016
 * Time: 16:10
 */

namespace GFB\RestClientBundle\Rest\Vkontakte\Method;


use GFB\RestClientBundle\ApiMethodDescriptionInterface;

class UsersGet implements ApiMethodDescriptionInterface
{
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
        return '/users.get';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultParameters()
    {
        return array(
            'user_ids' => null,
            'fields' => 'photo_50,city,verified',
        );
    }

    /**
     * @inheritdoc
     */
    public function getParametersAllowedTypes()
    {
        return array(
            'user_ids' => 'string',
            'fields' => 'string',
            'name_case' => 'string',
        );
    }

    /**
     * @inheritdoc
     */
    public function getResultModelType()
    {
        return '\GFB\RestClientBundle\Rest\Vkontakte\Model\User[]';
    }
}