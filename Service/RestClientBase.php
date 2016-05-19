<?php
namespace GFB\RestClientBundle\Service;

use GFB\RestClientBundle\ApiHostDescriptionInterface;
use GFB\RestClientBundle\ApiMethodDescriptionInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\Serializer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestClientBase
{
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
     * @param ApiHostDescriptionInterface $apiHostDescription
     * @param ApiMethodDescriptionInterface $apiMethod
     * @param array $options
     * @return null
     */
    public function run(
        ApiHostDescriptionInterface $apiHostDescription,
        ApiMethodDescriptionInterface $apiMethod,
        array $options
    ) {
        $options = $this->prepareParameters($apiMethod, $options);
        $response = $this->sendRequest($apiHostDescription, $apiMethod, $options);
        $result = $this->processResponse($apiHostDescription, $apiMethod, $response);

        return $result;
    }

    /**
     * @param ApiMethodDescriptionInterface $apiMethod
     * @param array $options
     * @return array
     */
    protected function prepareParameters(ApiMethodDescriptionInterface $apiMethod, array $options)
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setDefaults($apiMethod->getDefaultParameters());
        foreach ($apiMethod->getParametersAllowedTypes() as $option => $types) {
            $optionsResolver->setAllowedTypes($option, $types);
        }
        foreach ($apiMethod->getParametersAllowedValues() as $option => $values) {
            $optionsResolver->setAllowedValues($option, $values);
        }

        return $optionsResolver->resolve($options);
    }

    /**
     * @param ApiHostDescriptionInterface $apiHostDescription
     * @param ApiMethodDescriptionInterface $apiMethod
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function sendRequest(
        ApiHostDescriptionInterface $apiHostDescription,
        ApiMethodDescriptionInterface $apiMethod,
        array $options
    ) {
        $client = new Client(['base_uri' => $apiHostDescription->getUrl()]);
        $request = new Request(
            $apiMethod->getHttpMethod(),
            $apiMethod->getUri()
        );
        $response = $client->send(
            $request,
            [
//                'timeout' => 2,
                'query' => $options,
            ]
        );

        return $response;
    }

    /**
     * @param ApiHostDescriptionInterface $apiHostDescription
     * @param ApiMethodDescriptionInterface $apiMethod
     * @param mixed|\Psr\Http\Message\ResponseInterface $response
     * @return array|mixed|object
     */
    protected function processResponse(
        ApiHostDescriptionInterface $apiHostDescription,
        ApiMethodDescriptionInterface $apiMethod,
        $response
    ) {
        $responseBody = $response->getBody()->getContents();
        if ($processed = $apiHostDescription->preDeserialize($responseBody)) {
            $responseBody = $processed;
        }
        $result = $this->serializer->deserialize(
            $responseBody,
            $apiMethod->getResultModelType(),
            $apiHostDescription->getDataFormat()
        );

        return $result;
    }
}