<?php

namespace Gravatar;

use Gravatar\Concerns\ImageHasDefault;
use Gravatar\Concerns\ImageHasExtension;
use Gravatar\Concerns\ImageHasMaxRating;
use Gravatar\Concerns\ImageHasSize;

class Image extends Gravatar
{
    use ImageHasDefault;
    use ImageHasExtension;
    use ImageHasMaxRating;
    use ImageHasSize;

    /**
     * Build the avatar URL based on the provided email address.
     *
     * @param string $email The email to get the gravatar for.
     * @return string The URL to the gravatar.
     */
    public function getUrl($email = null)
    {
        if ($email !== null) {
            $this->setEmail($email);
        }

        return static::URL
            .'avatar/'
            .$this->getHash($this->getEmail())
            .$this->getExtension()
            .$this->getQueryString();
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
     * Get query string parameters to URL
     *
     * @return string
     */
    protected function getQueryString()
    {
        $params = [];

        if ($size = $this->getSize()) {
            $params['s'] = $size;
        }

        if ($defaultImage = $this->getDefaultImage()) {
            $params['d'] = $defaultImage;
        }

        if ($maxRating = $this->getMaxRating()) {
            $params['r'] = $maxRating;
        }

        if ($this->forcingDefault()) {
            $params['f'] = 'y';
        }

        return empty($params) ? '' : '?'.http_build_query($params, '', '&amp;');
    }
}
