<x-filament-panels::page>
    @foreach($this->getCardSections() as $section)
        @if(in_array($section['heading'], ['Apartments and Projects','Others','Pages','Users',]))

            @php
                $count = isset($section['model'])
                    ? $section['model']::count()
                    : null;
            @endphp

            <x-filament::section collapsible :collapsed="$loop->index !== 0">
                <x-slot name="heading">
                    {{ $section['heading'] }}

                    @if($count !== null)
                        - <span class="count">{{ $count }}</span>
                    @endif
                </x-slot>
                
                <div class="card-wrapper">
                    @if($section['heading'] === 'Apartments and Projects')                    
                        <x-filament::tabs class="w-full custom-tabs">
                            @foreach($section['children'] as $child)
                                <x-filament::tabs.item
                                    wire:click="$set('activeTab', '{{ $child['heading'] }}')"
                                    :active="$activeTab === $child['heading']"
                                    class="custom-tab {{ $activeTab === $child['heading'] ? 'is-active' : '' }}"
                                >
                                    <span>{{ $child['heading'] }}</span>
                                </x-filament::tabs.item>
                            @endforeach
                        </x-filament::tabs>

                        @foreach($section['children'] as $child)
                            @php
                                $titleCountMain = $child['model']::count();
                            @endphp

                            @if($activeTab === $child['heading'])
                                <div class="card-section">
                                    <div class="card-title">
                                        <h1>{{ $child['heading'] }} <x-filament::badge>{{ $titleCountMain }}</x-filament::badge>
                                        </h1>

                                        <x-filament::button
                                            wire:click="mountAction('{{ $child['add_action'] }}')"
                                            icon="heroicon-o-plus"
                                            class="edit-btn"
                                        >
                                            Add {{ $child['singular'] }}
                                        </x-filament::button>
                                    </div>

                                    @if($child['model'] === \App\Models\Apartment::class)
                                        @php
                                            $categories = \App\Models\Project::query()
                                                ->whereNotNull('category')
                                                ->whereIn('category', [
                                                    'ongoing',
                                                    'upcoming',
                                                    'completed'
                                                ])
                                                ->distinct()
                                                ->pluck('category');
                                        @endphp

                                        <div x-data="{ activeCategory: '{{ $categories->first() ?? 'ongoing' }}' }" class="project-tabs mt-10" >
                                            <div class="tabs">
                                                @foreach($categories as $category)
                                                    <button type="button" @click="activeCategory = '{{ $category }}'"
                                                        :class="{
                                                            'active': activeCategory === '{{ $category }}'
                                                        }"
                                                        class="tab-button" >
                                                        {{ ucfirst($category) }}
                                                    </button>
                                                @endforeach
                                            </div>

                                            @foreach($categories as $category)
                                                <div x-show="activeCategory === '{{ $category }}'" class="cards">
                                                    @foreach(
                                                        $child['model']::with('project')
                                                            ->whereHas('project', function ($query) use ($category) {
                                                                $query->where('category', $category);
                                                            })
                                                            ->orderBy($child['orderBy'] ?? 'id')
                                                            ->get()
                                                        as $record
                                                    )

                                                        @include('filament.project-card', [
                                                            'record' => $record,
                                                            'section' => $child,
                                                        ])

                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>

                                    @elseif($child['model'] === \App\Models\Project::class)
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
                                                    @foreach(
                                                        $child['model']::orderBy($child['orderBy'] ?? 'id')->get()
                                                        as $record
                                                    )
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
                                                                @include('filament.btn2', [
                                                                    'record' => $record,
                                                                    'section' => $section,
                                                                ])
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach                    
                
                    @elseif($section['heading'] === 'Others')
                        <x-filament::tabs class="w-full custom-tabs">
                            @foreach($section['children'] as $child)                                
                                <x-filament::tabs.item
                                    wire:click="$set('activeTab2', '{{ $child['heading'] }}')"
                                    :active="$activeTab2 === $child['heading']"
                                    class="custom-tab {{ $activeTab2 === $child['heading'] ? 'is-active' : '' }}" >
                                    <span>{{ $child['heading'] }}</span>                                    
                                </x-filament::tabs.item>
                            @endforeach
                        </x-filament::tabs>

                        @foreach($section['children'] as $child)
                            @php
                                $titleCounts = $child['model']::count();
                            @endphp

                            @if($activeTab2 === $child['heading'])
                                <div class="card-section">
                                    <div class="card-title">
                                        <h1>{{ $child['heading'] }}
                                            <x-filament::badge>{{ $titleCounts }}</x-filament::badge>
                                        </h1>

                                        <x-filament::button wire:click="mountAction('{{ $child['add_action'] }}')" icon="heroicon-o-plus" class="edit-btn">
                                            Add {{ $child['singular'] }}
                                        </x-filament::button>
                                    </div>
                                    
                                    <div class="project-table">
                                        <table class="project-table">
                                            @if($child['model'] === \App\Models\Why::class)                                            
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th width="600">Description</th>
                                                        <th width="80">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach(
                                                        $child['model']::orderBy($child['orderBy'] ?? 'id')->get()
                                                        as $record
                                                    )
                                                        <tr>                                                          
                                                            <td>{{ $record->title }}</td>
                                                            <td>
                                                                <p>{{ Str::limit($record->description, 70) }}</p>
                                                            </td>
                                                            <td class="project-table_actions">
                                                                @include('filament.btn2', [
                                                                    'record' => $record,
                                                                    'section' => $section,
                                                                ])
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            
                                            @elseif($child['model'] === \App\Models\Testimonial::class)
                                                <thead>
                                                    <tr>
                                                        <th>Photo</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th width="80">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach(
                                                        $child['model']::orderBy($child['orderBy'] ?? 'id')->get()
                                                        as $record
                                                    )
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
                                                                @include('filament.btn2', [
                                                                    'record' => $record,
                                                                    'section' => $section,
                                                                ])
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                            @elseif($child['model'] === \App\Models\Event::class)
                                                <thead>
                                                    <tr>
                                                        <th width="80">Image</th>
                                                        <th>Event Title</th>                                    
                                                        <th>Description</th>
                                                        <th width="80">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach(
                                                        $child['model']::orderBy($child['orderBy'] ?? 'id')->get()
                                                        as $record
                                                    )
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
                                                                @include('filament.btn2', [
                                                                    'record' => $record,
                                                                    'section' => $section,
                                                                ])
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                {{-- Other sections --}}
                @if(in_array($section['heading'], ['Pages','Users']))
                    <x-filament::button wire:click="mountAction('{{ $section['add_action'] }}')" icon="heroicon-o-plus" class="edit-btn">
                        Add {{ $section['singular'] ?? rtrim($section['heading'], 's') }}
                    </x-filament::button>

                    <div class="card-wrapper">
                        @if($section['model'] === \App\Models\User::class)
                            <div class="project-table">
                                <table class="project-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>                                        
                                            <th width="80">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($section['model']::get() as $record)
                                            <tr>                                                                                
                                                <td>{{ $record->name }}</td>
                                                <td>{{ $record->email }}</td>
                                                <td>
                                                    @php
                                                        $class = match (strtolower($record->role)) {
                                                            'user' => 'role-user',
                                                            'author' => 'role-author',
                                                            'admin' => 'role-admin',
                                                            default => '',
                                                        };
                                                    @endphp
                                                    <span class="project-category {{ $class }}">
                                                        {{ ucfirst($record->role) }}
                                                    </span>
                                                </td>
                                                <td class="project-table_actions">  
                                                    @include('filament.btns', [
                                                        'record' => $record,
                                                        'section' => $section,
                                                    ])                                                   
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
                                                    @include('filament.btns', [
                                                        'record' => $record,
                                                        'section' => $section,
                                                    ])
                                                </td>
                                            </tr>                                    
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        @endif
                    </div>
                @endif
            </x-filament::section>
        @endif
    @endforeach

    <x-filament-actions::modals />
</x-filament-panels::page>