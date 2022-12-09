<?php

namespace App\Helpers;

/**
 * Class FormHelper
 * @package App\Helpers
 */
class FormHelper
{
    /**
     * @param $field
     * @param $errors
     * @param $options
     * @param bool $singlePage
     * @param bool $filter
     * @param string $class
     * @return array
     */
    public static function options($field, $errors, $options, $singlePage = false, $filter = false, $class = 'form-control')
    {
        if ($filter) {
            $options['value'] = static::filterValue($field);
        }

        return array_merge(
            static::htmlOptions($field, $errors, $filter, $class),
            static::vueOptions($field, $options, $singlePage),
            $options ?? []
        );
    }

    /**
     * @param $field
     * @param $errors
     * @param bool $filter
     * @param $class
     * @return array
     */
    private static function htmlOptions($field, $errors, $filter = false, $class)
    {
        return [
            'class' => $class . ($errors->first($field) && !$filter ? ' is-invalid' : ''),
            'id' => $field,
        ];
    }

    /**
     * @param $field
     * @param $options
     * @param bool $singlePage
     * @return array
     */
    private static function vueOptions($field, $options, $singlePage = false)
    {
        if (!$singlePage) {
            return [];
        }

        $formIndex = static::formIndex($options);

        return [
            ':class' => "{ 'is-invalid': forms[" . $formIndex . "].errors.has('" . $field . "') }",
            'v-model' => 'forms[' . $formIndex . '].' . $field
        ];
    }

    /**
     * @param $options
     * @return array
     */
    public static function formOptions($options)
    {
        $formIndex = static::formIndex($options);

        return [
            '@submit.prevent' => 'forms[' . $formIndex . '].submit($event)',
            '@keydown' => 'forms[' . $formIndex . '].keydown($event)',
            'class' => 'sp-form'
        ];
    }

    /**
     * @return array
     */
    public static function formFilterOptions()
    {
        return [
            'onchange' => "submit()"
        ];
    }

    /**
     * @param $options
     * @return int
     */
    public static function formIndex($options)
    {
        return $options['formIndex'] ?? 0;
    }

    /**
     * @param $options
     * @return null
     */
    public static function value($options)
    {
        return $options['value'] ?? null;
    }

    /**
     * @param $field
     * @return array|\Illuminate\Http\Request|null|string
     */
    public static function filterValue($field)
    {
        $filters = session('filters', []);

        return request($field)
            ?? $filters[$field]
            ?? null;
    }
}
