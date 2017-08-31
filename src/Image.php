<?php
/*
 * This file is part of forxer\Gravatar.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace forxer\Gravatar;

use Exception\InvalidDefaultImageException;
use Exception\InvalidImageExtensionException;
use Exception\InvalidImageSizeException;
use Exception\InvalidMaxRatingImageException;

class Image extends Gravatar
{
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
     * @var boolean Should we force the default image to always load?
     */
    protected $bForceDefault = false;

    /**
     * Build the avatar URL based on the provided email address.
     *
     * @param string $sEmail The email to get the gravatar for.
     * @return string The URL to the gravatar.
     */
    public function getUrl($sEmail = null)
    {
        if (null !== $sEmail) {
            $this->setEmail($sEmail);
        }

        return static::URL
            .'avatar/'
            .$this->getHash($this->getEmail())
            .$this->getParams();
    }

    /**
     * Return the avatar URL when this object is printed.
     *
     * @return string The URL to the gravatar.
     */
    public function __toString()
    {
        return $this->getUrl();
    }

    /**
     * Get or set the avatar size to use.
     *
     * @param integer $iSize The avatar size to use, must be less than 2048 and greater than 0.
     * @return number|\forxer\Gravatar\Image
     */
    public function size($iSize = null)
    {
        if (null === $iSize) {
            return $this->getSize();
        }

        return $this->setSize($iSize);
    }

    /**
     * Alias for the "size" method.
     *
     * @param integer $iSize The avatar size to use, must be less than 2048 and greater than 0.
     * @return number|\forxer\Gravatar\Image
     */
    public function s($iSize= null)
    {
        return $this->size($iSize);
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
     * @param integer $size The avatar size to use, must be less than 2048 and greater than 0.
     * @throws InvalidImageSizeException
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function setSize($iSize = null)
    {
        if (null === $iSize) {
            return $this;
        }

        $iSize = intval($iSize);

        if ($iSize < 0 || $iSize > 2048) {
            throw new InvalidImageSizeException('Avatar size must be within 0 pixels and 2048 pixels');
        }

        $this->iSize = $iSize;

        return $this;
    }

    /**
     * Get or set the default image to use for avatars.
     *
     * @param string $sDefaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param boolean $bForce Force the default image to be always load.
     * @return number|\forxer\Gravatar\Image
     */
    public function defaultImage($sDefaultImage = null, $bForce = false)
    {
        if (null === $sDefaultImage) {
            return $this->getDefaultImage();
        }

        return $this->setDefaultImage($sDefaultImage, $bForce);
    }

    /**
     * Alias for the "defaultImage" method.
     *
     * @param string $sDefaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param boolean $bForce Force the default image to be always load.
     * @return number|\forxer\Gravatar\Image
     */
    public function d($sDefaultImage = null, $bForce = false)
    {
        return $this->defaultImage($sDefaultImage, $bForce);
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
     * @param boolean $bForce Force the default image to be always load.
     * @throws InvalidDefaultImageException
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

        $_image = strtolower($sDefaultImage);

        if (in_array($_image, $this->aValidDefaultsImages)) {
            $this->sDefaultImage = $_image;
            return $this;
        }

        if (filter_var($sDefaultImage, FILTER_VALIDATE_URL)) {
            $this->sDefaultImage = $sDefaultImage;
            return $this;
        }

        $message = sprintf(
            'The default image "%s" is not a recognized gravatar "default" and is not a valid URL, default gravatar can be: %s',
            $sDefaultImage,
            implode(', ', $this->aValidDefaultsImages)
        );

        throw new InvalidDefaultImageException($message);
    }

    /**
     * Get or set if we have to force the default image to be always load.
     *
     * @param boolean $sRating
     * @return boolean|\forxer\Gravatar\Image
     */
    public function forceDefault($bForceDefault = null)
    {
        if (null === $bForceDefault) {
            return $this->getForceDefault();
        }

        return $this->setForceDefault($bForceDefault);
    }

    /**
     * Alias for the "forceDefault" method.
     *
     * @param boolean $bForceDefault
     * @return boolean|\forxer\Gravatar\Image
     */
    public function f($bForceDefault = null)
    {
        return $this->forceDefault($bForceDefault);
    }

    /**
     * Check if we are forcing the default image to be always load.
     *
     * @return boolean Are we forcing the default image?
     */
    public function getForceDefault()
    {
        return $this->bForceDefault;
    }

    /**
     * Alias for the "getForceDefault" method.
     *
     * @return boolean Are we forcing the default image?
     */
    public function forcingDefault()
    {
        return $this->getForceDefault();
    }

    /**
     * Set if the default image has to be always load.
     *
     * @param boolean $bForceDefault Should we force or not the default image to be always load.
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function setForceDefault($bForceDefault = false)
    {
        $this->bForceDefault = (bool)$bForceDefault;

        return $this;
    }

    /**
     * Force the default image to be always load.
     *
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function enableForceDefault()
    {
        $this->setForceDefault(true);

        return $this;
    }

    /**
     * Do not force the default image to be always load.
     *
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function disableForceDefault()
    {
        $this->setForceDefault(false);

        return $this;
    }

    /**
     * Get or set the maximum allowed rating for avatars.
     *
     * @param string $sRating
     * @return string|\forxer\Gravatar\Image
     */
    public function rating($sRating = null)
    {
        if (null === $sRating) {
            return $this->getMaxRating();
        }

        return $this->setMaxRating($sRating);
    }

    /**
     * Alias for the "rating" method.
     *
     * @param string $sRating
     * @return string|\forxer\Gravatar\Image
     */
    public function r($sRating = null)
    {
        return $this->rating($sRating);
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
     * @throws InvalidMaxRatingImageException
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function setMaxRating($sRating = null)
    {
        if (null === $sRating) {
            return $this;
        }

        $sRating = strtolower($sRating);

        if (!in_array($sRating, $this->aValidRatings)) {
            $message = sprintf(
                'Invalid rating "%s" specified, only allowed to be used are: %s',
                $sRating,
                implode(', ', $this->aValidRatings)
            );

            throw new InvalidMaxRatingImageException($message);
        }

        $this->sMaxRating = $sRating;

        return $this;
    }

    /**
     * Get or set the avatar extension to use.
     *
     * @param string $sExtension The avatar extension to use.
     * @return string|\forxer\Gravatar\Image
     */
    public function extension($sExtension = null)
    {
        if (null === $sExtension) {
            return $this->getExtension();
        }

        return $this->setExtension($sExtension);
    }

    /**
     * Alias for the "extension" method.
     *
     * @param string $sExtension
     * @return string|\forxer\Gravatar\Image
     */
    public function e($sExtension= null)
    {
        return $this->extension($sExtension);
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
     * @throws InvalidImageExtensionException
     * @return \forxer\Gravatar\Image The current Gravatar Image instance.
     */
    public function setExtension($sExtension = null)
    {
        if (null === $sExtension) {
            return $this;
        }

        if (!in_array($sExtension, $this->aValidExtensions)) {
            $message = sprintf(
                'The extension "%s" is not a valid one, extension image for Gravatar can be: %s',
                $sExtension,
                implode(', ', $this->aValidExtensions)
            );

            throw new InvalidImageExtensionException($message);
        }

        $this->sExtension = $sExtension;

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
            .(empty($aParams) ? '' : '?'.http_build_query($aParams, '', '&amp;'));
    }
}
