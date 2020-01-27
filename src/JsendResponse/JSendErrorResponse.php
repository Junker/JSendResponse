<?php

namespace Junker\JsendResponse;

/**
 * Class JSendErrorResponse
 *
 * JSendErrorResponse represents an HTTP response in JSON format that follows the JSend specification where the status is "error".
 *
 * @package Junker\JsendResponse
 */
class JSendErrorResponse extends JSendResponse
{
    /**
     * JSendErrorResponse constructor.
     *
     * @param string $message
     * @param int|null $code
     * @param mixed $data
     * @param int $httpStatus
     * @param array $headers
     * @throws Exceptions\JSendSpecificationViolation
     */
    public function __construct(string $message, int $code = null, $data = null, int $httpStatus = 500, array $headers = [])
    {
        parent::__construct(self::STATUS_ERROR, $data, $message, $code, $httpStatus, $headers);
    }
}
