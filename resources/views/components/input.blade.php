@props(['name', 'label', 'type' => 'text', 'model', 'placeholder' => ''])

<div class="mt-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" wire:model="{{ $model }}" class="form-control" id="{{ $name }}" placeholder="{{ $placeholder }}">
    @error($model)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
