<x-filament-panels::page>

    {{-- ========================================================= --}}
    {{-- PROJECTS --}}
    {{-- ========================================================= --}}

    <x-filament::section
        collapsible
        class="mb-6"
    >

        <x-slot name="heading">
            Projects

            <x-filament::button
                wire:click="mountAction('editProject')"
                icon="heroicon-o-plus"
            >
                Add Project
            </x-filament::button>
        </x-slot>

        

        <x-slot name="headerEnd">
            <x-filament::button
                wire:click="mountAction('editProject')"
                icon="heroicon-o-plus"
            >
                Add Project
            </x-filament::button>
        </x-slot>


        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

            @foreach(\App\Models\Project::orderBy('id')->get() as $project)

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

                    {{-- IMAGE --}}
                    <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800">

                        @if($project->image)

                            <img
                                src="{{ asset('storage/' . $project->image) }}"
                                alt="{{ $project->project_name }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <div class="flex h-full items-center justify-center text-gray-400">
                                No Image
                            </div>

                        @endif

                    </div>


                    {{-- TITLE --}}
                    <div class="p-4">

                        <h3 class="truncate text-sm font-semibold text-gray-950 dark:text-white">
                            {{ $project->project_name }}
                        </h3>

                        <div class="mt-3 flex items-center justify-between">

                            <x-filament::button
                                size="sm"
                                wire:click="mountAction(
                                    'editProject',
                                    { record: {{ $project->id }} }
                                )"
                            >
                                Edit
                            </x-filament::button>

                            <x-filament::button
                                size="sm"
                                color="danger"
                                wire:click="mountAction(
                                    'deleteProject',
                                    { record: {{ $project->id }} }
                                )"
                            >
                                Delete
                            </x-filament::button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </x-filament::section>


    {{-- ========================================================= --}}
    {{-- TIMELINE --}}
    {{-- ========================================================= --}}

    <x-filament::section
        collapsible
        collapsed
        class="mb-6"
    >

        <x-slot name="heading">
            Timeline

            <x-filament::button
                wire:click="mountAction('editTimeline')"
                icon="heroicon-o-plus"
            >
                Add Timeline
            </x-filament::button>
        </x-slot>

        <x-slot name="headerEnd">
            <x-filament::button
                wire:click="mountAction('editTimeline')"
                icon="heroicon-o-plus"
            >
                Add Timeline
            </x-filament::button>
        </x-slot>


        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

            @foreach(\App\Models\Timeline::orderBy('sort_order')->get() as $timeline)

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

                    {{-- IMAGE --}}
                    <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800">

                        @if($timeline->image)

                            <img
                                src="{{ asset('storage/' . $timeline->image) }}"
                                alt="{{ $timeline->title }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <div class="flex h-full items-center justify-center text-gray-400">
                                No Image
                            </div>

                        @endif

                    </div>


                    {{-- TITLE --}}
                    <div class="p-4">

                        <h3 class="truncate text-sm font-semibold text-gray-950 dark:text-white">
                            {{ $timeline->year }} - {{ $timeline->title }}
                        </h3>

                        <div class="mt-3 flex items-center justify-between">

                            <x-filament::button
                                size="sm"
                                wire:click="mountAction(
                                    'editTimeline',
                                    { record: {{ $timeline->id }} }
                                )"
                            >
                                Edit
                            </x-filament::button>

                            <x-filament::button
                                size="sm"
                                color="danger"
                                wire:click="mountAction(
                                    'deleteTimeline',
                                    { record: {{ $timeline->id }} }
                                )"
                            >
                                Delete
                            </x-filament::button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </x-filament::section>


    {{-- ========================================================= --}}
    {{-- APARTMENTS --}}
    {{-- ========================================================= --}}

    <x-filament::section
        collapsible
        collapsed
    >

        <x-slot name="heading">
            Apartments

             <x-filament::button
                wire:click="mountAction('editApartment')"
                icon="heroicon-o-plus"
            >
                Add Apartment
            </x-filament::button>
        </x-slot>

        <x-slot name="headerEnd">
            <x-filament::button
                wire:click="mountAction('editApartment')"
                icon="heroicon-o-plus"
            >
                Add Apartment
            </x-filament::button>
        </x-slot>


        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

            @foreach(\App\Models\Apartment::orderBy('id')->get() as $apartment)

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

                    {{-- IMAGE --}}
                    <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800">

                        @if($apartment->image)

                            <img
                                src="{{ asset('storage/' . $apartment->image) }}"
                                alt="{{ $apartment->name }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <div class="flex h-full items-center justify-center text-gray-400">
                                No Image
                            </div>

                        @endif

                    </div>


                    {{-- TITLE --}}
                    <div class="p-4">

                        <h3 class="truncate text-sm font-semibold text-gray-950 dark:text-white">
                            {{ $apartment->name }}
                        </h3>

                        <div class="mt-3 flex items-center justify-between">

                            <x-filament::button
                                size="sm"
                                wire:click="mountAction(
                                    'editApartment',
                                    { record: {{ $apartment->id }} }
                                )"
                            >
                                Edit
                            </x-filament::button>

                            <x-filament::button
                                size="sm"
                                color="danger"
                                wire:click="mountAction(
                                    'deleteApartment',
                                    { record: {{ $apartment->id }} }
                                )"
                            >
                                Delete
                            </x-filament::button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </x-filament::section>


    {{-- FILAMENT ACTION MODALS --}}
    <x-filament-actions::modals />

</x-filament-panels::page>