@if ($label)
    <label for="{{ $id ?? $name }}" class="form-label fw-medium {{ $required ? 'required' : '' }}">
        {{ $label }}
    </label>
@endif

<textarea id="{{ $id ?? $name }}" name="{{ $name }}" class="form-control {{ $class }}"
    placeholder="Nhập {{ strtolower($placeholder ?? $label) }}" maxlength="{{ $maxLength }}" rows="{{ $rows }}"
    @disabled($disabled)>{!! $value !!}</textarea>

<small class="text-danger error-message {{ $name }}"></small>
