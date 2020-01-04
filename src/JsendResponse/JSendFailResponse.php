<?php

namespace Junker\JsendResponse;

/**
 * Class JSendFailResponse
 *
 * JSendFailResponse represents an HTTP response in JSON format that follows the JSend specification where the status is "fail".
 *
 * @package Junker\Symfony
 */
class JSendFailResponse extends JsendResponse
{
    /**
     * JSendFailResponse constructor.
     *
     * @param null $data
     * @param int $httpStatus
     * @param array $headers
     * @throws Exceptions\JSendSpecificationViolation
     */
    public function __construct($data = null, int $httpStatus = 200, array $headers = [])
    {
        parent::__construct(self::STATUS_FAIL, $data, null, null, $httpStatus, $headers);
    }
}
