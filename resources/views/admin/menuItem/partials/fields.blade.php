{!! Form::errorList($errors) !!}

{!! Form::selectField('menu_id', $menus, __('Menu')) !!}

{!! Form::selectField('page_id', $pages, __('Page')) !!}

{!! Form::selectField('type', $model::types()) !!}

{!! Form::textField('link_name') !!}

{!! Form::textField('url') !!}

<!-- {!! Form::selectField('inherited', $model::inheritedStatuses()) !!} -->

<div class="form-group row">
    {!! Form::label('order', __('Change Order'), ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('order', $model::orderTypes(), null, ['class' => 'form-control', 'placeholder' => '']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::select('order_item', $items, null, ['class' => 'form-control', 'placeholder' => '']) !!}
    </div>
</div>

{!! Form::buttons('menuItem.index', ['menu' => $model->menu_id]) !!}
