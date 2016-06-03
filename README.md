# JSendResponse
JSendResponse Component for HttpFoundation based frameworks (Symfony, Silex, Drupal etc.)

##Installation
The best way to install JSendResponse is to use a [Composer](https://getcomposer.org/download):

    php composer.phar require junker/symfony-jsend-response

## Examples

```php
use Junker\Symfony\JSendResponse;
use Junker\Symfony\JSendSuccessResponse;
use Junker\Symfony\JSendFailResponse;
use Junker\Symfony\JSendErrorResponse;


class AppController
{
	...

	$data = ['id' => 50, 'name' => 'Waldemar'];
	$message = 'Error, total error!';
	$code = 5;

	return new JsendResponse(JSendResponse::STATUS_SUCCESS, $data, NULL, NULL);
#or
	return new JsendResponse(JSendResponse::STATUS_FAIL, $data, NULL, NULL);
#or 
	return new JsendResponse(JSendResponse::STATUS_ERROR, NULL, $message, $code);
#or
	return new JsendResponse(JSendResponse::STATUS_ERROR, NULL, $message, $code);
#or
	return new JsendSuccessResponse($data);
#or
	return new JsendFailResponse($data);
#or
	return new JsendErrorResponse($message);
#or
	return new JsendErrorResponse($message, $code, $data);

}

```

