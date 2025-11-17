@props(['id', 'name', 'model', 'value', 'label'])
<label class="me-3" for="{{ $id }}">
    <input type="radio" name="{{ $name }}" id="{{ $id }}" wire:model="{{ $model }}" value="{{ $value }}">
    {{ $label }}
</label>
