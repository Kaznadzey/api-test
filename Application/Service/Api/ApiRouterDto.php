<?php
declare(strict_types=1);

namespace Application\Service\Api;

/**
 * Class ApiRouterDto
 */
class ApiRouterDto
{
    /** @var string */
    private $requestUri;

    /** @var int */
    private $requestMethod;

    /** @var array */
    private $requestParams;

    /**
     * @return string
     */
    public function getRequestUri() : string
    {
        return $this->requestUri;
    }

    /**
     * @param string $requestUri
     */
    public function setRequestUri(string $requestUri)
    {
        $this->requestUri = $requestUri;
    }

    /**
     * @return int
     */
    public function getRequestMethod() : int
    {
        return $this->requestMethod;
    }

    /**
     * @param int $requestMethod
     */
    public function setRequestMethod(int $requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    /**
     * @return array
     */
    public function getRequestParams() : array
    {
        return $this->requestParams;
    }

    /**
     * @param array $requestParams
     */
    public function setRequestParams(array $requestParams)
    {
        $this->requestParams = $requestParams;
    }
}
