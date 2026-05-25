<div class="grid-container">
    <div class="col-1-1">
        <div class="page-date-and-tagline">
            <span class="page-tagline">{{ $this->tagline }}</span>
            
            <time class="page-date date" datetime="{{ $this->formattedDate['iso'] }}">
                {{ $this->formattedDate['human'] }}
            </time>
        </div>
    </div>
</div>