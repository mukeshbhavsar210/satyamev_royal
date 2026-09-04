<x-filament-panels::page>
     <div class="w-full">
        <x-filament::tabs class="w-full custom-tabs">
            @foreach($this->getCardSections() as $section)
                @php
                    $count = $section['model']::count();
                @endphp

                <x-filament::tabs.item wire:click="$set('activeTab', {{ $loop->index }})" :active="(int) $activeTab === $loop->index"
                    class="custom-tab {{ (int) $activeTab === $loop->index ? 'is-active' : '' }}">
                    <span>{{ $section['heading'] }}</span>                    
                    <x-filament::badge>{{ $count }}</x-filament::badge>
                </x-filament::tabs.item>
            @endforeach
        </x-filament::tabs>

        @foreach($this->getCardSections() as $section)
            @if((int) $activeTab === $loop->index)
                <div class="card-section">
                    <div class="card-title">
                        <h1>{{ $section['heading'] }}</h1>

                        <x-filament::button wire:click="mountAction('{{ $section['add_action'] }}')" icon="heroicon-o-plus" class="edit-btn">
                            Add {{ $section['singular'] }}
                        </x-filament::button>
                    </div>

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
                                        <th width="90">Year</th>
                                        <th width="100">PDF</th>                                    
                                        <th width="80">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section['model']::get() as $record)
                                        <tr>                                        
                                            <td>
                                                @if($record->image)
                                                    <img src="{{ Storage::url($record->image) }}" alt="{{ $record->title }}" class="thumb" >
                                                @endif
                                            </td>
                                            <td>
                                                <p><b>{{ $record->title }}</b></p>
                                                <p>{{ $record->location }}</p>
                                            </td>                                                                                                                        
                                            <td>
                                                @php
                                                    $category = ucfirst($record->category);

                                                    $class = match (strtolower($record->category)) {
                                                        'ongoing' => 'category-ongoing',
                                                        'upcoming' => 'category-upcoming',
                                                        'completed' => 'category-completed',
                                                        default => '',
                                                    };
                                                @endphp

                                                <span class="project-category {{ $class }}">
                                                    {{ $category }}
                                                </span>
                                            </td>
                                            <td>{{ $record->rera ?? '-' }}</td>
                                            <td>{{ $record->year ?? '-' }}</td>
                                            <td>
                                                @if($record->pdf)
                                                    <a href="{{ Storage::url($record->pdf) }}" download>View</a>
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
                    
                    @elseif($section['model'] === \App\Models\Why::class)
                        <div class="project-table">
                            <table class="project-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th width="600">Description</th>
                                        <th width="80">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section['model']::get() as $record)
                                        <tr>                                                                                
                                            <td>
                                                <p>{{ $record->title }}</p>                                            
                                            </td>
                                            <td>
                                                <p>{{ Str::limit($record->description, 70) }}</p>
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

                    @elseif($section['model'] === \App\Models\Testimonial::class)
                        <div class="project-table">
                            <table class="project-table">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th width="80">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section['model']::get() as $record)
                                        <tr>     
                                            <td>
                                                @if($record->image)
                                                    <img src="{{ Storage::url($record->image) }}" alt="{{ $record->name }}" class="thumb" >
                                                @endif
                                            </td>                                                                           
                                            <td>
                                                <p><b>{{ $record->name }}</b></p>
                                                <p>{{ $record->designation }}</p>
                                            </td>
                                            <td>
                                                <p>{{ Str::limit($record->description, 70) }}</p>
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

                    @elseif($section['model'] === \App\Models\Event::class)
                        <div class="project-table">
                            <table class="project-table">
                                <thead>
                                    <tr>
                                        <th width="80">Image</th>
                                        <th>Event Title</th>                                    
                                        <th>Description</th>
                                        <th width="80">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section['model']::get() as $record)
                                        <tr>     
                                            <td>
                                                @if($record->image)
                                                    <img src="{{ Storage::url($record->image) }}" alt="{{ $record->name }}" class="thumb" >
                                                @endif
                                            </td>                                                                           
                                            <td>
                                                <p>{{ $record->title }}</p>                                            
                                            </td>
                                            <td>
                                                <p>{{ Str::limit($record->description, 70) }}</p>
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

                    @elseif($section['model'] === \App\Models\Page::class)
                        <div class="project-table">
                            <table class="project-table">
                                <thead>
                                    <tr>
                                        <th width="80">Image</th>
                                        <th>Title</th>                                    
                                        <th>Content</th>
                                        <th width="80">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section['model']::get() as $record)
                                        <tr>     
                                            <td>
                                                @if($record->image)
                                                    <img src="{{ Storage::url($record->image) }}" alt="{{ $record->name }}" class="thumb" >
                                                @endif
                                            </td>                                                                           
                                            <td><p>{{ $record->title }}</p></td>
                                            <td><p>{!! Str::limit($record->content, 70) !!}</p></td>
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
                        <div class="cards" >
                            @foreach($section['model']::get() as $record)
                                @include('filament.project-card', [
                                    'record' => $record,
                                    'section' => $section,
                                ])
                            @endforeach
                        </div>
                    @endif
                </div>
                </div>
            @endif
        @endforeach    
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>