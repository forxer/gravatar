<?php
/*
 * This file is part of forxer\Gravatar.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace forxer\Gravatar;

class Gravatar
{
	const URL = 'http://www.gravatar.com/';

	/**
	 * Return the avatar URL based on the provided email address.
	 *
	 * @param string $iSize
	 * @param string $sImage
	 * @param string $sRating
	 * @param string $sExtension
	 * @param boolean $bSecure
	 * @return string  The URL to the gravatar.
	 */
	public static function avatar($sEmail, $iSize = null, $sImage = null, $sRating = null, $sExtension = null, $bSecure = false)
	{
		$avatar = new Avatar();

		$avatar
			->setSize($iSize)
			->setDefaultImage($sImage)
			->setMaxRating($sRating)
			->setExtension($sExtension);

		if ($bSecure) {
			$avatar->enableSecure();
		}

		return $avatar->getUrl($sEmail);
	}

	public static function profile($sEmail, $sFormat = null)
	{
		$profil = new Profile();

		$profil->setFormat($sFormat);

		return $profil->getUrl($sEmail);
	}

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
