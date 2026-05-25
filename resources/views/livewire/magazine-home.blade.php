<div>
    <section class="teasers-row teasers-row-with-sidebar max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
 
     {{-- Section Header --}}
    <ul class="grid-container">
        <!-- Left Content Area (2/3 Width) -->
        <li class="col-1-1 medium-col-1-2 large-col-2-3">
            
            <!-- Block 1: Dynamic Row Aggregation -->
            <section class="headline-teasers">
                <section class="nested-cols headline-teasers_row">
                    <div class="col-1-1">
                        <ol class="nested-cols">
                            
                            <!-- Dynamic Structural Element: Large Top Feature -->
                            @foreach($featuredLargeLeft->take(1) as $article)
                            <li class="col-1-1 headline-teasers_item">
                                <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" aria-label="{{ $article->title }}" class="teaser-image-large" tentacle-id="{{ $article->tentacle_id }}">
                                    <article class="nested-cols">
                                        <div class="col-1-1 large-col-right large-col-2-3">
                                            @if($article->image_path)
                                            <figure class="lazy-img-container img-space_landscape_ratio3x2">
                                                <img src="{{ $article->image_path }}" class="blk-img" alt="Visual Asset for {{ $article->title }}">
                                            </figure>
                                            @endif
                                        </div>
                                        <div class="col-1-1 large-col-1-3 teaser-image-large_summary">
                                            <h3 class="teaser-image-large_title title-medium">
                                                @if($article->is_prime)
                                                <span class="prime-teaser-label">
                                                    <svg version="1.1" viewBox="0 0 46 14"><rect fill="#000000" width="46" height="14"></rect><text transform="matrix(1 0 0 1 2 12)" fill="#FFFFFF" font-family="'Roboto'" font-weight="500" font-size="14px">PRIME</text></svg>
                                                </span>
                                                @endif
                                                {{ $article->title }}
                                            </h3>
                                            <p class="teaser-image-large_paragraph text-block">{{ $article->summary ?? 'Soma zaidi hapa' }}</p>
                                            <aside class="article-metadata">
                                                <span>
                                                    <span class="article-topic article-metadata_topic">{{ $article->category->name }}</span>
                                                    <span class="date">{{ $article->published_at->diffForHumans() }}</span>
                                                </span>
                                            </aside>
                                        </div>
                                    </article>
                                </a>
                            </li>
                            @endforeach

                            <!-- Dynamic Text Teasers Layout Component -->
                            @foreach($textTeasers as $article)
                            <li class="col-1-1 large-col-1-2 headline-teasers_item">
                                <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" aria-label="{{ $article->title }}" class="teaser-image-none article-collection-teaser" tentacle-id="{{ $article->tentacle_id }}">
                                    <article class="teaser-image-none_inner">
                                        <h3 class="teaser-image-none_title title-extra-small">
                                            @if($article->is_prime)
                                            <span class="prime-teaser-label">
                                                <svg version="1.1" viewBox="0 0 46 14"><rect fill="#000000" width="46" height="14"></rect><text transform="matrix(1 0 0 1 2 12)" fill="#FFFFFF" font-family="'Roboto'" font-weight="500" font-size="14px">PRIME</text></svg>
                                            </span>
                                            @endif
                                            {{ $article->title }}
                                        </h3>
                                        <aside class="article-metadata">
                                            <span>
                                                <span class="article-topic article-metadata_topic">{{ $article->category->name }}</span>
                                                <span class="date">{{ $article->published_at->diffForHumans() }}</span>
                                            </span>
                                        </aside>
                                    </article>
                                </a>
                            </li>
                            @endforeach

                            <!-- Dynamic Split Thumbnail Component Layer -->
                            @foreach($rightThumbnails->take(1) as $article)
                            <li class="col-1-1 large-col-1-2 headline-teasers_item">
                                <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" aria-label="{{ $article->title }}" class="teaser-image-right article-collection-teaser" tentacle-id="{{ $article->tentacle_id }}">
                                    <article class="nested-cols">
                                        <div class="teaser-image-right_summary col-3-4">
                                            <h3 class="teaser-image-right_title title-extra-small">{{ $article->title }}</h3>
                                            <aside class="article-metadata">
                                                <span>
                                                    <span class="article-topic article-metadata_topic">{{ $article->category->name }}</span>
                                                    <span class="date">{{ $article->published_at->diffForHumans() }}</span>
                                                </span>
                                            </aside>
                                        </div>
                                        <div class="col-1-4">
                                            @if($article->image_path)
                                            <figure class="lazy-img-container img-space_portrait_ratio1x1">
                                                <img src="{{ $article->image_path }}" class="blk-img" alt="Thumbnail for {{ $article->title }}">
                                            </figure>
                                            @endif
                                        </div>
                                    </article>
                                </a>
                            </li>
                            @endforeach

                        </ol>
                        <hr class="headline-teasers_row-divider">
                    </div>
                </section>

                <!-- Embedded Middleware Advertisement Placeholder Breakpoint -->
                <div class="ad-mobile-leaderboard_wrap" data-role="ad-wrapper">
                    <div id="mobile-home-row-ad-1" class="ad-mobile-leaderboard">
                        <!-- Dynamic script integration target -->
                    </div>
                </div>

                <!-- Block 2: Secondary Content Area Block Loop -->
                <section class="nested-cols headline-teasers_row">
                    <div class="col-1-1">
                        <ol class="nested-cols">
                            @foreach($featuredLargeLeft->skip(1)->take(1) as $article)
                            <li class="col-1-1 headline-teasers_item">
                                <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" class="teaser-image-large" tentacle-id="{{ $article->tentacle_id }}">
                                    <article class="nested-cols">
                                        <div class="col-1-1 large-col-1-2 large-col-right">
                                            <figure class="lazy-img-container img-space_landscape_ratio3x2">
                                                <img src="{{ $article->image_path }}" class="blk-img" alt="{{ $article->title }}">
                                            </figure>
                                        </div>
                                        <div class="col-1-1 large-col-1-2 teaser-image-large_summary">
                                            <h3 class="teaser-image-large_title title-normal">
                                                @if($article->is_prime)
                                                <span class="prime-teaser-label">
                                                    <svg version="1.1" viewBox="0 0 46 14"><rect fill="#000000" width="46" height="14"></rect><text transform="matrix(1 0 0 1 2 12)" fill="#FFFFFF" font-family="'Roboto'" font-weight="500" font-size="14px">PRIME</text></svg>
                                                </span>
                                                @endif
                                                {{ $article->title }}
                                            </h3>
                                            <p class="teaser-image-large_paragraph text-block">{{ $article->summary }}</p>
                                            <aside class="article-metadata">
                                                <span><span class="article-topic article-metadata_topic">{{ $article->category->name }}</span><span class="date">{{ $article->published_at->diffForHumans() }}</span></span>
                                            </aside>
                                        </div>
                                    </article>
                                </a>
                            </li>
                            @endforeach
                        </ol>
                        <hr class="headline-teasers_row-divider">
                    </div>
                </section>

                <!-- Block 3: Text Only Description Segment -->
                @if($inlineTextTeaser->count() > 0)
                <section class="nested-cols headline-teasers_row">
                    <div class="col-1-1">
                        <ol class="nested-cols">
                            @foreach($inlineTextTeaser as $article)
                            <li class="col-1-1 headline-teasers_item">
                                <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" class="teaser-text article-collection-teaser" tentacle-id="{{ $article->tentacle_id }}">
                                    <article class="teaser-text_inner nested-cols">
                                        <div class="col-1-1 large-col-1-2">
                                            <h3 class="title-small teaser-text_title">{{ $article->title }}</h3>
                                        </div>
                                        <div class="col-1-1 large-col-1-2">
                                            <p class="text-block teaser-text_paragraph">{{ $article->summary }}</p>
                                            <aside class="article-metadata">
                                                <span><span class="article-topic article-metadata_topic">{{ $article->category->name }}</span><span class="date">{{ $article->published_at->diffForHumans() }}</span></span>
                                            </aside>
                                        </div>
                                    </article>
                                </a>
                            </li>
                            @endforeach
                        </ol>
                        <hr class="headline-teasers_row-divider">
                    </div>
                </section>
                @endif

                <!-- Block 4: Multi-variant Bottom Elements -->
                <section class="nested-cols headline-teasers_row">
                    <div class="col-1-1">
                        <ol class="nested-cols">
                            @foreach($rightThumbnails->skip(1) as $article)
                            <li class="col-1-1 headline-teasers_item">
                                <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" class="teaser-image-right article-collection-teaser" tentacle-id="{{ $article->tentacle_id }}">
                                    <article class="nested-cols">
                                        <div class="teaser-image-right_summary col-1-1 medium-col-3-4">
                                            <h3 class="teaser-image-right_title title-small">
                                                @if($article->is_prime)
                                                <span class="prime-teaser-label">
                                                    <svg version="1.1" viewBox="0 0 46 14"><rect fill="#000000" width="46" height="14"></rect><text transform="matrix(1 0 0 1 2 12)" fill="#FFFFFF" font-family="'Roboto'" font-weight="500" font-size="14px">PRIME</text></svg>
                                                </span>
                                                @endif
                                                {{ $article->title }}
                                            </h3>
                                            <aside class="article-metadata">
                                                <span><span class="article-topic article-metadata_topic">{{ $article->category->name }}</span><span class="date">{{ $article->published_at->diffForHumans() }}</span></span>
                                            </aside>
                                        </div>
                                        <div class="col-1-4">
                                            <figure class="lazy-img-container img-space_landscape_ratio3x2">
                                                <img src="{{ $article->image_path }}" class="blk-img" alt="{{ $article->title }}">
                                            </figure>
                                        </div>
                                    </article>
                                </a>
                            </li>
                            @endforeach
                        </ol>
                        <hr class="headline-teasers_row-divider">
                    </div>
                </section>

            </section>
        </li>

        <!-- Right Sidebar Area Layout Definition (1/3 Width) -->
        <li class="col-1-1 medium-col-1-2 large-col-1-3">
            <div class="ad-mobile-leaderboard_wrap" data-role="ad-wrapper">
                <div id="mobile-home-sidebar" class="ad-mobile-leaderboard"></div>
            </div>

            <!-- Video Dynamic Playback Component Element -->
            @if($activeVideo)
            <section class="teasers-row_category nested-cols">
                <div class="col-1-1">
                    <header class="teasers-row_header">
                        <h2 class="section-label" style="background: #F5911E; color:#FFFFFF;">
                            <a href="/ms/video">Video</a>
                        </h2>
                    </header>
                    <ol class="article-collection">
                        <li>
                            <div class="html-embed article-collection-teaser">
                                <iframe width="100%" height="240" src="https://www.youtube.com/embed/{{ $activeVideo->youtube_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </li>
                    </ol>
                </div>
            </section>
            @endif

            <!-- Dynamic Latest Feed Pipeline -->
            <section class="teasers-row_category nested-cols">
                <div class="col-1-1">
                    <header class="teasers-row_header">
                        <h2 class="section-label" style="background: #F5911E; color:#FFFFFF;">
                            <a href="/ms/latest">Latest</a>
                        </h2>
                    </header>
                    <ol class="article-collection">
                        @foreach($latestFeed as $feedItem)
                        <li>
                            <a href="/ms/{{ $feedItem->category->slug }}/{{ $feedItem->slug }}" class="teaser-image-right article-collection-teaser" tentacle-id="{{ $feedItem->tentacle_id }}">
                                <article class="nested-cols">
                                    <div class="teaser-image-right_summary col-3-4">
                                        <h3 class="teaser-image-right_title title-extra-small">{{ $feedItem->title }}</h3>
                                        <aside class="article-metadata">
                                            <span><span class="article-topic article-metadata_topic">{{ $feedItem->category->name }}</span><span class="date">{{ $feedItem->published_at->diffForHumans() }}</span></span>
                                        </aside>
                                    </div>
                                    <div class="col-1-4">
                                        @if($feedItem->image_path)
                                        <figure class="lazy-img-container img-space_portrait_ratio1x1">
                                            <img src="{{ $feedItem->image_path }}" class="blk-img" alt="{{ $feedItem->title }}">
                                        </figure>
                                        @endif
                                    </div>
                                </article>
                            </a>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </section>
        </li>
    </ul>
</section>
</div>