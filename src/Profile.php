<?php
/*
 * This file is part of forxer\Gravatar.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace forxer\Gravatar;

use Exception\InvalidProfileFormatException;

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
    public function getUrl($sEmail = null)
    {
        if (null !== $sEmail) {
            $this->setEmail($sEmail);
        }

        return static::URL
            . $this->getHash($this->getEmail())
            . (null !== $this->sFormat ? '.' . $this->sFormat : null);
    }

    /**
     * Return the profile URL when this object is printed.
     *
     * @return string The URL to the gravatar.
     */
    public function __toString()
    {
        return $this->getUrl();
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
     * Get or set the profile format to use.
     *
     * @param string $sFormat The profile format to use.
     * @return string|\forxer\Gravatar\Profile
     */
    public function format($sFormat= null)
    {
        if (null === $sFormat) {
            return $this->getFormat();
        }

        return $this->setFormat($sFormat);
    }

    /**
     * Alias for the "format" method.
     *
     * @param string $sFormat
     * @return string|\forxer\Gravatar\Profile
     */
    public function f($sFormat= null)
    {
        return $this->format($sFormat);
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
     * @return \forxer\Gravatar\Profile The current Profile instance
     */
    public function setFormat($sFormat = null)
    {
        if (null === $sFormat) {
            return $this;
        }

        if (!in_array($sFormat, $this->aValidFormats)) {
            $message = sprintf(
                'The format "%s" is not a valid one, profile format for Gravatar can be: %s',
                $sFormat,
                implode(', ', $this->aValidFormats)
            );

            throw new InvalidProfileFormatException($message);
        }

        $this->sFormat = $sFormat;

        return $this;
    }
}
