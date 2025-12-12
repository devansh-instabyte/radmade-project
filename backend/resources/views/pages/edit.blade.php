@extends('layouts.main')

@section('title', 'Edit Page')

@section('content')

<div class="max-w-8xl mx-auto">

    <form action="{{ route('admin.updatepage', $page->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- LEFT SIDE -->
            <div class="bg-white p-6 rounded-lg shadow-md space-y-6">

                <!-- Page Title -->
                <div>
                    <label class="block font-semibold mb-1">Page Title</label>
                    <input type="text" name="title" 
                           value="{{ $page->title }}"
                           class="w-full p-3 border rounded-lg">
                </div>

                <!-- Slug -->
                <div>
                    <label class="block font-semibold mb-1">Slug</label>
                    <input type="text" name="slug"
                           value="{{ $page->slug }}"
                           class="w-full p-3 border rounded-lg">
                </div>

                <!-- Content -->
                <div>
                    <label class="block font-semibold mb-1">Content</label>
                    <textarea name="content" id="content" rows="10"
                              class="w-full p-3 border rounded-lg">{{ $page->content }}</textarea>
                </div>

                <!-- Meta Title -->
                <div>
                    <label class="block font-semibold mb-1">Meta Title</label>
                    <input type="text" name="meta_title"
                           value="{{ $page->meta_title }}"
                           class="w-full p-3 border rounded-lg">
                </div>

                <!-- Meta Keywords -->
                <div>
                    <label class="block font-semibold mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keywords"
                           value="{{ $page->meta_keywords }}"
                           class="w-full p-3 border rounded-lg">
                </div>

                <!-- Meta Description -->
                <div>
                    <label class="block font-semibold mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="4"
                              class="w-full p-3 border rounded-lg">{{ $page->meta_description }}</textarea>
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-semibold mb-1">Status</label>
                    <select name="status" class="w-full p-3 border rounded-lg">
                        <option value="1" {{ $page->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $page->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-[#0A3A5C] text-white py-3 rounded-lg text-lg font-semibold">
                    Update Page
                </button>

            </div>

            <!-- RIGHT SIDE - LAYOUT SELECTION -->
            <div class="bg-white p-6 rounded-lg shadow-md">

                <h2 class="text-xl font-bold mb-4">Choose Layout</h2>

                <!-- Hidden layout input -->
                <input type="hidden" name="layout" id="selectedLayout" value="{{ $page->layout }}">

                <!-- Layout Select Buttons -->
                <div class="space-y-3">

                    <button type="button"
                        class="layout-btn w-full p-3 rounded-lg text-left font-semibold
                            {{ $page->layout == 'slider' ? 'bg-blue-200' : 'bg-gray-100' }}"
                        data-target="sliderForm">Slider</button>

                    <button type="button"
                        class="layout-btn w-full p-3 rounded-lg text-left font-semibold
                            {{ $page->layout == 'carousel' ? 'bg-blue-200' : 'bg-gray-100' }}"
                        data-target="carouselForm">Carousel</button>

                    <button type="button"
                        class="layout-btn w-full p-3 rounded-lg text-left font-semibold
                            {{ $page->layout == 'grid' ? 'bg-blue-200' : 'bg-gray-100' }}"
                        data-target="gridForm">Grid Columns (2) With Image + Text</button>

                        <button type="button"
                        class="layout-btn w-full p-3 rounded-lg text-left font-semibold
                            {{ $page->layout == 'banner' ? 'bg-blue-200' : 'bg-gray-100' }}"
                        data-target="bannerForm">
                        Banner Sections
                    </button>   


                </div>

                <!-- LAYOUT FORMS -->
                <div class="mt-6">

                    <!-- SLIDER FORM -->
                    <div id="sliderForm"
                         class="{{ $page->layout == 'slider' ? '' : 'hidden' }} p-4 border rounded-lg bg-gray-50">

                        <h3 class="font-bold mb-4">Sliders</h3>

                        <div id="sliderContainer" class="space-y-4">

                            @foreach ($sliders as $i => $slider)
                            <div class="slider-item p-4 border rounded bg-white relative">
                                <!-- Delete button -->
                                <button type="button"
                                    class="delete-slider absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    Delete
                                </button>

                                <h4 class="font-semibold mb-2">Slider {{ $i+1 }}</h4>

                                <!-- Existing ID -->
                                <input type="hidden" name="slider_ids[]" value="{{ $slider->id }}">

                                <img src="{{ asset('storage/'.$slider->image) }}" class="w-32 rounded mb-2">

                                <input type="file" name="slider_images[]" class="w-full border p-2 rounded mb-2">

                                <input type="text" name="slider_titles[]" 
                                       value="{{ $slider->title }}"
                                       class="w-full p-2 border rounded mb-2">

                                <textarea name="slider_descriptions[]"
                                          class="w-full p-2 border rounded">{{ $slider->description }}</textarea>
                            </div>
                            @endforeach

                        </div>

                        <!-- Optional: Add new slider button -->
                        
                        <button type="button" id="addSliderBtn"
                                class="mt-4 bg-green-500 text-white px-4 py-2 rounded">
                            + Add Slider
                        </button>
                    
                    </div>

                    <!-- CAROUSEL FORM -->
                    <div id="carouselForm"
                        class="{{ $page->layout == 'carousel' ? '' : 'hidden' }} p-4 border rounded-lg bg-gray-50">

                        <h3 class="font-bold mb-4">Carousel Settings</h3>

                        @php
                            $settings = $carouselItems->first();
                        @endphp

                        <!-- Carousel Settings -->
                        <div class="grid grid-cols-2 gap-4 mb-6">

                            <div>
                                <label class="block font-semibold mb-1">Items (Desktop)</label>
                                <input type="number" name="carousel_items_desktop" min="1" max="10"
                                    class="w-full border p-2 rounded"
                                    value="{{ $settings->items_desktop ?? 3 }}">
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Items (Tablet)</label>
                                <input type="number" name="carousel_items_tablet" min="1" max="10"
                                    class="w-full border p-2 rounded"
                                    value="{{ $settings->items_tablet ?? 2 }}">
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Items (Mobile)</label>
                                <input type="number" name="carousel_items_mobile" min="1" max="10"
                                    class="w-full border p-2 rounded"
                                    value="{{ $settings->items_mobile ?? 1 }}">
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Autoplay</label>
                                <select name="carousel_autoplay" class="w-full border p-2 rounded">
                                    <option value="1" {{ ($settings->autoplay ?? 1) == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ ($settings->autoplay ?? 1) == 0 ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Autoplay Speed (ms)</label>
                                <input type="number" name="carousel_speed"
                                    class="w-full border p-2 rounded"
                                    value="{{ $settings->speed ?? 3000 }}">
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Loop</label>
                                <select name="carousel_loop" class="w-full border p-2 rounded">
                                    <option value="1" {{ ($settings->loop ?? 1) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ ($settings->loop ?? 1) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Navigation Arrows</label>
                                <select name="carousel_nav" class="w-full border p-2 rounded">
                                    <option value="1" {{ ($settings->nav ?? 1) == 1 ? 'selected' : '' }}>Show</option>
                                    <option value="0" {{ ($settings->nav ?? 1) == 0 ? 'selected' : '' }}>Hide</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Dots</label>
                                <select name="carousel_dots" class="w-full border p-2 rounded">
                                    <option value="1" {{ ($settings->dots ?? 1) == 1 ? 'selected' : '' }}>Show</option>
                                    <option value="0" {{ ($settings->dots ?? 1) == 0 ? 'selected' : '' }}>Hide</option>
                                </select>
                            </div>
                        </div>

                        <!-- Carousel Items -->
                        <h3 class="font-bold mb-2">Carousel Items</h3>

                        <div id="carouselContainer" class="space-y-4">

                            @foreach ($carouselItems as $i => $item)
                            <div class="carousel-item p-4 border rounded bg-white relative">
                                <!-- Delete button -->
                                <button type="button"
                                    class="delete-carousel absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    Delete
                                </button>

                                <h4 class="font-semibold mb-2">Item {{ $i+1 }}</h4>

                                <!-- Existing ID -->
                                <input type="hidden" name="carousel_ids[]" value="{{ $item->id }}">

                                <img src="{{ asset('storage/'.$item->image) }}" class="w-32 rounded mb-2">

                                <input type="file" name="carousel_images[]" class="w-full border p-2 rounded mb-2">

                                <input type="text" name="carousel_titles[]" 
                                    value="{{ $item->title }}"
                                    class="w-full border p-2 rounded mb-2">

                                <textarea name="carousel_descriptions[]" 
                                        class="w-full border p-2 rounded">{{ $item->description }}</textarea>
                            </div>
                            @endforeach

                        </div>

                        <!-- Add More Items Button -->
                        <button type="button" id="addCarouselItemBtn"
                                class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                            + Add Carousel Item
                        </button>

                    </div>


                    <!-- GRID FORM -->
                    <div id="gridForm"
                         class="{{ $page->layout == 'grid' ? '' : 'hidden' }} p-4 border rounded-lg bg-gray-50">

                        <h3 class="font-bold mb-4">Grid Sections</h3>

                        <div id="gridContainer" class="space-y-4">

                            @foreach ($gridItems as $i => $g)
                            <div class="grid-block p-4 border rounded bg-white relative">
                                <!-- Delete button -->
                                <button type="button"
                                    class="delete-grid absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    Delete
                                </button>

                                <h4 class="font-semibold mb-2">Section {{ $i+1 }}</h4>

                                <!-- Existing ID -->
                                <input type="hidden" name="grid_ids[]" value="{{ $g->id }}">

                                <img src="{{ asset('storage/'.$g->image) }}" class="w-32 mb-2 rounded">

                                <input type="file" name="grid_images[]" class="w-full border p-2 rounded mb-2">

                                <input type="text" name="grid_titles[]" value="{{ $g->title }}"
                                       class="w-full border p-2 rounded mb-2">

                                <textarea name="grid_descriptions[]" 
                                          class="w-full border p-2 rounded mb-2">{{ $g->description }}</textarea>

                                <select name="grid_layouts[]" class="w-full border p-2 rounded">
                                    <option value="left" {{ $g->layout == 'left' ? 'selected' : '' }}>Image Left Text Right</option>
                                    <option value="right" {{ $g->layout == 'right' ? 'selected' : '' }}>Image Right Text Left</option>
                                </select>
                            </div>
                            @endforeach

                        </div>

                        <!-- Add Grid Section Button -->
                        <button type="button" id="addGridBtn"
                                class="mt-4 bg-purple-600 text-white px-4 py-2 rounded">
                            + Add Section
                        </button>

                    </div>


                    <!-- Banner Form -->
                     <!-- BANNER FORM -->
<div id="bannerForm"
     class="{{ $page->layout == 'banner' ? '' : 'hidden' }} p-4 border rounded-lg bg-gray-50">

    <h3 class="font-bold mb-4">Banner Sections</h3>

    <div id="bannerContainer" class="space-y-4">

        @foreach ($bannerItems as $i => $b)
        <div class="banner-block p-4 border rounded bg-white relative">

            <!-- Delete Button -->
            <button type="button"
                class="delete-banner absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                Delete
            </button>

            <h4 class="font-semibold mb-3">Banner {{ $i+1 }}</h4>

            <input type="hidden" name="banner_ids[]" value="{{ $b->id }}">

            <!-- Background Image -->
            <label class="block font-semibold mb-1">Background Image</label>
            @if($b->bg_image)
                <img src="{{ asset('storage/'.$b->bg_image) }}" class="w-32 mb-2 rounded">
            @endif
            <input type="file" name="banner_bg_image[]" class="w-full border p-2 rounded mb-3">

            <!-- Main Image -->
            <label class="block font-semibold mb-1">Main Image</label>
            @if($b->image)
                <img src="{{ asset('storage/'.$b->image) }}" class="w-32 mb-2 rounded">
            @endif
            <input type="file" name="banner_image[]" class="w-full border p-2 rounded mb-3">

            <!-- Text Image -->
            <label class="block font-semibold mb-1">Text Image</label>
            @if($b->text_img)
                <img src="{{ asset('storage/'.$b->text_img) }}" class="w-32 mb-2 rounded">
            @endif
            <input type="file" name="banner_text_img[]" class="w-full border p-2 rounded mb-3">

            <!-- Title -->
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="banner_titles[]" value="{{ $b->title }}"
                   class="w-full border p-2 rounded mb-3">

            <!-- Subtitle -->
            <label class="block font-semibold mb-1">Subtitle</label>
            <input type="text" name="banner_subtitles[]" value="{{ $b->subtitle }}"
                   class="w-full border p-2 rounded mb-3">

            <!-- Button 1 -->
            <label class="block font-semibold mb-1">Button 1 Text</label>
            <input type="text" name="banner_button1_text[]" value="{{ $b->button1_text }}"
                   class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Button 1 Link</label>
            <input type="text" name="banner_button1_link[]" value="{{ $b->button1_link }}"
                   class="w-full border p-2 rounded mb-3">

            <!-- Button 2 -->
            <label class="block font-semibold mb-1">Button 2 Text</label>
            <input type="text" name="banner_button2_text[]" value="{{ $b->button2_text }}"
                   class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Button 2 Link</label>
            <input type="text" name="banner_button2_link[]" value="{{ $b->button2_link }}"
                   class="w-full border p-2 rounded mb-3">

        </div>
        @endforeach
    </div>

    <button type="button" id="addBannerBtn"
            class="mt-4 bg-orange-500 text-white px-4 py-2 rounded">
        + Add Banner Section
    </button>
</div>



                    <!-- end -->

                </div>
            </div>

        </div>

    </form>
</div>


<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

<script>
ClassicEditor.create(document.querySelector('#content'));
</script>

<script src="{{asset('assets/backend/page.js')}}"></script>

{{-- Initial count for grid sections --}}
<script>
    const initialGridCount = {{ count($gridItems ?? []) }};
</script>




@endsection
