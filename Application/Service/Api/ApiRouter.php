<?php
declare(strict_types=1);

namespace Application\Service\Api;

use Application\Service\Api\Action\AbstractApiAction;
use Application\Service\Api\Action\ApiActionAuthor;
use Application\Service\Api\Action\ApiActionBook;
use Application\Service\Api\Action\ApiActionRequestDto;

/**
 * Class ApiRouter
 */
class ApiRouter
{
    const DEFAULT_LIMIT = 1000;

    /**
     * @param ApiRouterDto $apiRouterDto
     *
     * @throws \DomainException
     */
    public function run(ApiRouterDto $apiRouterDto)
    {
        $action              = $this->detectAction($apiRouterDto->getRequestUri());
        $apiActionRequestDto = $this->createApiActionRequestDto($apiRouterDto);

        $action->run($apiActionRequestDto);
    }

    /**
     * @param string $requestUri
     *
     * @return AbstractApiAction
     * @throws \DomainException
     */
    private function detectAction(string $requestUri) : AbstractApiAction
    {
        $parsedUrl = parse_url($requestUri);
        $path      = $this->getPathAsArray($parsedUrl['path'] ?? '');

        switch ($path[0] ?? '') {
            case 'books':
                return new ApiActionBook();
                break;
            case 'authors':
                return new ApiActionAuthor();
                break;
            default:
                throw new \DomainException('Your request is invalid!');
        }
    }

    /**
     * @param ApiRouterDto $apiRouterDto
     *
     * @return ApiActionRequestDto
     */
    private function createApiActionRequestDto(ApiRouterDto $apiRouterDto)
    {
        $apiActionRequestDto = new ApiActionRequestDto();

        $parsedUrl = parse_url($apiRouterDto->getRequestUri());
        $apiActionRequestDto->setPath($this->getPathAsArray($parsedUrl['path'] ?? ''));

        $requestParams = $apiRouterDto->getRequestParams();

        $apiActionRequestDto->setLimit((int) ($requestParams['limit'] ?? self::DEFAULT_LIMIT));
        $apiActionRequestDto->setOffset((int) ($requestParams['offset'] ?? 0));

        $apiActionRequestDto->setParams($apiRouterDto->getRequestParams());

        return $apiActionRequestDto;
    }

    /**
     * @param string $path
     *
     * @return array
     */
    private function getPathAsArray(string $path) : array
    {
        return array_values(array_filter(explode('/', $path)));
    }
}
