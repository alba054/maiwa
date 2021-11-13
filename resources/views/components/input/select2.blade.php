@props(['placeholder' => 'Select Options', 'id'])
<div wire:ignore>
    <select {{ $attributes }} id="tags" multiple="multiple" data-placeholder="Select Tags" style="width: 100%;"
        class="select2">
        {{ $slot }}
    </select>
</div>
