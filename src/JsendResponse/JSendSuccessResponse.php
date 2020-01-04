<?php

namespace Junker\JsendResponse;

/**
 * Class JSendSuccessResponse
 *
 * JSendSuccessResponse represents an HTTP response in JSON format that follows the JSend specification where the status is "success".
 *
 * @package Junker\JsendResponse
 */
class JSendSuccessResponse extends JsendResponse
{
    /**
     * JSendSuccessResponse constructor.
     *
     * @param null $data
     * @param int $httpStatus
     * @param array $headers
     * @throws Exceptions\JSendSpecificationViolation
     */
    public function __construct($data = null, int $httpStatus = 200, array $headers = [])
    {
        parent::__construct(self::STATUS_SUCCESS, $data, null, null, $httpStatus, $headers);
    }
}
