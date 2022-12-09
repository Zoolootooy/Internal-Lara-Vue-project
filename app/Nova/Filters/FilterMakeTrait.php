<?php
namespace App\Nova\Filters;

use Illuminate\Support\Str;

trait FilterMakeTrait
{
    /**
     * FilterMakeTrait constructor.
     * @param null $name
     * @param null $attribute
     */
    public function __construct($name = null, $attribute = null, $options = null)
    {
        $className = class_basename(get_class($this));
        $filterName = Str::replaceLast('Filter', '', $className);
        $attributeName = Str::snake($filterName);

        $this->attribute = $attribute ?? $attributeName;
        $this->name = $name ?? ucwords(str_replace('_', ' ', $attributeName));

        $this->setOptions($options);
    }

    /**
     * @param mixed ...$arguments
     * @return FilterMakeTrait
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * @param $options
     * @return $this
     */
    public function setOptions($options = null)
    {
        if (isset($this->options)) {
            $this->options = $options ?? $this->getDefaultOptions();
        }

        return $this;
    }
}