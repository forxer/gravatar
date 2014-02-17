<?php

namespace forxer\Gravatar;

class Gravatar
{
	const URL = 'http://www.gravatar.com/';

	/**
	 * Get the email hash to use (after cleaning the string).
	 *
	 * @param string $sEmail The email to get the hash for.
	 * @return string  The hashed form of the email.
	 */
	public function getHash($sEmail)
	{
		return md5(strtolower(trim($sEmail)));
	}
}
