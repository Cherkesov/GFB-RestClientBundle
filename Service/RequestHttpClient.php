<?php
/**
 * Created by PhpStorm.
 * User: scherk01
 * Date: 18.05.2016
 * Time: 15:33
 */

namespace GFB\RestClientBundle\Service;


use GFB\RestClientBundle\ApiMethodDescriptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

abstract class RequestHttpClient
{
    const DATA_FORMAT_JSON = 'json';
    const DATA_FORMAT_XML = 'xml';

    /** @var SerializerInterface */
    private $serializer;

    /**
     * RequestHttpClient constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
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

        foreach ($apiMethod->getParametersAllowedTypes() as $option => $types) {
            $optionsResolver->setAllowedTypes($option, $types);
        }

        $optionsResolver->setDefaults($apiMethod->getDefaultParameters());
        $optionsResolver->resolve($options);

        // TODO: do request to remote API

        $rawData = <<<DATA
response: [{
    id: 205387401,
    first_name: 'Tom',
    last_name: 'Cruise',
    city: {
        id: 5331,
        title: 'Los Angeles'
    },
    photo_50: 'https://pp.vk.me/...760/pV6sZ5wRGxE.jpg',
    verified: 1
}]
DATA;

        $result = $this->serializer->deserialize(
            $rawData,
            $apiMethod->getResultModelType(),
            $this->getDataFormat()
        );

        return $result;
    }
}