@php
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= Str::ucfirst($name);
    $placeholder ??='';
    
@endphp




<div @class(['form-group', 'mb-3', $class])>
    <label for="{{ $name }}">{{ $label }}</label>

    @if ($type == 'textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $name }} rows="8">{{ old($name, $value) }}</textarea>
    @else
        <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}"
            name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{$placeholder}}">
    @endif

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
