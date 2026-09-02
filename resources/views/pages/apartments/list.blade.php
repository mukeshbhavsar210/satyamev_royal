@foreach($apartments as $apartment)
    <div class="apart-cms_list_item w-dyn-item">
        <a hover-apart-card="" href="{{ route('apartments.details', $apartment->id) }}" class="apart-card w-inline-block">
            <div class="apart-card_c">
                <div class="apart-card_t">
                     <div class="apart-card_info">
                        <h3 class="h5">{{ $apartment->apartment_name }}</h3>
                    </div>
                    <div class="u-4"></div>
                    <p class="l2 reg a-center">{{ $apartment->project?->title ?? '-' }}</p>                    
                </div>
                <div class="u-16"></div>                

                <div class="apart-card_img">
                    <div class="apart-card_img_prim">
                        @if($apartment->image)
                            <img src="{{ asset('storage/' . $apartment->image) }}" loading="eager" alt="" alt="{{ $apartment->apartment_name }}" class="img contain_cover">
                        @else
                            <span>No image</span>
                        @endif
                    </div>
                </div>                        
            
                <div class="u-24"></div>

                <div class="apart-card_b">                    
                    @if($apartment->project->completion)
                        <div class="apart-card_data-list">
                            <p class="l2 reg a-center"><span>{{ \Carbon\Carbon::parse($apartment->project->completion)->format('F Y') }}</span></p>
                        </div>
                    @endif                    
                    @if($apartment->units)
                        <div class="apart-card_data-list">
                            <p class="l2 reg a-center"><span>Units: {{ $apartment->units }}</span></p>
                        </div>
                    @endif
                    <div class="u-16"></div>
                    <div class="apart-card_info">
                        @if($apartment->rooms)
                            <h6 class="h6">{{ $apartment->rooms }}</span><span>&nbsp;beds</h6>
                            <div class="h5">/</div>
                        @endif                        
                        @if($apartment->area)
                            <h6 class="h6">{{ $apartment->area }}</h6>
                        @endif
                    </div>
                    <div class="u-16"></div>
                </div>

                <div class="apart-card_t">
                    <h2 data-type="ground-floor-basement" class="l2 a-center">{{ $apartment->project->category }}</h2>
                </div>
            </div>                      
            <div hover="shadow" class="apart-card_shadow"></div>
        </a>
    </div>
@endforeach