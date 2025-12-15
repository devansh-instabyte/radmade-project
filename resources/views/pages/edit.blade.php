@extends('layouts.main')

@section('title', 'Edit Page')

@section('content')

<div class="max-w-8xl mx-auto">

<form action="{{ route('admin.updatepage', $page->id) }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-2 gap-8">

{{-- =====================================================
LEFT SIDE – PAGE DETAILS
===================================================== --}}
<div class="bg-white p-6 rounded-lg shadow-md space-y-6">

    <div>
        <label class="block font-semibold mb-1">Page Title</label>
        <input type="text" name="title" value="{{ $page->title }}"
               class="w-full p-3 border rounded-lg">
    </div>

    <div>
        <label class="block font-semibold mb-1">Slug</label>
        <input type="text" name="slug" value="{{ $page->slug }}"
               class="w-full p-3 border rounded-lg">
    </div>

    <div>
        <label class="block font-semibold mb-1">Content</label>
        <textarea name="content" id="content" rows="10"
                  class="w-full p-3 border rounded-lg">{{ $page->content }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1">Meta Title</label>
        <input type="text" name="meta_title" value="{{ $page->meta_title }}"
               class="w-full p-3 border rounded-lg">
    </div>

    <div>
        <label class="block font-semibold mb-1">Meta Keywords</label>
        <input type="text" name="meta_keywords" value="{{ $page->meta_keywords }}"
               class="w-full p-3 border rounded-lg">
    </div>

    <div>
        <label class="block font-semibold mb-1">Meta Description</label>
        <textarea name="meta_description" rows="4"
                  class="w-full p-3 border rounded-lg">{{ $page->meta_description }}</textarea>
    </div>

    <button class="w-full bg-[#0A3A5C] text-white py-3 rounded-lg text-lg font-semibold">
        Update Page
    </button>
</div>

{{-- =====================================================
RIGHT SIDE – LAYOUT BUILDER (ADD PAGE STYLE)
===================================================== --}}
<div class="bg-white p-6 rounded-lg shadow-md">

<h2 class="text-xl font-bold mb-4">Choose Layout</h2>

{{-- ===== Layout Buttons ===== --}}


<div class="space-y-3">
    <button
        type="button"
        class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
        data-target="sliderForm"
    >
        Slider
    </button>
    <button
        type="button"
        class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
        data-target="carouselForm"
    >
        Carousel
    </button>
    <button
        type="button"
        class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
        data-target="gridForm"
    >
        Grid Columns (2) With Image + Text
    </button>
    <button
        type="button"
        class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
        data-target="grid3Form"
    >
        Grid Columns (3) Image + Text + Button
    </button>
    <button
        type="button"
        class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
        data-target="bannerForm"
    >
        Banner Sections
    </button>
    <button
        type="button"
        class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
        data-target="logosForm"
    >
        Division Logos
    </button>
</div>


{{-- =====================================================
SLIDER FORM
===================================================== --}}
<div id="sliderForm" class="hidden mt-6 p-4 border rounded-lg bg-gray-50">
    <h3 class="font-bold mb-4">Sliders</h3>

    <div id="sliderContainer" class="space-y-4">

        @forelse($sliders as $item)
        <div class="slider-item p-4 border rounded bg-white">

            <input type="hidden" name="existing_slider_images[]" value="{{ $item['image'] ?? '' }}">

            @if(!empty($item['image']))
                <img src="{{ asset('storage/'.$item['image']) }}" class="w-32 mb-2">
            @endif

            <input type="file" name="slider_images[]" class="w-full border p-2 rounded mb-2">
            <input type="text" name="slider_titles[]" value="{{ $item['title'] }}"
                   class="w-full p-2 border rounded mb-2" placeholder="Slider Title">
            <textarea name="slider_descriptions[]" class="w-full p-2 border rounded"
                      placeholder="Slider Description">{{ $item['description'] }}</textarea>
        </div>
        @empty
        <div class="slider-item p-4 border rounded bg-white">
            <input type="hidden" name="existing_slider_images[]" value="">
            <input type="file" name="slider_images[]" class="w-full border p-2 rounded mb-2">
            <input type="text" name="slider_titles[]" class="w-full p-2 border rounded mb-2">
            <textarea name="slider_descriptions[]" class="w-full p-2 border rounded"></textarea>
        </div>
        @endforelse

    </div>

    <button type="button" id="addSliderBtn"
            class="mt-4 bg-green-500 text-white px-4 py-2 rounded">
        + Add Slider
    </button>
</div>

<!-- Carousel Form -->
<div id="carouselForm" class="hidden mt-6 p-4 border rounded bg-gray-50">
<h3 class="font-bold mb-4">Carousel</h3>

<div id="carouselContainer" class="space-y-4">

@forelse($carouselItems as $item)
<div class="carousel-item p-4 border rounded bg-white">

    @if(!empty($item['image']))
        <img src="{{ asset('storage/'.$item['image']) }}" class="w-32 mb-2">
    @endif

    <input type="hidden" name="existing_carousel_images[]" value="{{ $item['image'] ?? '' }}">

    <input type="file" name="carousel_images[]" class="w-full border p-2 rounded mb-2">

    <input type="text" name="carousel_titles[]" value="{{ $item['title'] ?? '' }}"
        class="w-full border p-2 rounded mb-2" placeholder="Title">

    <textarea name="carousel_descriptions[]" class="w-full border p-2 rounded"
        placeholder="Description">{{ $item['description'] ?? '' }}</textarea>
</div>
@empty
<div class="carousel-item p-4 border rounded bg-white">
    <input type="hidden" name="existing_carousel_images[]" value="">
    <input type="file" name="carousel_images[]" class="w-full border p-2 rounded mb-2">
    <input type="text" name="carousel_titles[]" class="w-full border p-2 rounded mb-2">
    <textarea name="carousel_descriptions[]" class="w-full border p-2 rounded"></textarea>
</div>
@endforelse

</div>



<button type="button" id="addCarouselItemBtn"
class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
+ Add Carousel Item
</button>
</div>


<!-- end -->



<!-- 2 Grid Form -->
<div id="gridForm" class="hidden mt-6 p-4 border rounded bg-gray-50">
<h3 class="font-bold mb-4">2 Column Grid</h3>

<div id="gridContainer" class="space-y-4">

@forelse($gridItems  as $section)
<div class="grid-block p-4 border rounded bg-white">

@if(!empty($section['image']))
<img src="{{ asset('storage/'.$section['image']) }}" class="w-32 mb-2">
@endif

<input type="hidden" name="existing_grid_images[]" value="{{ $section['image'] ?? '' }}">

<input type="file" name="grid_images[]" class="w-full border p-2 rounded mb-2">

<input type="text" name="grid_titles[]" value="{{ $section['title'] ?? '' }}"
class="w-full border p-2 rounded mb-2">

<textarea name="grid_descriptions[]" class="w-full border p-2 rounded mb-2">
{{ $section['description'] ?? '' }}
</textarea>

<select name="grid_layouts[]" class="w-full border p-2 rounded">
<option value="left" {{ $section['layout']=='left'?'selected':'' }}>Image Left</option>
<option value="right" {{ $section['layout']=='right'?'selected':'' }}>Image Right</option>
</select>

</div>
@empty
<div class="grid-block p-4 border rounded bg-white">
<input type="hidden" name="existing_grid_images[]" value="">
<input type="file" name="grid_images[]" class="w-full border p-2 rounded mb-2">
<input type="text" name="grid_titles[]" class="w-full border p-2 rounded mb-2">
<textarea name="grid_descriptions[]" class="w-full border p-2 rounded mb-2"></textarea>
<select name="grid_layouts[]" class="w-full border p-2 rounded">
<option value="left">Image Left</option>
<option value="right">Image Right</option>
</select>
</div>
@endforelse

</div>

<button type="button" id="addGridBtn"
class="mt-4 bg-purple-600 text-white px-4 py-2 rounded">
+ Add Grid Section
</button>
</div>

<!-- end -->


<!-- 3 Grid Form  -->

<div id="grid3Form" class="hidden mt-6 p-4 border rounded bg-gray-50">
<h3 class="font-bold mb-4">3 Column Grid</h3>

<div id="grid3Container" class="grid grid-cols-1 md:grid-cols-3 gap-4">

@foreach($grid3Items as $item)
<div class="p-4 border rounded bg-white">

@if(!empty($item['image']))
<img src="{{ asset('storage/'.$item['image']) }}" class="w-24 mb-2">
@endif

<input type="hidden" name="existing_grid3_images[]" value="{{ $item['image'] ?? '' }}">
<input type="file" name="grid3_images[]" class="w-full border p-2 rounded mb-2">

<input type="text" name="grid3_titles[]" value="{{ $item['title'] ?? '' }}"
class="w-full border p-2 rounded mb-2">

<textarea name="grid3_descriptions[]" class="w-full border p-2 rounded mb-2">
{{ $item['description'] ?? '' }}
</textarea>

<input type="text" name="grid3_button_texts[]" value="{{ $item['button_text'] ?? '' }}"
class="w-full border p-2 rounded mb-2">

<input type="text" name="grid3_button_links[]" value="{{ $item['button_link'] ?? '' }}"
class="w-full border p-2 rounded">
</div>
@endforeach

</div>
</div>

<!-- end -->

{{-- =====================================================
BANNER FORM
===================================================== --}}
<div id="bannerForm" class="hidden mt-6 p-4 border rounded-lg bg-gray-50">
    <h3 class="font-bold mb-4">Banner Sections</h3>

    <div id="bannerContainer" class="space-y-4">

        @forelse($bannerItems as $item)
        <div class="banner-block p-4 border rounded bg-white">

    {{-- BG IMAGE --}}
    @if(!empty($item['bg_image']))
        <img src="{{ asset('storage/'.$item['bg_image']) }}" class="w-32 mb-2 rounded">
    @endif
    <input type="hidden" name="existing_banner_bg_images[]" value="{{ $item['bg_image'] ?? '' }}">
    <input type="file" name="banner_bg_image[]" class="w-full border p-2 rounded mb-2">

    {{-- MAIN IMAGE --}}
    @if(!empty($item['image']))
        <img src="{{ asset('storage/'.$item['image']) }}" class="w-32 mb-2 rounded">
    @endif
    <input type="hidden" name="existing_banner_images[]" value="{{ $item['image'] ?? '' }}">
    <input type="file" name="banner_image[]" class="w-full border p-2 rounded mb-2">

    {{-- TEXT IMAGE --}}
    @if(!empty($item['text_img']))
        <img src="{{ asset('storage/'.$item['text_img']) }}" class="w-32 mb-2 rounded">
    @endif
    <input type="hidden" name="existing_banner_text_images[]" value="{{ $item['text_img'] ?? '' }}">
    <input type="file" name="banner_text_img[]" class="w-full border p-2 rounded mb-2">

    <input type="text" name="banner_titles[]" value="{{ $item['title'] ?? '' }}"
           class="w-full border p-2 rounded mb-2" placeholder="Title">

    <input type="text" name="banner_subtitles[]" value="{{ $item['subtitle'] ?? '' }}"
           class="w-full border p-2 rounded mb-2" placeholder="Subtitle">

    <input type="text" name="banner_button1_text[]" value="{{ $item['button1_text'] ?? '' }}"
           class="w-full border p-2 rounded mb-2" placeholder="Button 1 Text">

    <input type="text" name="banner_button1_link[]" value="{{ $item['button1_link'] ?? '' }}"
           class="w-full border p-2 rounded mb-2" placeholder="Button 1 Link">

    <input type="text" name="banner_button2_text[]" value="{{ $item['button2_text'] ?? '' }}"
           class="w-full border p-2 rounded mb-2" placeholder="Button 2 Text">

    <input type="text" name="banner_button2_link[]" value="{{ $item['button2_link'] ?? '' }}"
           class="w-full border p-2 rounded" placeholder="Button 2 Link">
</div>

        @empty
        <div class="banner-block p-4 border rounded bg-white">
            <input type="file" name="banner_bg_image[]" class="w-full border p-2 rounded mb-2">
            <input type="file" name="banner_image[]" class="w-full border p-2 rounded mb-2">
            <input type="file" name="banner_text_img[]" class="w-full border p-2 rounded mb-2">
            <input type="text" name="banner_titles[]" class="w-full border p-2 rounded mb-2">
            <input type="text" name="banner_subtitles[]" class="w-full border p-2 rounded mb-2">
            <input type="text" name="banner_button1_text[]" class="w-full border p-2 rounded mb-2">
            <input type="text" name="banner_button1_link[]" class="w-full border p-2 rounded mb-2">
            <input type="text" name="banner_button2_text[]" class="w-full border p-2 rounded mb-2">
            <input type="text" name="banner_button2_link[]" class="w-full border p-2 rounded">
        </div>
        @endforelse

    </div>

    <button type="button" id="addBannerBtn"
            class="mt-4 bg-orange-500 text-white px-4 py-2 rounded">
        + Add Banner Section
    </button>
</div>

{{-- =====================================================
LOGOS FORM
===================================================== --}}
<div id="logosForm" class="hidden mt-6 p-4 border rounded-lg bg-gray-50">
    <h3 class="font-bold mb-4">Division Logos</h3>

    <div id="logoContainer" class="space-y-4">
        @if(count($logos))
            @foreach($logos as $logo)
                <div class="logo-block p-3 border rounded bg-white">
                    <img src="{{ asset('storage/'.$logo) }}" class="w-24 mb-2 rounded">
                </div>
            @endforeach
        @endif
    </div>

    <button type="button" id="addLogoBtn"
        class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded">
        + Add Logo
    </button>
</div>


{{-- =====================================================
SECTION ORDER (UNCHANGED)
===================================================== --}}
<h3 class="font-bold mt-8 mb-3">Section Order</h3>

<ul id="sortableSections" class="space-y-2">
@foreach ($sortedSections as $row)
<li class="p-3 bg-gray-100 rounded cursor-move text-sm"
    data-type="{{ $row['type'] }}"
    data-ref="{{ $row['ref'] }}"
    data-index="{{ $row['index'] ?? '' }}">
    {{ strtoupper($row['type']) }}
</li>
@endforeach
</ul>

<input type="hidden" name="section_order" id="sectionOrderInput">

</div>
</div>
</form>
</div>

{{-- ================= SCRIPTS ================= --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script src="{{ asset('assets/backend/page.js') }}"></script>

<script>
ClassicEditor.create(document.querySelector('#content'));

new Sortable(document.getElementById('sortableSections'), {
    animation: 150,
    onSort() {
        let order = [];
        document.querySelectorAll('#sortableSections li').forEach((el, i) => {
            order.push({
                type: el.dataset.type,
                ref: el.dataset.ref,
                index: el.dataset.index ? parseInt(el.dataset.index) : null,
                sort_order: i + 1
            });
        });
        document.getElementById('sectionOrderInput').value = JSON.stringify(order);
    }
});



</script>

@endsection
