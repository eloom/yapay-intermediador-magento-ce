<?php

/**
 * Class Status
 * @package Yapay\Enum\Http
 */
class Eloom_Yapay_Enum_Http_Status extends Eloom_Yapay_Enum_Enum {

	/**
	 * Http Method 200 - OK.
	 */
	const OK = 200;

	/**
	 * Http Method 201 - Created.
	 */
	const CREATED = 201;

	/**
	 * Http Method 400 - Bad request.
	 */
	const BAD_REQUEST = 400;

	/**
	 * Http Method 401 - Unauthorized.
	 */
	const UNAUTHORIZED = 401;

	/**
	 * Http Method 403 - Forbidden.
	 */
	const FORBIDDEN = 403;

	/**
	 * Http Method 404 - Not found.
	 */
	const NOT_FOUND = 404;

	/**
	 * Http Method 422 - Unprocessable Entity
	 */
	const UNPROCESSABLE_ENTITY = 422;

	/**
	 * Http Method 500 - Internal server error.
	 */
	const INTERNAL_SERVER_ERROR = 500;

	/**
	 * Http Method 502 - Bad gateway.
	 */
	const BAD_GATEWAY = 502;

}
