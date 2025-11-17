@props(['model', 'value', 'label'])
<label class="me-3">
    <input type="checkbox" wire:model="{{ $model }}" value="{{ $value }}">
    {{ $label }}
</label>
