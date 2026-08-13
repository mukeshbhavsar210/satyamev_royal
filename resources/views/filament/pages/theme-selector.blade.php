@php
    $statePath = $getStatePath();
    $themes = [
        'default' => [
            'name' => 'Default',
            'image' => asset('images/themes/dog1.jpg'),
        ],
        'modern' => [
            'name' => 'Modern',
            'image' => asset('images/themes/dog2.jpg'),
        ],
        'classic' => [
            'name' => 'Classic',
            'image' => asset('images/themes/dog3.jpg'),
        ],
    ];
@endphp

<div class="theme-selector">    
    @foreach ($themes as $value => $theme)
        <label class="theme-option">
            <input type="radio" value="{{ $value }}" wire:model="{{ $statePath }}" >
            <div class="theme-card">
                <img src="{{ $theme['image'] }}" alt="{{ $theme['name'] }}" style="width:100%; height:100%;" >
                <div class="theme-name">{{ $theme['name'] }}</div>
            </div>
        </label>
    @endforeach
</div>