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
    const URL = '//www.gravatar.com/';

    /**
     * @var string The address email to be used.
     */
    protected $sEmail;

    /**
     * Return the Gravatar image URL based on the provided email address.
     *
     * @param string $sEmail The email to get the gravatar for.
     * @param string $iSize The avatar size to use, must be less than 2048 and greater than 0.
     * @param string $sDefaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param string $sRating The maximum rating to use for avatars
     * @param string $sExtension The avatar extension to use
     * @param boolean $bForceDefault Force the default image to be always load.
     * @return string The URL to the gravatar.
     */
    public static function image($sEmail, $iSize = null, $sDefaultImage = null, $sRating = null, $sExtension = null, $bForceDefault = false)
    {
        $gravatarImage = (new Image())
            ->setSize($iSize)
            ->setDefaultImage($sDefaultImage, $bForceDefault)
            ->setMaxRating($sRating)
            ->setExtension($sExtension);

        return $gravatarImage->getUrl($sEmail);
    }

    /**
     * Return multiples Gravatar images URL based on the provided array of emails addresses.
     *
     * @param array $aEmail The emails list to get the Gravatar images for.
     * @param string $iSize The avatar size to use, must be less than 2048 and greater than 0.
     * @param string $sDefaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param string $sRating The maximum rating to use for avatars.
     * @param string $sExtension The avatar extension to use.
     * @param boolean $bForceDefault Force the default image to be always load.
     * @return array The list of URL to the Gravatar images.
     */
    public static function images(array $aEmail, $iSize = null, $sDefaultImage = null, $sRating = null, $sExtension = null, $bForceDefault = false)
    {
        $gravatarImage = (new Image())
            ->setSize($iSize)
            ->setDefaultImage($sDefaultImage, $bForceDefault)
            ->setMaxRating($sRating)
            ->setExtension($sExtension);

        $aUrls = [];

        foreach ($aEmail as $sEmail) {
            $aUrls[$sEmail] = $gravatarImage->getUrl($sEmail);
        }

        return $aUrls;
    }

    /**
     * Return the Gravatar profile URL based on the provided email address.
     *
     * @param string $sEmail The email to get the Gravatar profile for.
     * @param string $sFormat The profile format to use.
     * @return string The URL to the Gravatar profile.
     */
    public static function profile($sEmail, $sFormat = null)
    {
        return (new Profile())
            ->setFormat($sFormat)
            ->getUrl($sEmail);
    }

    /**
     * Return multiples Gravatar profiles URL based on the provided array of emails addresses.
     *
     * @param array $aEmail The emails list to get the Gravatar profiles for.
     * @param string $sFormat The profile format to use.
     * @return array The list of URL to the Gravatar profiles.
     */
    public static function profiles(array $aEmail, $sFormat = null)
    {
        $gravatarProfil = (new Profile())
            ->setFormat($sFormat);

        $aUrls = [];

        foreach ($aEmail as $sEmail) {
            $aUrls[$sEmail] = $gravatarProfil->getUrl($sEmail);
        }

        return $aUrls;
    }

    /**
     * Get or set the address email to be used.
     *
     * @param string $sEmail
     * @return number|\forxer\Gravatar\Gravatar
     */
    public function email($sEmail = null)
    {
        if (null === $sEmail) {
            return $this->getEmail();
        }

        return $this->setEmail($sEmail);
    }

    /**
     * Get the address email to be used.
     *
     * @return integer The current avatar size in use.
     */
    public function getEmail()
    {
        return $this->sEmail;
    }

    /**
     * Set the address email to be used.
     *
     * @param string $sEmail
     * @return \forxer\Gravatar\Gravatar
     */
    public function setEmail($sEmail)
    {
        $this->sEmail = $sEmail;

        return $this;
    }

    /**
     * Get the email hash to use (after cleaning the string).
     *
     * @param string $sEmail The email to get the hash for.
     * @return string The hashed form of the email.
     */
    protected static function getHash($sEmail)
    {
        return md5(strtolower(trim($sEmail)));
    }
}
