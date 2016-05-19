<?php
namespace GFB\RestClientBundle;

interface ApiHostDescriptionInterface
{
    const DATA_FORMAT_JSON = 'json';
    const DATA_FORMAT_XML = 'xml';

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return string
     */
    public function getDataFormat();

    /**
     * @param string $content
     * @return string
     */
    public function preDeserialize($content);
}