<x-filament-panels::page>
    @foreach($this->getCardSections() as $section)
        <x-filament::section collapsible :collapsed="$loop->index !== 0">
            <x-slot name="heading">{{ $section['heading'] }}</x-slot>            

            <div class="card-wrapper">
                <x-filament::button wire:click="mountAction('{{ $section['add_action'] }}')" icon="heroicon-o-plus" class="edit-btn" >
                    Add {{ rtrim($section['heading'], 's') }}
                </x-filament::button>

                <div class="cards">
                    @foreach($section['model']::orderBy($section['orderBy'])->get() as $record)
                        <div class="image-card">
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
                                            { record: {{ $record->id }} }
                                        )"
                                    >
                                        Edit
                                    </x-filament::button>

                                    <x-filament::button class="delete-btn"
                                        wire:click="mountAction(
                                            '{{ $section['delete_action'] }}',
                                            { record: {{ $record->id }} }
                                        )"
                                    >
                                        Delete
                                    </x-filament::button>
                                </div>
                            </div>

                            <h3 class="title">{{ $record->{$section['title']} }}</h3>
                            
                            @if($section['extra'])
                                <p class="small-title">{{ $record->{$section['extra']} }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </x-filament::section>
    @endforeach

    <x-filament-actions::modals />
</x-filament-panels::page>