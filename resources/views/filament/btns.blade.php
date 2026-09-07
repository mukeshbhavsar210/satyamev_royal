<x-filament::button
    size="sm"
    wire:click="mountAction(
        '{{ $section['edit_action'] }}',
        {
            model: '{{ addslashes($section['model']) }}',
            recordId: {{ $record->id }}
        }
    )"
>Edit
</x-filament::button>

@if(auth()->user()?->role === 'admin')
    <x-filament::button
        color="danger"
        size="sm"
        wire:click="mountAction(
            '{{ $section['delete_action'] }}',
            {
                model: '{{ addslashes($section['model']) }}',
                recordId: {{ $record->id }}
            }
        )"
    >Delete
    </x-filament::button>
@endif