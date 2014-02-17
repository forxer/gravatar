<?php

namespace forxer\Gravatar;

use \InvalidArgumentException;

class Avatar extends Gravatar
{
	const SECURE_URL = 'https://secure.gravatar.com/';

	/**
	 * @var integer The size to use for avatars.
	 */
	protected $iSize = 80;

	/**
	 * @var string The extension to append to the avatars URL.
	 */
	protected $sExtension;

	/**
	 * @var array List of accepted extensions.
	 */
	protected $aValidExtensions = array('jpg', 'jpeg', 'gif', 'png');

	/**
	 * @var string The maximum rating to allow for the avatars.
	 */
	protected $sMaxRating = 'g';

	/**
	 * @var array List of accepted ratings.
	 */
	protected $aValidRatings = array('g', 'pg', 'r', 'x');

	/**
	 * @var string     The default image to use - either a string of
	 *                 the gravatar-recognized default image "type" to use, or a URL
	 */
	protected $sDefaultImage;

	/**
	 * @var array List of accepted gravatar-recognized default image "type".
	 */
	protected $aValidDefaultsImages = array('404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank');

	/**
	 * @var boolean    Should we use the secure (HTTPS) URL base?
	 */
	protected $bUseSecureUrl = false;

	/**
	 * Get the currently set avatar size.
	 *
	 * @return integer The current avatar size in use.
	 */
	public function getSize()
	{
		return $this->iSize;
	}

	/**
	 * Set the avatar size to use.
	 *
	 * @param integer $size    The avatar size to use, must be less than 2048 and greater than 0.
	 * @throws \InvalidArgumentException
	 * @return Avatar The current Avatar instance
	 */
	public function setSize($iSize)
	{
		$iSize = intval($iSize);

		if ($iSize < 0 || $iSize > 2048) {
			throw new InvalidArgumentException('Avatar size must be within 0 pixels and 2048 pixels');
		}

		$this->iSize = $iSize;

		return $this;
	}

	/**
	 * Get the currently set avatar extension.
	 *
	 * @return integer The current avatar extension in use.
	 */
	public function getExtension()
	{
		return $this->sImageExtension;
	}

	/**
	 * Set the avatar extension to use.
	 *
	 * @param string $sExtension      The avatar extension to use ('jpg', 'jpeg', 'gif', 'png').
	 * @throws \InvalidArgumentException
	 * @return Avatar The current Avatar instance
	 */
	public function setExtension($sExtension)
	{
		if (!in_array($sExtension, $this->aValidExtensions)) {
			throw new InvalidArgumentException(sprintf('The extension "%s" is not a valid one, extension image for Gravatar can be: %s', $sExtension, implode(', ', $this->aValidExtensions)));
		}

		$this->sExtension = $sExtension;

		return $this;
	}

	/**
	 * Get the current maximum allowed rating for avatars.
	 *
	 * @return string  The string representing the current maximum allowed rating ('g', 'pg', 'r', 'x').
	 */
	public function getMaxRating()
	{
		return $this->sMaxRating;
	}

	/**
	 * Set the maximum allowed rating for avatars.
	 *
	 * @param string $sRating      The maximum rating to use for avatars ('g', 'pg', 'r', 'x').
	 * @throws \InvalidArgumentException
	 * @return Avatar The current Avatar instance
	 */
	public function setMaxRating($sRating)
	{
		$sRating = strtolower($sRating);

		if (!in_array($sRating, $this->aValidRatings)) {
			throw new InvalidArgumentException(sprintf('Invalid rating "%s" specified, only allowed to be used are: %s', $sRating, implode(', ', $this->aValidRatings)));
		}

		$this->sMaxRating = $sRating;

		return $this;
	}

	/**
	 * Get the current default image setting.
	 *
	 * @return string Default image.
	 */
	public function getDefaultImage()
	{
		return $this->mDefaultImage;
	}

	/**
	 * Set the default image to use for avatars.
	 *
	 * @param string $sImage   The default image to use. Use a valid image URL,
	 *                         or a recognized gravatar "default".
	 * @throws \InvalidArgumentException
	 * @return Avatar The current Avatar instance
	 */
	public function setDefaultImage($sImage)
	{
		$_image = strtolower($sImage);

		if (in_array($_image, $this->aValidDefaultsImages))
		{
			$this->mDefaultImage = $_image;
			return $this;
		}

		if (filter_var($sImage, FILTER_VALIDATE_URL))
		{
			$this->sDefaultImage = rawurlencode($sImage);
			return $this;
		}

		throw new InvalidArgumentException(sprintf('The default image "%s" is not a recognized gravatar "default" and is not a valid URL, default gravatar can be: %s', $sImage, implode(', ', $this->aValidDefaultsImages)));
	}

	/**
	 * Check if we are using the secure protocol for the URLs.
	 *
	 * @return boolean     Are we supposed to use the secure protocol?
	 */
	public function usingSecure()
	{
		return $this->bUseSecureUrl;
	}

	/**
	 * Enable the use of the secure protocol for URLs.
	 *
	 * @return Avatar The current Avatar instance
	 */
	public function enableSecure()
	{
		$this->bUseSecureUrl = true;

		return $this;
	}

	/**
	 * Disable the use of the secure protocol for URLs.
	 *
	 * @return Avatar The current Avatar instance
	 */
	public function disableSecure()
	{
		$this->bUseSecureUrl = false;

		return $this;
	}


	/**
	 * Build the avatar URL based on the provided email address.
	 *
	 * @param string $sEmail       The email to get the gravatar for.
	 * @return string  The URL to the gravatar.
	 */
	public function getAvatarUrl($sEmail)
	{
		if ($this->usingSecure()) {
			$sUrl = self::SECURE_URL . 'avatar/';
		}
		else {
			$sUrl = self::URL . 'avatar/';
		}

		$sUrl .= $this->getHash($sEmail);

		$sUrl .= $this->getExtension();

		$aParams = array();
		$aParams['s'] = $this->getAvatarSize();
		$aParams['r'] = $this->getMaxRating();

		if ($this->getDefaultImage()) {
			$aParams['d'] = $this->getDefaultImage();
		}

		return $sUrl . '?' . http_build_query($aParams, '', '&amp;');;
	}
}
