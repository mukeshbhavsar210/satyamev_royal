<x-filament::button
        size="sm"
        wire:click="mountAction(
            '{{ $child['edit_action'] }}',
            {
                model: '{{ addslashes($child['model']) }}',
                recordId: {{ $record->id }}
            }
        )"
    >
        Edit
    </x-filament::button>
    @if(auth()->user()?->role === 'admin')
        <x-filament::button
            color="danger"
            size="sm"
            wire:click="mountAction(
                '{{ $child['delete_action'] }}',
                {
                    model: '{{ addslashes($child['model']) }}',
                    recordId: {{ $record->id }}
                }
            )"
        >
            Delete
        </x-filament::button>
    @endif