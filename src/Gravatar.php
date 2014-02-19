<?php
/*
 * This file is part of forxer\Gravatar.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace forxer\Gravatar;

use forxer\Gravatar\Image as GravatarImage;
use forxer\Gravatar\Profile as GravatarProfile;

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
		$gravatarImage = new GravatarImage();

		$gravatarImage
			->setSize($iSize)
			->setDefaultImage($sDefaultImage)
			->setMaxRating($sRating)
			->setExtension($sExtension);

		if ($bSecure) {
			$gravatarImage->enableSecure();
		}

		return $gravatarImage->getUrl($sEmail);
	}

	/**
	 * Return multiples Gravatar images URL based on the provided array of emails addresses.
	 *
	 * @param array $aEmail The emails list to get the Gravatar images for
	 * @param string $iSize The avatar size to use, must be less than 2048 and greater than 0
	 * @param string $sDefaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default"
	 * @param string $sRating The maximum rating to use for avatars
	 * @param string $sExtension The avatar extension to use
	 * @param boolean $bSecure Enable the use of the secure protocol for URLs
	 * @return array The list of URL to the Gravatar images
	 */
	public static function images(array $aEmail, $iSize = null, $sDefaultImage = null, $sRating = null, $sExtension = null, $bSecure = false)
	{
		$gravatarImage = new GravatarImage();

		$gravatarImage
			->setSize($iSize)
			->setDefaultImage($sDefaultImage)
			->setMaxRating($sRating)
			->setExtension($sExtension);

		if ($bSecure) {
			$gravatarImages->enableSecure();
		}

		$aUrls = array();

		foreach ($aEmail as $sEmail) {
			$aUrls[$sEmail] = $gravatarImage->getUrl($sEmail);
		}

		return $aUrls;
	}

	/**
	 * Return the Gravatar profile URL based on the provided email address.
	 *
	 * @param string $sEmail The email to get the Gravatar profile for
	 * @param string $sFormat The profile format to use
	 * @return string
	 */
	public static function profile($sEmail, $sFormat = null)
	{
		$gravatarProfile = new GravatarProfile();

		$gravatarProfile->setFormat($sFormat);

		return $gravatarProfile->getUrl($sEmail);
	}

	/**
	 * Return multiples Gravatar profiles URL based on the provided array of emails addresses.
	 *
	 * @param array $aEmail The emails list to get the Gravatar profiles for
	 * @param string $sFormat The profile format to use
	 * @return array The list of URL to the Gravatar profiles
	 */
	public static function profiles(array $aEmail, $sFormat = null)
	{
		$gravatarProfil = new GravatarProfile();

		$gravatarProfil->setFormat($sFormat);

		$aUrls = array();

		foreach ($aEmail as $sEmail) {
			$aUrls[$sEmail] = $gravatarProfil->getUrl($sEmail);
		}

		return $aUrls;
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
