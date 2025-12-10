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
                        data-target="gridForm">2 Grid Columns With Image + Text</button>

                </div>

                <!-- LAYOUT FORMS -->
                <div class="mt-6">

                    <!-- SLIDER FORM -->
                    <div id="sliderForm"
                         class="{{ $page->layout == 'slider' ? '' : 'hidden' }} p-4 border rounded-lg bg-gray-50">

                        <h3 class="font-bold mb-4">Sliders</h3>

                        <div id="sliderContainer" class="space-y-4">

                            @foreach ($sliders as $i => $slider)
                            <div class="slider-item p-4 border rounded bg-white">
                                <h4 class="font-semibold mb-2">Slider {{ $i+1 }}</h4>

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
                            <div class="carousel-item p-4 border rounded bg-white">
                                <h4 class="font-semibold mb-2">Item {{ $i+1 }}</h4>

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
                            <div class="grid-block p-4 border rounded bg-white">
                                <h4 class="font-semibold mb-2">Section {{ $i+1 }}</h4>

                                <img src="{{ asset('storage/'.$g->image) }}" class="w-32 mb-2 rounded">

                                <input type="file" name="grid_images[]" class="w-full border p-2 rounded mb-2">

                                <input type="text" name="grid_titles[]" value="{{ $g->title }}"
                                       class="w-full border p-2 rounded mb-2">

                                <textarea name="grid_descriptions[]" 
                                          class="w-full border p-2 rounded mb-2">{{ $g->description }}</textarea>

                                <select name="grid_layouts[]" class="w-full border p-2 rounded">
                                    <option value="left" {{ $g->layout == 'left' ? 'selected' : '' }}>Image Left</option>
                                    <option value="right" {{ $g->layout == 'right' ? 'selected' : '' }}>Image Right</option>
                                </select>
                            </div>
                            @endforeach

                        </div>

                    </div>

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

@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {

    // layout switch
    const buttons = document.querySelectorAll(".layout-btn");
    const layoutInput = document.getElementById("selectedLayout");

    buttons.forEach(btn => {
        btn.addEventListener("click", function () {

            // hide all
            document.querySelectorAll("#sliderForm, #carouselForm, #gridForm")
                .forEach(s => s.classList.add("hidden"));

            // show selected
            const target = this.getAttribute("data-target");
            document.getElementById(target).classList.remove("hidden");

            // update layout value
            layoutInput.value = target.replace("Form","");

            // highlight
            buttons.forEach(b => b.classList.remove("bg-blue-200"));
            this.classList.add("bg-blue-200");
        });
    });

});
</script>


<!-- Add Slider Button -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    let sliderIndex = 1;

    document.getElementById("addSliderBtn").addEventListener("click", function () {

        sliderIndex++;

        const sliderContainer = document.getElementById("sliderContainer");

        const html = `
            <div class="slider-item p-4 border rounded bg-white mt-4">
                <h4 class="font-semibold mb-2">Slider ${sliderIndex}</h4>

                <input type="file" name="slider_images[]" class="w-full border p-2 rounded mb-2">
                <input type="text" name="slider_titles[]" placeholder="Slider Title"
                       class="w-full p-2 border rounded mb-2">

                <textarea name="slider_descriptions[]" placeholder="Slider Description"
                          class="w-full p-2 border rounded"></textarea>
            </div>`;

        sliderContainer.insertAdjacentHTML("beforeend", html);
    });

});
</script>

<!-- Carousel Add Item Button -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

    let carouselIndex = 1;

    document.getElementById("addCarouselItemBtn").addEventListener("click", function () {

        carouselIndex++;

        const container = document.getElementById("carouselContainer");

        const html = `
            <div class="carousel-item p-4 border rounded bg-white mt-4">
                <h4 class="font-semibold mb-2">Item ${carouselIndex}</h4>

                <input type="file" name="carousel_images[]" class="w-full border p-2 rounded mb-2">

                <input type="text" name="carousel_titles[]" placeholder="Title (optional)"
                       class="w-full border p-2 rounded mb-2">

                <textarea name="carousel_descriptions[]" placeholder="Description (optional)"
                          class="w-full border p-2 rounded"></textarea>
            </div>
        `;

        container.insertAdjacentHTML("beforeend", html);
    });

});
</script>
<!-- end -->


<!-- grid images -->
<script>
    document.addEventListener("DOMContentLoaded", () => {

    let gridIndex = 1;
    const gridContainer = document.getElementById("gridContainer");
    const addGridBtn = document.getElementById("addGridBtn");

    // Grid Block Template Function
    const gridTemplate = (index) => `
        <div class="grid-block p-4 border rounded bg-white mt-4">
            <h4 class="font-semibold mb-3">Section ${index}</h4>

            <label class="block font-semibold mb-1">Image</label>
            <input type="file" name="grid_images[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="grid_titles[]" class="w-full border p-2 rounded mb-3" placeholder="Enter Title">

            <label class="block font-semibold mb-1">Description</label>
            <textarea name="grid_descriptions[]" class="w-full border p-2 rounded mb-3" placeholder="Enter Description"></textarea>

            <label class="block font-semibold mb-1">Layout</label>
            <select name="grid_layouts[]" class="w-full border p-2 rounded">
                <option value="left">Image Left – Text Right</option>
                <option value="right">Image Right – Text Left</option>
            </select>
        </div>
    `;

    // Add New Section
    addGridBtn?.addEventListener("click", () => {
        gridIndex++;
        gridContainer.insertAdjacentHTML("beforeend", gridTemplate(gridIndex));
    });

});

</script>

<!-- end -->

<!-- Layout Selection Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".layout-btn");

    buttons.forEach(btn => {
        btn.addEventListener("click", function () {

            document.querySelectorAll("#sliderForm, #carouselForm, #gridForm")
                .forEach(section => section.classList.add("hidden"));

            const target = this.getAttribute("data-target");
            document.getElementById(target).classList.remove("hidden");

            buttons.forEach(b => b.classList.remove("bg-blue-200"));
            this.classList.add("bg-blue-200");

        });
    });

});
</script>
