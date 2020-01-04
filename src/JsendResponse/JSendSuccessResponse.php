<?php

namespace Junker\JsendResponse;

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
    public function __construct($data = null, $httpStatus = 200, $headers = [])
    {
        parent::__construct(self::STATUS_SUCCESS, $data, null, null, $httpStatus, $headers);
    }
}
