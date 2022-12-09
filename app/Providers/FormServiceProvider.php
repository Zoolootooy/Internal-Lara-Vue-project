<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    private $components = [
        'textField' => [
            'template' => 'forms.text',
            'options' => ['field', 'label' => null, 'options' => null]
        ],
        'textAreaField' => [
            'template' => 'forms.textArea',
            'options' => ['field', 'label' => null, 'options' => null]
        ],
        'textEditorField' => [
            'template' => 'forms.textEditor',
            'options' => ['field', 'label' => null, 'options' => null]
        ],
        'textFullEditorField' => [
            'template' => 'forms.textFullEditor',
            'options' => ['field', 'label' => null, 'options' => null]
        ],
        'textSlugField' => [
            'template' => 'forms.textSlug',
            'options' => ['field', 'value', 'label' => null, 'options' => null]
        ],
        'dateField' => [
            'template' => 'forms.date',
            'options' => ['field', 'label' => null, 'options' => null]
        ],
        'emailField' => [
            'template' => 'forms.email',
            'options' => ['field', 'label' => null, 'options' => null]
        ],
        'imageField' => [
            'template' => 'forms.image',
            'options' => ['field', 'urls', 'entryTitle', 'label' => null, 'options' => null]
        ],
        'fileField' => [
            'template' => 'forms.file',
            'options' => ['field', 'urls', 'entryTitle', 'label' => null, 'options' => null]
        ],
        'passwordField' => [
            'template' => 'forms.password',
            'options' => ['field', 'label' => null, 'options' => null]
        ],
        'selectField' => [
            'template' => 'forms.select',
            'options' => ['field', 'selectOptions', 'label' => null, 'options' => null]
        ],
        'checkboxField' => [
            'template' => 'forms.checkbox',
            'options' => ['field', 'label' => null, 'options' => null]
        ],
    ];

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerComponents();
    }

    /**
     * return null
     */
    public function registerComponents()
    {
        foreach ($this->components as $name => $data) {
            $template = $data['template'];
            $options = $data['options'];

            Form::component($name, $template, $options);
            Form::component($name . 'Fs', $template, array_merge($options, ['fullScreen' => true]));
            Form::component($name . 'Sp', $template, array_merge($options, ['fullScreen' => true, 'singlePage' => true]));
            Form::component($name . 'Fl', $template, array_merge($options, ['fullScreen' => true, 'filter' => true]));
        }

        Form::component('openSp', 'forms.form', ['options']);

        Form::component('openFilter', 'forms.formFilter', ['options']);

        Form::component('error', 'forms.error', ['field', 'options' => null, 'singlePage' => false]);

        Form::component('errorList', 'forms.errorList', ['errors']);

        Form::component('buttons', 'forms.buttons', ['cancelUri']);

        Form::component('filterButtons', 'forms.filterButtons', ['cancelUri']);
    }
}
