@extends('layout.app')

@section('content')
<div class="mx-auto max-w-7xl">
<livewire:frontend.category-teaser-row category-slug="soka" />
<livewire:frontend.category-teaser-row category-slug="burudani" />
<livewire:frontend.three-column-teaser-row category-slug="zanzibar" />
<livewire:frontend.video-teaser-row />
<livewire:frontend.spoti-kenya-teaser-row />
<livewire:frontend.spoti-majuu-teaser-row />
<livewire:frontend.picha-teaser-row />
</div>

@endsection
