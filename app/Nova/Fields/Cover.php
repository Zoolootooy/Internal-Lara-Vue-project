<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\PresentsImages;
use Laravel\Nova\Contracts\Cover as CoverInterface;

class Cover extends Field implements CoverInterface
{
    use PresentsImages;

    /**
     * @var string
     */
    public $gravatarImage = 'https://secure.gravatar.com/avatar';

    /**
     * @var array
     */
    public $gravatarFields = ['avatar'];

    /**
     * Resolve the thumbnail URL for the field.
     *
     * @return string|null
     */
    public function resolveThumbnailUrl()
    {
        return $this->value
            ? $this->resource->getThumbnailUrl($this->attribute)
            : $this->defaultImage();
    }

    /**
     * @return null|string
     */
    public function defaultImage()
    {
        return in_array($this->attribute, $this->gravatarFields)
            ? $this->gravatarImage
            : null;
    }
}