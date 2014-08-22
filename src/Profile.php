<?php
/*
 * This file is part of forxer\Gravatar.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace forxer\Gravatar;

use \InvalidArgumentException;

class Profile extends Gravatar
{
	/**
	 * @var string The format to append to the profile URL.
	 */
	protected $sFormat;

	/**
	 * @var array List of accepted format.
	 */
	protected $aValidFormats = ['json', 'xml', 'php', 'vcf', 'qr'];

	/**
	 * Build the profile URL based on the provided email address.
	 *
	 * @param string $sEmail The email to get the gravatar profile for
	 * @return string
	 */
	public function getUrl($sEmail)
	{
		return static::URL . static::getHash($sEmail)
			. (null !== $this->sFormat ? '.' . $this->sFormat : null);
	}

	/**
	 * Return profile data based on the provided email address.
	 *
	 * @param string $sEmail The email to get the gravatar profile for
	 * @return array
	 */
	public function getData($sEmail)
	{
		$this->sFormat = 'php';

		$sProfile = file_get_contents($this->getUrl($sEmail));

		$aProfile = unserialize($sProfile);

		if (is_array($aProfile) && isset($aProfile['entry'])) {
			return $aProfile;
		}
	}

	/**
	 * Get the currently set profile format.
	 *
	 * @return integer The current profile format in use
	 */
	public function getFormat()
	{
		return $this->sFormat;
	}

	/**
	 * Set the profile format to use.
	 *
	 * @param string $sFormat The profile format to use
	 * @throws \InvalidArgumentException
	 * @return Profile The current Profile instance
	 */
	public function setFormat($sFormat = null)
	{
		if (null === $sFormat) {
			return $this;
		}

		if (!in_array($sFormat, $this->aValidFormats))
		{
			throw new InvalidArgumentException(
				sprintf(
					'The format "%s" is not a valid one, profile format for Gravatar can be: %s',
					$sFormat,
					implode(', ', $this->aValidFormats)
				)
			);
		}

		$this->sFormat = $sFormat;

		return $this;
	}
}
