<?php
declare(strict_types=1);

namespace Application\Service\Api\Action;

use Application\Service\Config\ResponseMessage;

/**
 * Class ApiActionAuthor
 */
class ApiActionAuthor extends AbstractApiAction
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
            case 'authors':
                if (!empty($path[2])) {
                    $authorId = (int) ($path[1] ?? 0);
                    switch ($path[2]) {
                        case 'books':
                            $this->processAuthorBooksRequest(
                                $authorId,
                                $actionRequestDto->getLimit(),
                                $actionRequestDto->getOffset()
                            );
                            break;
                        default:
                            $this->sentFailResponse(
                                ResponseMessage::INVALID_REQUEST,
                                []
                            );
                    }
                } else {
                    $this->processAuthorsRequest($actionRequestDto->getLimit(), $actionRequestDto->getOffset());
                }
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
    private function processAuthorsRequest(int $limit, int $offset)
    {
        $this->sentSuccessResponse(
            ResponseMessage::OK,
            $this->buildResponseData(
                $limit,
                $offset,
                'authors',
                $this->createAuthorsArray(2)
            )
        );
    }

    private function processAuthorBooksRequest(int $authorId, int $limit, int $offset)
    {
        if ($authorId <= 0) {
           $this->sentFailResponse(
                ResponseMessage::INVALID_REQUEST
            );
        } else {
            $this->sentSuccessResponse(
                ResponseMessage::OK,
                $this->buildResponseData(
                    $limit,
                    $offset,
                    'books',
                    $this->createAuthorBooksArray($authorId, $limit)
                )
            );
        }
    }

    /**
     * Method only for test
     *
     * @param int $limit
     *
     * @return array
     */
    private function createAuthorsArray(int $limit)
    {
        $authors = [];
        for ($i = 0; $i < $limit; $i++) {
            $authors[] = [
                'id' => $i,
                'name' => 'Author ' . $i,
            ];
        }

        return $authors;
    }

    /**
     * @param int $authorId
     * @param int $limit
     *
     * @return array
     */
    private function createAuthorBooksArray(int $authorId, int $limit)
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
