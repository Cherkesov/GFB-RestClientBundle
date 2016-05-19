<?php
/**
 * Created by PhpStorm.
 * User: scherk01
 * Date: 18.05.2016
 * Time: 15:33
 */

namespace GFB\RestClientBundle\Service;


use GFB\RestClientBundle\ApiMethodDescriptionInterface;
use JMS\Serializer\Serializer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

abstract class RequestHttpClient
{
    const DATA_FORMAT_JSON = 'json';
    const DATA_FORMAT_XML = 'xml';

    /** @var Serializer */
    private $serializer;

    /**
     * RequestHttpClient constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return string
     */
    public abstract function getDataFormat();

    /**
     * @param ApiMethodDescriptionInterface $apiMethod
     * @param array $options
     * @return null
     */
    public function run(ApiMethodDescriptionInterface $apiMethod, array $options)
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setDefaults($apiMethod->getDefaultParameters());

        foreach ($apiMethod->getParametersAllowedTypes() as $option => $types) {
            $optionsResolver->setAllowedTypes($option, $types);
        }

        $optionsResolver->resolve($options);

        // TODO: do request to remote API

        $rawData = <<<DATA
{
    "response":[
        {
            "id":205387401,
            "first_name":"Tom",
            "last_name":"Cruise",
            "city":{"id":5331,"title":"Los Angeles"},
            "photo_50":"https:\/\/pp.vk.me\/c402330\/v402330401\/9760\/pV6sZ5wRGxE.jpg",
            "verified":0
        },
        {
            "id":123,
            "first_name":"Vasya",
            "last_name":"Vasilev",
            "city":{"id":5331,"title":"Los Angeles"},
            "photo_50":"https:\/\/pp.vk.me\/c402330\/v402330401\/9760\/pV6sZ5wRGxE.jpg",
            "verified":0
        }
    ]
}
DATA;
        $rawData = json_decode($rawData, true)['response'];
        $rawData = json_encode($rawData);

        $result = $this->serializer->deserialize(
            $rawData,
            $apiMethod->getResultModelType(),
            $this->getDataFormat()
        );

        return $result;
    }
}