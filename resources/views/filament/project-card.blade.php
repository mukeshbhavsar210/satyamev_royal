<div class="image-card {{ $section['heading'] == 'Apartments' ? 'apartment' : 'timeline' }}">
    <div class="image-thumb">
        @if($record->image)
            <img src="{{ asset('storage/' . $record->image) }}" alt="{{ $record->{$section['title']} }}" >
        @else
            <p>No Image</p>
        @endif

        <div class="overlay">
            <x-filament::button class="edit-btn"
                wire:click="mountAction(
                    '{{ $section['edit_action'] }}',
                    {
                        {{ $section['edit_argument'] }}: {{ $record->id }}
                    }
                )"
            >Edit
            </x-filament::button>
            
            @if(auth()->user()?->role === 'admin')
                <x-filament::button class="delete-btn" color="danger"
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
        </div>
    </div>

    <h3 class="title">{{ $record->{$section['title']} }}</h3>

    @if($section['extra'])
        <p class="small-title">
            {{ $record->{$section['extra']} }}
        </p>
    @endif
</div>