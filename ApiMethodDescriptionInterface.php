<?php
namespace GFB\RestClientBundle;

interface ApiMethodDescriptionInterface
{
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_PATCH = 'PATCH';
    const HTTP_METHOD_DELETE = 'DELETE';

    /**
     * @return string
     */
    public function getHttpMethod();

    /**
     * @return string
     */
    public function getUri();

    /**
     * @return array
     */
    public function getDefaultParameters();

    /**
     * @return array
     */
    public function getParametersAllowedTypes();

    /**
     * @return array
     */
    public function getParametersAllowedValues();

    /**
     * @return string
     */
    public function getResultModelType();
}