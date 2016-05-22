<?php
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
        return 'users.get';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultParameters()
    {
        return array(
            'user_ids' => null,
            'fields' => ['photo_50', 'city', 'verified'],
            'name_case' => 'nom',
        );
    }

    /**
     * @inheritdoc
     */
    public function getParametersAllowedTypes()
    {
        return array(
            'user_ids' => ['string', 'array'],
            'fields' => ['string', 'array'],
            'name_case' => ['string', 'array'],
        );
    }

    /**
     * @inheritDoc
     */
    public function getParametersAllowedValues()
    {
        return array(
            'name_case' => ['nom', 'gen', 'dat', 'acc', 'ins', 'abl'],
        );
    }

    /**
     * @inheritdoc
     */
    public function getResultModelType()
    {
        return array(
            array(
                'from' => '*',
                'to' => 'GFB\RestClientBundle\Rest\Vkontakte\Model\Response',
                'to_var' => '*',
            ),
            array(
                'from' => '*.response',
                'to' => 'array<GFB\RestClientBundle\Rest\Vkontakte\Model\User>',
                'to_var' => '*.response',
            ),
        );
    }
}
