<x-filament-panels::page>
    <x-filament::section>
        <div x-data="{ activeTab: 'timeline' }" class="project-tabs">
            <div class="tabs">
                <button type="button" @click="activeTab = 'timeline'"
                    :class="{ 'active': activeTab === 'timeline' }"
                    class="tab-button"
                >Timeline</button>

                <button type="button" @click="activeTab = 'slide'"
                    :class="{ 'active': activeTab === 'slide' }" class="tab-button"
                >Slides</button>
            </div>

            <div x-show="activeTab === 'timeline'" class="cards">
                @foreach($this->getCardSections() as $section)
                    @if($section['model'] === \App\Models\Timeline::class)
                        <div class="card-wrapper">
                            <x-filament::button
                                wire:click="mountAction('{{ $section['add_action'] }}')"
                                icon="heroicon-o-plus" class="edit-btn"
                            >Add {{ $section['singular'] ?? 'Timeline' }}
                            </x-filament::button>

                            <div class="cards">
                                @foreach(
                                    $section['model']::orderBy($section['orderBy'])->get()
                                    as $record
                                )

                                    @include('filament.project-card', [
                                        'record' => $record,
                                        'section' => $section,
                                    ])
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>            

        <div x-show="activeTab === 'slide'" class="cards">            
            @foreach($this->getCardSections() as $section)
                @if($section['model'] === \App\Models\Slide::class)
                    <div class="card-wrapper">
                        <x-filament::button
                            wire:click="mountAction('{{ $section['add_action'] }}')"
                            icon="heroicon-o-plus" class="edit-btn"
                            >Add {{ $section['singular'] ?? 'Slide' }}
                        </x-filament::button>

                        <div class="cards">
                            @foreach(
                                $section['model']::orderBy($section['orderBy'])->get()
                                as $record
                            )

                                @include('filament.project-card', [
                                    'record' => $record,
                                    'section' => $section,
                                ])
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    </x-filament::section>
    
<x-filament-actions::modals />

</x-filament-panels::page>