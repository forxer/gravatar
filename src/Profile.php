<?php

namespace forxer\Gravatar;

class Profile extends Gravatar
{
	/**
	 * Build the profile URL based on the provided email address.
	 *
	 * @param string $sEmail       The email to get the gravatar for.
	 * @return string
	 */
	public function getUrl($sEmail)
	{
		return self::URL.$this->getHash($sEmail);
	}

	/**
	 * Return profile data based on the provided email address.
	 *
	 * @param string $sEmail The email to get the gravatar profile for.
	 * @return array
	 */
	public function getData($sEmail)
	{
		$sProfile = file_get_contents($this->getUrl($sEmail).'.php');

		$aProfile = unserialize($sProfile);

		if (is_array($aProfile) && isset($aProfile['entry'])) {
			return $aProfile;
		}
	}

	public function setFormat()
	{

	}
}
