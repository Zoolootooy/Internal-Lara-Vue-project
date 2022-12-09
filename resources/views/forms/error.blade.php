@php ($formIndex = FormHelper::formIndex($options))
@php ($singlePage = $singlePage ?? false)

<span class="invalid-feedback" @if($singlePage) v-if="forms['{{ $formIndex }}'].errors.has('{{ $field }}')" v-text="forms['{{ $formIndex }}'].errors.get('{{ $field }}')" @endif>
    {{ str_replace(' id ', ' ', $errors->first($field)) }}
</span>