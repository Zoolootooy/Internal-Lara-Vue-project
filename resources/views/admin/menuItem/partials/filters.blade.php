{!! Form::openFilter(['route' => ['menuItem.index'], 'method' => 'get']) !!}
    <div class="row mt-2 mb-3">
        {!! Form::selectFieldFl('menu_id', $menus, __('Menu')) !!}
        {!! Form::textFieldFl('link_name') !!}
        {!! Form::selectFieldFl('type', $filters::types()) !!}
        {!! Form::selectFieldFl('page_id', $pages, __('Page')) !!}
        {!! Form::textFieldFl('url') !!}
        {!! Form::filterButtons('menuItem.index') !!}
    </div>
{!! Form::close() !!}