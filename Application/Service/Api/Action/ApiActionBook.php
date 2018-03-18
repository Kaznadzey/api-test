<?php
declare(strict_types=1);

namespace Application\Service\Api\Action;

use Application\Service\Config\ResponseMessage;

/**
 * Class ApiActionBook
 */
class ApiActionBook extends AbstractApiAction
{
    /**
     * @param ApiActionRequestDto $actionRequestDto
     *
     * @throws \InvalidArgumentException
     */
    protected function runAction(ApiActionRequestDto $actionRequestDto)
    {
        $path = $actionRequestDto->getPath();

        switch ($path[0]) {
            case 'books':
                $this->processBooksRequest($actionRequestDto->getLimit(), $actionRequestDto->getOffset());
                break;
            default:
                $this->sentFailResponse(
                    ResponseMessage::INVALID_REQUEST,
                    []
                );
        }
    }

    /**
     * @param int $limit
     * @param int $offset
     */
    private function processBooksRequest(int $limit, int $offset)
    {
        $this->sentSuccessResponse(
            ResponseMessage::OK,
            $this->buildResponseData(
                $limit,
                $offset,
                'books',
                $this->createBooksArray(2)
            )
        );
    }

    /**
     * Method only for test
     *
     * @param int $limit
     *
     * @return array
     */
    private function createBooksArray(int $limit)
    {
        $books = [];
        for ($i = 0; $i < $limit; $i++) {
            $books[] = [
                'id' => $i + 1,
                'title' => 'Title ' . $i,
                'author' => [
                    'id' => $i,
                    'name' => 'Author ' . $i,
                ]
            ];
        }

        return $books;
    }
}
