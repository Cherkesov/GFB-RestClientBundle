<?php
namespace GFB\RestClientBundle\Service;

use GFB\RestClientBundle\ApiHostDescriptionInterface;
use GFB\RestClientBundle\ApiMethodDescriptionInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\Serializer;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestClientBase
{
    /** @var Serializer */
    private $serializer;

    /** @var Logger */
    private $logger;

    /**
     * RequestHttpClient constructor.
     * @param Serializer $serializer
     * @param Logger $logger
     */
    public function __construct(Serializer $serializer, Logger $logger)
    {
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    /**
     * @param ApiHostDescriptionInterface $apiHostDescription
     * @param ApiMethodDescriptionInterface $apiMethod
     * @param array $options
     * @param null $body
     * @return null
     */
    public function run(
        ApiHostDescriptionInterface $apiHostDescription,
        ApiMethodDescriptionInterface $apiMethod,
        array $options,
        $body = null
    ) {
        $options = $this->prepareParameters($apiMethod, $options);
        $response = $this->sendRequest($apiHostDescription, $apiMethod, $options, $body);
        $result = $this->processResponse($apiHostDescription, $apiMethod, $response);

        return $result;
    }

    /**
     * @param ApiMethodDescriptionInterface $apiMethod
     * @param array $queryParams
     * @return array
     */
    protected function prepareParameters(ApiMethodDescriptionInterface $apiMethod, array $queryParams)
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setDefaults($apiMethod->getDefaultParameters());
        foreach ($apiMethod->getParametersAllowedTypes() as $option => $types) {
            $optionsResolver->setAllowedTypes($option, $types);
        }
        foreach ($apiMethod->getParametersAllowedValues() as $option => $values) {
            $optionsResolver->setAllowedValues($option, $values);
        }

        return $optionsResolver->resolve($queryParams);
    }

    /**
     * @param ApiHostDescriptionInterface $apiHost
     * @param ApiMethodDescriptionInterface $apiMethod
     * @param array $options
     * @param $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function sendRequest(
        ApiHostDescriptionInterface $apiHost,
        ApiMethodDescriptionInterface $apiMethod,
        array $options,
        $body
    ) {
        $client = new Client(['base_uri' => $apiHost->getUrl()]);
        $request = new Request(
            $apiMethod->getHttpMethod(),
            $apiMethod->getUri()
        );
        $response = $client->send(
            $request,
            [
                'query' => $options,
                'body' => (null != $body) ?
                    $this->serializer->serialize($body, $apiHost->getDataFormat()) :
                    null,
            ]
        );

        $this->logger->info(
            sprintf(
                '%s - %s    |=>    %s',
                $apiHost->getUrl() . $request->getUri(),
                http_build_query($options, null, ', '),
                $response->getBody()->getContents()
            ),
            array(
                $response->getStatusCode(),
                $response->getReasonPhrase(),
            )
        );
        $response->getBody()->rewind();

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
        $content = $response->getBody()->getContents();
        $response->getBody()->rewind();

        $processed = $apiHostDescription->preDeserialize($content);

        $result = $this->serializer->deserialize(
            $processed,
            $apiMethod->getResultModelType(),
            $apiHostDescription->getDataFormat()
        );

        return $result;
    }
}