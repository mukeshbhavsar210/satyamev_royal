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
                    @php
                        $categories = \App\Models\Project::query()
                            ->whereNotNull('category')
                            ->whereIn('category', ['ongoing', 'upcoming', 'completed'])
                            ->distinct()->pluck('category');
                    @endphp

                    <div x-data="{ activeTab: '{{ $categories->first() ?? 'ongoing' }}' }" class="project-tabs mt-10">                        
                        <div class="tabs">
                            @foreach($categories as $category)
                                <button type="button" @click="activeTab = '{{ $category }}'"
                                    :class="{ 'active': activeTab === '{{ $category }}' }"
                                    class="tab-button">
                                    {{ ucfirst($category) }}
                                </button>
                            @endforeach
                        </div>

                        @foreach($categories as $category)
                            <div x-show="activeTab === '{{ $category }}'" class="cards" >
                                @foreach(
                                    $section['model']::with('project')
                                        ->whereHas('project', function ($query) use ($category) {
                                            $query->where('category', $category);
                                        })
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
                    @endforeach
                </div>

                @elseif($section['model'] === \App\Models\Project::class)
                    <div class="project-table">
                        <table class="project-table">
                            <thead>
                                <tr>
                                    <th width="90">Image</th>
                                    <th>Title</th>                                    
                                    <th width="140">Category</th>
                                    <th>RERA</th>
                                    <th width="140">PDF</th>                                    
                                    <th width="80">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($section['model']::get() as $record)
                                    <tr>                                        
                                        <td >
                                            @if($record->image)
                                                <img src="{{ Storage::url($record->image) }}" alt="{{ $record->title }}" class="thumb" >
                                            @endif
                                        </td>
                                        <td>
                                            <p><b>{{ $record->title }}</b></p>
                                            <p>{{ $record->location }}</p>
                                        </td>                                                                                                                        
                                        <td>{{ $record->category }}</td>
                                        <td>{{ $record->rera ?? '-' }}</td>
                                        <td>
                                            @if($record->pdf)
                                                <a href="{{ Storage::url($record->pdf) }}" download>PDF</a>
                                            @else
                                                -
                                            @endif
                                        </td>                                        
                                         <td class="project-table_actions">                                            
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
                                        </td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
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