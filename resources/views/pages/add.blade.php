@extends('layouts.main')

@section('title', 'Add New Page')

@section('content')

<div class="max-w-8xl mx-auto">

    <form action="{{ route('admin.addpage') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-8">

            <!-- LEFT SIDE -->
            <div class="bg-white p-6 rounded-lg shadow-md space-y-6">

                <!-- Page Title -->
                <div>
                    <label class="block font-semibold mb-1">Page Title</label>
                    <input type="text" name="title" 
                           class="w-full p-3 border rounded-lg"
                           placeholder="Enter page title" required>
                </div>

                <!-- Slug -->
                <div>
                    <label class="block font-semibold mb-1">Slug</label>
                    <input type="text" name="slug"
                           class="w-full p-3 border rounded-lg"
                           placeholder="example-page-slug">
                </div>

                <!-- Content -->
                <div>
                    <label class="block font-semibold mb-1">Content</label>
                    <textarea name="content" id="content" rows="10"
                              class="w-full p-3 border rounded-lg"
                              placeholder="Enter page content"></textarea>
                </div>

                <!-- Meta Title -->
                <div>
                    <label class="block font-semibold mb-1">Meta Title</label>
                    <input type="text" name="meta_title" class="w-full p-3 border rounded-lg">
                </div>

                <!-- Meta Keywords -->
                <div>
                    <label class="block font-semibold mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="w-full p-3 border rounded-lg">
                </div>

                <!-- Meta Description -->
                <div>
                    <label class="block font-semibold mb-1">Meta Description</label>
                    <textarea name="meta_description" class="w-full p-3 border rounded-lg" rows="4"></textarea>
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-semibold mb-1">Status</label>
                    <select name="status" class="w-full p-3 border rounded-lg">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="submit"
                    class="w-full bg-[#0A3A5C] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#082d47]">
                    Add New Page
                </button>

            </div>

            <!-- RIGHT SIDE -->
            <div class="bg-white p-6 rounded-lg shadow-md">

                <h2 class="text-xl font-bold mb-4">Choose Layout</h2>

                <!-- Buttons -->
                <div class="space-y-3">
                    <button type="button" class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
                            data-target="sliderForm">Slider</button>

                    <button type="button" class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
                            data-target="carouselForm">Carousel</button>

                    <button type="button" class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
                            data-target="gridForm">Grid Columns (2) With Image + Text</button>

                            <button type="button"
                        class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
                        data-target="grid3Form">
                        Grid Columns (3) Image + Text + Button
                    </button>


                            
                    <button type="button" class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
                            data-target="bannerForm">Banner Sections</button>
                    
                    <button type="button" class="layout-btn w-full bg-gray-100 p-3 rounded-lg text-left font-semibold"
                            data-target="logosForm">Division Logos</button>

                </div>

                <!-- Forms -->
                <div class="mt-6">

                    <!-- SLIDER FORM -->
                    <div id="sliderForm" class="hidden p-4 border rounded-lg bg-gray-50">

                        <h3 class="font-bold mb-4">Sliders</h3>

                        <div id="sliderContainer" class="space-y-4">

                            <!-- Slider 1 Default -->
                            <div class="slider-item p-4 border rounded bg-white">
                                <h4 class="font-semibold mb-2">Slider 1</h4>

                                <input type="file" name="slider_images[]" class="w-full border p-2 rounded mb-2">

                                <input type="text" name="slider_titles[]" placeholder="Slider Title"
                                       class="w-full p-2 border rounded mb-2">

                                <textarea name="slider_descriptions[]" placeholder="Slider Description"
                                          class="w-full p-2 border rounded"></textarea>
                            </div>

                        </div>

                        <button type="button" id="addSliderBtn"
                                class="mt-4 bg-green-500 text-white px-4 py-2 rounded">
                            + Add Slider
                        </button>

                    </div>

                    <!-- ----------------------------------------------------------------------------------- -->
                     <!-- Carousel Form -->
                    <div id="carouselForm" class="hidden p-4 border rounded-lg bg-gray-50">

                        <h3 class="font-bold mb-4">Carousel Settings</h3>

                        <!-- Carousel Settings -->
                        <div class="grid grid-cols-2 gap-4 mb-6">

                            <div>
                                <label class="block font-semibold mb-1">Items (Desktop)</label>
                                <input type="number" name="carousel_items_desktop" min="1" max="10"
                                    class="w-full border p-2 rounded" value="3">
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Items (Tablet)</label>
                                <input type="number" name="carousel_items_tablet" min="1" max="10"
                                    class="w-full border p-2 rounded" value="2">
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Items (Mobile)</label>
                                <input type="number" name="carousel_items_mobile" min="1" max="10"
                                    class="w-full border p-2 rounded" value="1">
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Autoplay</label>
                                <select name="carousel_autoplay" class="w-full border p-2 rounded">
                                    <option value="1" selected>Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Autoplay Speed (ms)</label>
                                <input type="number" name="carousel_speed" class="w-full border p-2 rounded" value="3000">
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Loop</label>
                                <select name="carousel_loop" class="w-full border p-2 rounded">
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Navigation Arrows</label>
                                <select name="carousel_nav" class="w-full border p-2 rounded">
                                    <option value="1" selected>Show</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold mb-1">Dots</label>
                                <select name="carousel_dots" class="w-full border p-2 rounded">
                                    <option value="1" selected>Show</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>

                        </div>

                        <!-- Carousel Items -->
                        <h3 class="font-bold mb-2">Carousel Items</h3>

                        <div id="carouselContainer" class="space-y-4">

                            <div class="carousel-item p-4 border rounded bg-white">
                                <h4 class="font-semibold mb-2">Item 1</h4>

                                <input type="file" name="carousel_images[]" class="w-full border p-2 rounded mb-2">
                                <input type="text" name="carousel_titles[]" placeholder="Title (optional)"
                                    class="w-full border p-2 rounded mb-2">

                                <textarea name="carousel_descriptions[]" placeholder="Description (optional)"
                                        class="w-full border p-2 rounded"></textarea>
                            </div>

                        </div>

                        <button type="button" id="addCarouselItemBtn"
                                class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                            + Add Carousel Item
                        </button>

                    </div>

                    <!-- ----------------------------------------------------------------------------------- -->

                    <!-- Grid -->
                    <!-- GRID FORM -->
                <div id="gridForm" class="hidden p-4 border rounded-lg bg-gray-50">

                    <h3 class="font-bold mb-4">2-Column Grid Sections</h3>

                    <div id="gridContainer" class="space-y-4">

                        <!-- Default Grid Block -->
                        <div class="grid-block p-4 border rounded bg-white">
                            <h4 class="font-semibold mb-3">Section <span class="section-number">1</span></h4>

                            <input type="hidden" name="grid_section_ids[]" value="grid1">

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


                    </div>

                    <button type="button" id="addGridBtn"
                            class="mt-4 bg-purple-600 text-white px-4 py-2 rounded">
                        + Add Section
                    </button>

                </div>
            <!-- end -->


            <!-- 3 Column Grid Section -->
             <!-- ===================== 3 COLUMN GRID FORM ===================== -->
<div id="grid3Form" class="hidden p-4 border rounded-lg bg-gray-50">

    <h3 class="font-bold mb-4">3-Column Grid Section</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <!-- COLUMN 1 -->
        <div class="p-4 border rounded bg-white">
            <h4 class="font-semibold mb-3">Column 1</h4>

            <label class="block font-semibold mb-1">Image</label>
            <input type="file" name="grid3_images[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="grid3_titles[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Description</label>
            <textarea name="grid3_descriptions[]" class="w-full border p-2 rounded mb-3"></textarea>

            <label class="block font-semibold mb-1">Button Text</label>
            <input type="text" name="grid3_button_texts[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Button Link</label>
            <input type="text" name="grid3_button_links[]" class="w-full border p-2 rounded">
        </div>

        <!-- COLUMN 2 -->
        <div class="p-4 border rounded bg-white">
            <h4 class="font-semibold mb-3">Column 2</h4>

            <input type="file" name="grid3_images[]" class="w-full border p-2 rounded mb-3">
            <input type="text" name="grid3_titles[]" class="w-full border p-2 rounded mb-3">
            <textarea name="grid3_descriptions[]" class="w-full border p-2 rounded mb-3"></textarea>
            <input type="text" name="grid3_button_texts[]" class="w-full border p-2 rounded mb-3">
            <input type="text" name="grid3_button_links[]" class="w-full border p-2 rounded">
        </div>

        <!-- COLUMN 3 -->
        <div class="p-4 border rounded bg-white">
            <h4 class="font-semibold mb-3">Column 3</h4>

            <input type="file" name="grid3_images[]" class="w-full border p-2 rounded mb-3">
            <input type="text" name="grid3_titles[]" class="w-full border p-2 rounded mb-3">
            <textarea name="grid3_descriptions[]" class="w-full border p-2 rounded mb-3"></textarea>
            <input type="text" name="grid3_button_texts[]" class="w-full border p-2 rounded mb-3">
            <input type="text" name="grid3_button_links[]" class="w-full border p-2 rounded">
        </div>

    </div>
</div>
<!-- ===================== END ===================== -->

            <!-- end -->

                        <!-- BANNER FORM -->
                        <div id="bannerForm" class="hidden p-4 border rounded-lg bg-gray-50">

                            <h3 class="font-bold mb-4">Banner Sections</h3>

                            <div id="bannerContainer" class="space-y-4">

                                <!-- Default Banner Block -->
                                <div class="banner-block p-4 border rounded bg-white">
                                    <h4 class="font-semibold mb-3">Banner 1</h4>

                                    <label class="block font-semibold mb-1">Background Image</label>
                                    <input type="file" name="banner_bg_image[]" class="w-full border p-2 rounded mb-3">

                                    <label class="block font-semibold mb-1">Main Image</label>
                                    <input type="file" name="banner_image[]" class="w-full border p-2 rounded mb-3">

                                    <label class="block font-semibold mb-1">Text Image</label>
                                    <input type="file" name="banner_text_img[]" class="w-full border p-2 rounded mb-3">

                                    <label class="block font-semibold mb-1">Title</label>
                                    <input type="text" name="banner_title[]" class="w-full border p-2 rounded mb-3">

                                    <label class="block font-semibold mb-1">Subtitle</label>
                                    <input type="text" name="banner_subtitle[]" class="w-full border p-2 rounded mb-3">

                                    <!-- Button 1 -->
                                    <label class="block font-semibold mb-1">Button 1 Text</label>
                                    <input type="text" name="banner_button1_text[]" class="w-full border p-2 rounded mb-3">

                                    <label class="block font-semibold mb-1">Button 1 Link</label>
                                    <input type="text" name="banner_button1_link[]" class="w-full border p-2 rounded mb-3">

                                    <!-- Button 2 -->
                                    <label class="block font-semibold mb-1">Button 2 Text</label>
                                    <input type="text" name="banner_button2_text[]" class="w-full border p-2 rounded mb-3">

                                    <label class="block font-semibold mb-1">Button 2 Link</label>
                                    <input type="text" name="banner_button2_link[]" class="w-full border p-2 rounded mb-3">
                                </div>

                            </div>

                            <button type="button" id="addBannerBtn"
                                    class="mt-4 bg-orange-500 text-white px-4 py-2 rounded">
                                + Add Banner Section
                            </button>

                        </div>


                        <!-- ---------------------------------------------Division Logos------------------------------- -->
                         <div id="logosForm" class="hidden p-4 border rounded-lg bg-gray-50">

                                <h3 class="font-bold mb-4">Division Logos</h3>

                                <div id="logoContainer" class="space-y-4">

                                    <div class="logo-block p-4 border rounded bg-white">
                                        <h4 class="font-semibold mb-2">Logo 1</h4>

                                        <label class="block font-semibold mb-1">Logo Image</label>
                                        <input type="file" name="logo_images[]" class="w-full border p-2 rounded mb-2">
                                    </div>

                                </div>

                                <button type="button" id="addLogoBtn"
                                        class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded">
                                    + Add Logo
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
@endsection




