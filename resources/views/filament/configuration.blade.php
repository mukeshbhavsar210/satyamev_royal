<x-filament-panels::page>
    @foreach($this->getCardSections() as $section)    
        @php
            $count = $section['model']::count();
        @endphp

        <x-filament::section collapsible :collapsed="$loop->index !== 0">
            <x-slot name="heading">{{ $section['heading'] }} - <span class="count">{{ $count }}</span></x-slot> 

            <x-filament::button wire:click="mountAction('{{ $section['add_action'] }}')" icon="heroicon-o-plus" class="edit-btn" >
                Add {{ $section['singular'] ?? rtrim($section['heading'], 's') }}
            </x-filament::button>

            <div class="card-wrapper">                                          
                @if($section['model'] === \App\Models\Apartment::class)                                        
                    <div x-data="{ activeTab: 'ongoing' }" class="project-tabs mt-10" >
                        <div class="tabs">
                            <button type="button"
                                @click="activeTab = 'ongoing'"
                                :class="{ 'active': activeTab === 'ongoing' }"
                                class="tab-button">
                                Ongoing
                            </button>

                            <button type="button" @click="activeTab = 'upcoming'"
                                :class="{ 'active': activeTab === 'upcoming' }"
                                class="tab-button" >
                                Upcoming
                            </button>

                            <button type="button" @click="activeTab = 'completed'"
                                :class="{ 'active': activeTab === 'completed' }"
                                class="tab-button" >
                                Completed
                            </button>
                        </div>

                        <div x-show="activeTab === 'ongoing'" class="cards">
                            @foreach(
                                $section['model']::where('category', 'ongoing')
                                    ->orderBy($section['orderBy'])
                                    ->get()
                                as $record
                            )
                                @include('filament.project-card', [
                                    'record' => $record,
                                    'section' => $section,
                                ])
                            @endforeach
                        </div>

                        <div x-show="activeTab === 'upcoming'" class="cards" >
                            @foreach(
                                $section['model']::where('category', 'upcoming')
                                    ->orderBy($section['orderBy'])
                                    ->get()
                                as $record
                            )

                                @include('filament.project-card', [
                                    'record' => $record,
                                    'section' => $section,
                                ])
                            @endforeach
                        </div>

                        <div x-show="activeTab === 'completed'" class="cards" >
                            @foreach(
                                $section['model']::where('category', 'completed')
                                    ->orderBy($section['orderBy'])
                                    ->get()
                                as $record
                            )

                                @include('filament.project-card', [
                                    'record' => $record,
                                    'section' => $section,
                                ])
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="cards">
                        @foreach($section['model']::orderBy($section['orderBy'])->get() as $record)
                            @include('filament.project-card', [
                                'record' => $record,
                                'section' => $section,
                            ])
                        @endforeach
                    </div>                                   
                @endif
            </div>
        </x-filament::section>
    @endforeach

    <x-filament-actions::modals />

</x-filament-panels::page>