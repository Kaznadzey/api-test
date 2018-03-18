<?php
declare(strict_types=1);

namespace Application\Service\Api\Action;

/**
 * Class ApiActionRequestDto
 */
class ApiActionRequestDto
{
    /** @var int */
    private $limit;

    /** @var int */
    private $offset;

    /** @var array */
    private $path;

    /** @var array */
    private $params;

    /**
     * @return int
     */
    public function getLimit() : int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffset() : int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return array
     */
    public function getPath() : array
    {
        return $this->path;
    }

    /**
     * @param array $path
     */
    public function setPath(array $path)
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getParams() : array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }
}
