@foreach($apartments as $apartment)
    <div class="apart-cms_list_item w-dyn-item">
        <a hover-apart-card="" href="{{ route('apartments.details', $apartment->id) }}" class="apart-card w-inline-block">
            <div class="apart-card_c">
                <div class="apart-card_t">
                    <h2 class="l2 a-center">{{ $apartment->apartment_name }}</h2>
                    <div class="u-4"></div>
                    <p class="l2 reg a-center"><span>Completion: </span><span>{{ \Carbon\Carbon::parse($apartment->completion)->format('F Y') }}</span></p>
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
                    <div class="apart-card_data-list">
                        <p class="l2 reg a-center"><span>Units: {{ $apartment->units }}</span></p>
                    </div>
                    <div class="u-16"></div>
                    <div class="apart-card_info">
                        <h3 class="h5">
                            <span>{{ $apartment->rooms }}</span><span>&nbsp;bed</span>
                        </h3>
                        <div class="h5">/</div>
                        <h4 class="h5">
                            <span>{{ $apartment->area }}</span>
                        </h4>
                    </div>
                    <div class="u-16"></div>
                </div>

                <div class="apart-card_t">
                    <h2 data-type="ground-floor-basement" class="l2 a-center">{{ $apartment->category }}</h2>
                </div>
            </div>                      
            <div hover="shadow" class="apart-card_shadow"></div>
        </a>
    </div>
@endforeach