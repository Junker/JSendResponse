<?php

namespace KZP;

use KZP\JSendResponse;

class JSendErrorResponse extends JsendResponse
{
	public function __construct($message = null, $code = null, $data = null, $http_status = 200, $headers = array())
	{
		parent::__construct(self::STATUS_ERROR, $data, $message, $code, $http_status, $headers);
	}
}