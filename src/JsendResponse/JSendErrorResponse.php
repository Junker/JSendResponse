<?php

namespace Junker\JsendResponse;

class JSendErrorResponse extends JsendResponse
{
    /**
     * JSendErrorResponse constructor.
     *
     * @param string $message
     * @param int|null $code
     * @param null $data
     * @param int $httpStatus
     * @param array $headers
     * @throws Exceptions\JSendSpecificationViolation
     */
    public function __construct(string $message, int $code = null, $data = null, int $httpStatus = 500, array $headers = [])
    {
        parent::__construct(self::STATUS_ERROR, $data, $message, $code, $httpStatus, $headers);
    }
}
