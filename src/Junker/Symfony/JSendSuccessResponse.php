<?php

namespace Junker\Symfony;

use Junker\Symfony\JSendResponse;

class JSendSuccessResponse extends JsendResponse
{
	public function __construct($data = null, $http_status = 200, $headers = array())
	{
		parent::__construct(self::STATUS_SUCCESS, $data, NULL, NULL, $http_status, $headers);
	}
}