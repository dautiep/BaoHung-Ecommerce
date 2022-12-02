@php
    $required = '<sup class="text-danger">*</sup>';
    $required = @$control['required'] == true ? $required : '';
@endphp
@switch($input)
    @case('input')
        {{-- array('input', [
            'for',
            'label',
            'type',
            'class',
            'name',
            'value',
            'property'
        ]) --}}
        <div class="form-group">
            <label for="{{ @$control['for'] }}">{{ @$control['label'] }} {!! @$required !!}</label>
            <input type="{{ @$control['type'] }}" class="form-control {{ @$control['class'] }}" name="{{ @$control['name'] }}"
                value="{{ @$control['value'] }}" {{ @$control['property'] }} placeholder="{{ @$control['placeholder'] }}">
        </div>
    @break

    @case('calendar')
        <div class="form-group">
            <label for="{{ @$control['for'] }}">{{ @$control['label'] }} {!! @$required !!}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
                <input type="{{ @$control['type'] }}" class="form-control float-right  {{ @$control['class'] }}"
                    name="{{ @$control['name'] }}" id="fromTo" value="{{ @$control['value'] }}" autocomplete="off">
            </div>
        </div>
    @break

    @case('select2')
        {{-- array('input', [
            'for',
            'label',
            'type',
            'class',
            'name',
            'value',
            'property'
        ]) --}}
        <div class="form-group">
            <label class="text-capitalize">{{ @$control['label'] }} {!! @$required !!}
            </label>
            <select class="form-control select2 {{ @$control['class'] }}" name="{{ @$control['name'] }}" id="{{ @$control['id'] }}">
                @if (@$control['first'])
                    <option value="{{ $control['first_value'] }}">{{ @$control['first_name'] }}</option>
                @endif
                @if (!empty(@$control['selected']))
                    @foreach (@$control['selected'] as $item)
                        <option value="{{ @$item['key'] }}"
                            {{ (string) @$item['key'] == (string) @$control['value'] ? 'selected' : '' }}>
                            {{ @$item['name'] }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    @break

    @default
@endswitch
