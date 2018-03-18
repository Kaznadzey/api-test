<?php
declare(strict_types=1);

namespace Application\Service\Api\Action;

use Application\Service\Config\ResponseStatus;

/**
 * Class AbstractApiAction
 */
abstract class AbstractApiAction
{
    /**
     * This method must provide different params or data validation according to query actions.
     *
     * @param ApiActionRequestDto $actionRequestDto
     */
    public function run(ApiActionRequestDto $actionRequestDto)
    {
        $this->runAction($actionRequestDto);
    }

    /**
     * @param ApiActionRequestDto $actionRequestDto
     *
     * @return mixed
     */
    abstract protected function runAction(ApiActionRequestDto $actionRequestDto);

    /**
     * @param int    $limit
     * @param int    $offset
     * @param string $rowsKey
     * @param array  $rows
     *
     * @return array
     */
    protected function buildResponseData(int $limit, int $offset, string $rowsKey, array $rows = [])
    {
        return [
            $rowsKey => $rows,
            'limit'  => $limit,
            'offset' => $offset,
            'rows'   => count($rows),
        ];
    }

    /**
     * @param string $message
     * @param array  $data
     */
    protected function sentSuccessResponse(string $message, array $data = [])
    {
        $this->sendResponse(
            [
                'status'  => ResponseStatus::OK,
                'message' => $message,
                'data'    => $data,
            ]
        );
    }

    /**
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    protected function sentFailResponse(string $message, array $data = [])
    {
        $this->sendResponse(
            [
                'status'  => ResponseStatus::FAIL,
                'message' => $message,
                'data'    => $data,
            ]
        );
    }

    /**
     * @param array $data
     */
    private function sendResponse(array $data)
    {
        echo json_encode($data);
        die();
    }
}
