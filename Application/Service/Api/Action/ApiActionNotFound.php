<?php
declare(strict_types=1);

namespace Application\Service\Api\Action;

use Application\Service\Config\ResponseMessage;

/**
 * Class ApiActionNotFound
 */
class ApiActionNotFound extends AbstractApiAction
{
    /**
     * @param ApiActionRequestDto $actionRequestDto
     */
    protected function runAction(ApiActionRequestDto $actionRequestDto)
    {
        $this->sentFailResponse(
            ResponseMessage::NOT_FOUND,
            []
        );
    }
}
