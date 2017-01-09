<div class="form-group{{ ($errors->has($name)) ? ' has-error' : '' }}">
    {{ Form::label($name, null, ['class' => 'control-label']) }}
    {{ Form::email($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    {!! ($errors->has($name) ? '<p>'.$errors->first($name).'</p>' : '') !!}
</div>
