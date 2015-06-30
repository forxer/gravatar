<?php
/*
 * This file is part of forxer\Gravatar.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace forxer\Gravatar;

use \InvalidArgumentException;

class Image extends Gravatar
{
    const SECURE_URL = 'https://secure.gravatar.com/';

    /**
     * @var integer The size to use for avatars.
     */
    protected $iSize;

    /**
     * @var string The default image to use ; either a string of
     *             the gravatar recognized default image "type" to use, or a URL
     */
    protected $sDefaultImage;

    /**
     * @var array List of accepted gravatar recognized default image "type".
     */
    protected $aValidDefaultsImages = ['404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank'];

    /**
     * @var string The maximum rating to allow for the avatars.
     */
    protected $sMaxRating;

    /**
     * @var array List of accepted ratings.
     */
    protected $aValidRatings = ['g', 'pg', 'r', 'x'];

    /**
     * @var string The extension to append to the avatars URL.
     */
    protected $sExtension;

    /**
     * @var array List of accepted extensions.
     */
    protected $aValidExtensions = ['jpg', 'jpeg', 'gif', 'png'];

    /**
     * @var boolean Should we use the secure (HTTPS) URL base?
     */
    protected $bUseSecureUrl = false;

    /**
     * @var boolean Should we force the default image to always load?
     */
    protected $bForceDefault = false;

    /**
     * @var string
     */
    protected $sParamsCache;

    /**
     * Build the avatar URL based on the provided email address.
     *
     * @param string $sEmail The email to get the gravatar for.
     * @return string The URL to the gravatar.
     */
    public function getUrl($sEmail)
    {
        if (null === $this->sParamsCache) {
            $this->sParamsCache = $this->getParams();
        }

        return ($this->usingSecure() ? static::SECURE_URL : static::URL)
            . 'avatar/'
            . static::getHash($sEmail)
            . $this->sParamsCache;
    }

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
     * @param boolean $bForceDefault Force the default image to be always load.
     * @throws \InvalidArgumentException
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function setSize($iSize = null)
    {
        if (null === $iSize) {
            return $this;
        }

        $this->sParamsCache = null;

        $iSize = intval($iSize);

        if ($iSize < 0 || $iSize > 2048) {
            throw new InvalidArgumentException('Avatar size must be within 0 pixels and 2048 pixels');
        }

        $this->iSize = $iSize;

        return $this;
    }

    /**
     * Get the current default image setting.
     *
     * @return string Default image.
     */
    public function getDefaultImage()
    {
        return $this->sDefaultImage;
    }

    /**
     * Set the default image to use for avatars.
     *
     * @param string $sDefaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @throws \InvalidArgumentException
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function setDefaultImage($sDefaultImage = null, $bForce = false)
    {
        if (true === $bForce) {
            $this->enableForceDefault();
        }

        if (null === $sDefaultImage) {
            return $this;
        }

        $this->sParamsCache = null;

        $_image = strtolower($sDefaultImage);

        if (in_array($_image, $this->aValidDefaultsImages))
        {
            $this->sDefaultImage = $_image;
            return $this;
        }

        if (filter_var($sDefaultImage, FILTER_VALIDATE_URL))
        {
            $this->sDefaultImage = rawurlencode($sDefaultImage);
            return $this;
        }

        throw new InvalidArgumentException(
            sprintf(
                'The default image "%s" is not a recognized gravatar "default" and is not a valid URL, default gravatar can be: %s',
                $sDefaultImage,
                implode(', ', $this->aValidDefaultsImages)
            )
        );
    }

    /**
     * Check if we are forcing the default image to be always load.
     *
     * @return boolean Are we forcing the default image?
     */
    public function forcingDefault()
    {
        return $this->bForceDefault;
    }

    /**
     * Force the default image to be always load.
     *
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function enableForceDefault()
    {
        $this->bForceDefault = true;

        return $this;
    }

    /**
     * Do not force the default image to be always load.
     *
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function disableForceDefault()
    {
        $this->bForceDefault = false;

        return $this;
    }

    /**
     * Get the current maximum allowed rating for avatars.
     *
     * @return string The string representing the current maximum allowed rating.
     */
    public function getMaxRating()
    {
        return $this->sMaxRating;
    }

    /**
     * Set the maximum allowed rating for avatars.
     *
     * @param string $sRating The maximum rating to use for avatars.
     * @throws \InvalidArgumentException
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function setMaxRating($sRating = null)
    {
        if (null === $sRating) {
            return $this;
        }

        $this->sParamsCache = null;

        $sRating = strtolower($sRating);

        if (!in_array($sRating, $this->aValidRatings))
        {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid rating "%s" specified, only allowed to be used are: %s',
                    $sRating,
                    implode(', ', $this->aValidRatings)
                )
            );
        }

        $this->sMaxRating = $sRating;

        return $this;
    }

    /**
     * Get the currently set avatar extension.
     *
     * @return integer The current avatar extension in use
     */
    public function getExtension()
    {
        return $this->sImageExtension;
    }

    /**
     * Set the avatar extension to use.
     *
     * @param string $sExtension The avatar extension to use.
     * @throws \InvalidArgumentException
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function setExtension($sExtension = null)
    {
        if (null === $sExtension) {
            return $this;
        }

        $this->sParamsCache = null;

        if (!in_array($sExtension, $this->aValidExtensions))
        {
            throw new InvalidArgumentException(
                sprintf(
                    'The extension "%s" is not a valid one, extension image for Gravatar can be: %s',
                    $sExtension,
                    implode(', ', $this->aValidExtensions)
                )
            );
        }

        $this->sExtension = $sExtension;

        return $this;
    }

    /**
     * Check if we are using the secure protocol for the URLs.
     *
     * @return boolean Are we supposed to use the secure protocol?
     */
    public function usingSecure()
    {
        return $this->bUseSecureUrl;
    }

    /**
     * Enable the use of the secure protocol for URLs.
     *
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function enableSecure()
    {
        $this->bUseSecureUrl = true;

        return $this;
    }

    /**
     * Disable the use of the secure protocol for URLs.
     *
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function disableSecure()
    {
        $this->bUseSecureUrl = false;

        return $this;
    }

    /**
     * Compute params according to current settings.
     *
     * @return string
     */
    protected function getParams()
    {
        $aParams = [];

        if (null !== $this->getSize()) {
            $aParams['s'] = $this->getSize();
        }

        if (null !== $this->getDefaultImage()) {
            $aParams['d'] = $this->getDefaultImage();
        }

        if (null !== $this->getMaxRating()) {
            $aParams['r'] = $this->getMaxRating();
        }

        if ($this->forcingDefault()) {
            $aParams['f'] = 'y';
        }

        return (null !== $this->sExtension ? '.'.$this->sExtension : '')
            .(!empty($aParams) ? '?' . http_build_query($aParams, '', '&amp;') : '');
    }
}
