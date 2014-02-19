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
	 * Return the Gravatar image URL based on the provided email address.
	 *
	 * @param string $sEmail The email to get the gravatar for.
	 * @param string $iSize The avatar size to use, must be less than 2048 and greater than 0.
	 * @param string $sDefaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
	 * @param string $sRating The maximum rating to use for avatars
	 * @param string $sExtension The avatar extension to use
	 * @param boolean $bSecure Enable the use of the secure protocol for URLs.
	 * @return string  The URL to the gravatar.
	 */
	public static function image($sEmail, $iSize = null, $sDefaultImage = null, $sRating = null, $sExtension = null, $bSecure = false)
	{
		$avatar = new Avatar();

		$avatar
			->setSize($iSize)
			->setDefaultImage($sDefaultImage)
			->setMaxRating($sRating)
			->setExtension($sExtension);

		if ($bSecure) {
			$avatar->enableSecure();
		}

		return $avatar->getUrl($sEmail);
	}

	/**
	 * Return the Gravatar profile URL based on the provided email address.
	 *
	 * @param string $sEmail The email to get the gravatar for
	 * @param string $sFormat The profile format to use
	 * @return string
	 */
	public static function profile($sEmail, $sFormat = null)
	{
		$profil = new Profile();

		$profil->setFormat($sFormat);

		return $profil->getUrl($sEmail);
	}

	/**
	 * Get the email hash to use (after cleaning the string).
	 *
	 * @param string $sEmail The email to get the hash for
	 * @return string  The hashed form of the email
	 */
	protected function getHash($sEmail)
	{
		return md5(strtolower(trim($sEmail)));
	}
}
