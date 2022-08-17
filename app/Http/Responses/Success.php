<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class Success extends Base
{

    /**
     * Формирование содержимого ответа.
     *
     * @return array|null
     */
    protected function makeResponseData(): ?array
    {
        return $this-> data ? [
            'data' => $this-> prepareData()
        ] : null;
    }
}
