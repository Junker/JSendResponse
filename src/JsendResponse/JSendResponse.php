<?php

namespace Junker\JsendResponse;

use ArrayObject;
use Junker\JsendResponse\Exceptions\JSendSpecificationViolation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class JSendResponse
 *
 * JSendResponse represents an HTTP response in JSON format that follows the JSend specification.
 *
 * @package Junker\JsendResponse
 */
class JSendResponse extends JsonResponse
{
    /**
     * Should be used to set the status as "success".
     */
    const STATUS_SUCCESS = 'success';

    /**
     * Should be used to set the status as "fail".
     */
    const STATUS_FAIL = 'fail';

    /**
     * Should be used to set the status as "error".
     */
    const STATUS_ERROR = 'error';

    /**
     * JSendResponse constructor.
     *
     * @param string $status
     * @param null $data
     * @param string|null $message
     * @param int|null $code
     * @param int $httpStatus
     * @param array $headers
     * @throws JSendSpecificationViolation
     */
    public function __construct(string $status, $data = null, string $message = null, int $code = null, int $httpStatus = 200, array $headers = [])
    {
        // ensures that the passed JSend status is valid
        if (!$this->isStatusValid($status)) {
            throw new JSendSpecificationViolation('The passed "status" is not valid: ' . $status);
        }

        $jsend = new ArrayObject();

        $jsend['status'] = $status;

        // the "data" key is required for this status
        if ($status === self::STATUS_SUCCESS) {
            $jsend['data'] = $data;
        }

        // the "data" key is optional for these statuses so we only add it if set
        if (isset($data) && ($status === self::STATUS_FAIL || $status === self::STATUS_ERROR)) {
            $jsend['data'] = $data;
        }

        if ($status === self::STATUS_ERROR) {
            // ensures that "message" is set for this status
            if (!$message) {
                throw new JSendSpecificationViolation('The "message" key is required');
            }

            $jsend['message'] = $message;

            // adds the "code" key only if it's set (because it's optional)
            if ($code) {
                $jsend['code'] = $code;
            }
        }

        parent::__construct($jsend, $httpStatus, $headers);
    }

    /**
     * Validates the JSend status.
     *
     * @param string $status
     * @return bool
     */
    private function isStatusValid(string $status): bool
    {
        $validStatuses = [self::STATUS_SUCCESS, self::STATUS_FAIL, self::STATUS_ERROR];

        return in_array($status, $validStatuses);
    }

    /**
     * Sets the response status (success, fail or error).
     *
     * @param $status
     * @return JSendResponse
     * @throws JSendSpecificationViolation
     */
    public function setStatus($status): self
    {
        // ensures that the passed JSend status is valid
        if (!$this->isStatusValid($status)) {
            throw new JSendSpecificationViolation('The passed "status" is not valid: ' . $status);
        }

        $jsend = json_decode($this->data, true);

        $jsend['status'] = $status;

        $this->setData($jsend);

        return $this;
    }

    /**
     * Sets the JSend data.
     *
     * @param null $data
     * @return JSendResponse
     */
    public function setJSendData($data = null): self
    {
        $jsend = json_decode($this->data, true);

        $jsend['data'] = $data;

        $this->setData($jsend);

        return $this;
    }

    /**
     * Sets the message.
     *
     * @param string $message
     * @return JSendResponse
     * @throws JSendSpecificationViolation
     */
    public function setMessage(string $message): self
    {
        $jsend = json_decode($this->data, true);

        // ensures that the status is "error"
        if ($jsend['status'] !== self::STATUS_ERROR) {
            throw new JSendSpecificationViolation('The "message" key is not allowed for responses with a status other than "error"');
        }

        $jsend['message'] = $message;

        $this->setData($jsend);

        return $this;
    }

    /**
     * Sets the code.
     *
     * @param int $code
     * @return JSendResponse
     * @throws JSendSpecificationViolation
     */
    public function setCode(int $code): self
    {
        $jsend = json_decode($this->data, true);

        // ensures that the status is "error"
        if ($jsend['status'] !== self::STATUS_ERROR) {
            throw new JSendSpecificationViolation('The "code" key is not allowed for responses with a status other than "error"');
        }

        $jsend['code'] = $code;

        $this->setData($jsend);

        return $this;
    }
}
