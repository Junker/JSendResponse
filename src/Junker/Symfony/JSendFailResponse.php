<?php

namespace Junker\Symfony;

use Junker\Symfony\JSendResponse;

class JSendFailResponse extends JsendResponse
{
	public function __construct($data = null, $http_status = 200, $headers = array())
	{
		parent::__construct(self::STATUS_FAIL, $data, NULL, NULL, $http_status, $headers);
	}
}