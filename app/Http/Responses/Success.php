<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class Success extends Base
{
    protected mixed $data;
    public int $statusCode = Response::HTTP_OK;

    /**
     * @inheritDoc
     */
    protected function makeResponseData(): ?array
    {
        return $this->prepareData();
    }
}
