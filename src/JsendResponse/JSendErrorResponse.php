<?php

namespace Junker\JsendResponse;

class JSendErrorResponse extends JsendResponse
{
    /**
     * JSendErrorResponse constructor.
     *
     * @param null $message
     * @param null $code
     * @param null $data
     * @param int $httpStatus
     * @param array $headers
     * @throws Exceptions\JSendSpecificationViolation
     */
    public function __construct($message = null, $code = null, $data = null, $httpStatus = 500, $headers = [])
    {
        parent::__construct(self::STATUS_ERROR, $data, $message, $code, $httpStatus, $headers);
    }
}
