@php
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= Str::ucfirst($name);
    
@endphp


<div @class(['form-group', 'mb-3', $class])>
    <label for="{{ $name }}">{{ $label }}</label>

    <select class="form-select" name="{{ $name }}[]" id="{{ $name }}" multiple array>
        @foreach ($options as $key => $v)
            <option @selected($value->contains($key)) value="{{ $key }}">{{ $v }}</option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
