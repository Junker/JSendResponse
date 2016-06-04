<?php

namespace Junker\Symfony;

use Symfony\Component\HttpFoundation\JsonResponse;

class JSendResponse extends JsonResponse
{
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';
    const STATUS_ERROR = 'error';


    public function __construct($status, $data = null, $message = null, $code = null, $http_status = 200, $headers = array())
    {
        if ($status != self::STATUS_SUCCESS && $status != self::STATUS_FAIL &&  $status != self::STATUS_ERROR)
            throw new \InvalidArgumentException('The status is not valid');

        $jsend_data = new \ArrayObject();

        $jsend_data['status'] = $status;


        if ($data !== null)
        {
            $jsend_data['data'] = $data;
        }

        if ($status == self::STATUS_SUCCESS || $status == self::STATUS_FAIL)
        {
            if (!isset($jsend_data['data']))
                $jsend_data['data'] = null;

        }
        elseif ($status == self::STATUS_ERROR)
        {
            if (!$message)
                throw new \InvalidArgumentException('The message is required');

            if ($message && !is_string($message))
                throw new \InvalidArgumentException('The message is not valid, string required');

            if ($code)
            {
                if (!is_int($code))
                    throw new \InvalidArgumentException('The code is not valid, integer required.');

                $jsend_data['code'] = $code;
            }


            $jsend_data['message'] = $message;
        }

        parent::__construct($jsend_data, $http_status, $headers);
    }

    public function setStatus($status)
    {
        if ($status != self::STATUS_SUCCESS && $status != self::STATUS_FAIL &&  $status != self::STATUS_ERROR)
            throw new \InvalidArgumentException('The status is not valid');

        $jsend_data = json_decode($this->data);

        $jsend_data['status'] = $status;

        $this->setData($jsend_data); 
    }

    public function setJSendData($data = null)
    {
       $jsend_data = json_decode($this->data);

       $jsend_data['data'] = $data;

       $this->setData($jsend_data); 
    }

    public function setMessage($message)
    {
        if (!is_string($message))
            throw new \InvalidArgumentException('The message is not valid');

        $jsend_data = json_decode($this->data);

        $jsend_data['message'] = $message;

        $this->setData($jsend_data);
    }

    public function setCode($code)
    {
        if (!is_int($code))
            throw new \InvalidArgumentException('The message is not valid');

        $jsend_data = json_decode($this->data);

        $jsend_data['code'] = $code;

        $this->setData($jsend_data);
    }

}