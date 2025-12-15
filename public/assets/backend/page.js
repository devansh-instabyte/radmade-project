  document.addEventListener("DOMContentLoaded", function () {

        const title = document.querySelector("input[name='title']");
        const slug = document.querySelector("input[name='slug']");

        // Function to convert title → slug
        function createSlug(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, "")    // remove special chars
                .replace(/\s+/g, "-")            // spaces → hyphens
                .replace(/-+/g, "-");            // remove duplicate hyphens
        }

        // Auto-generate slug when typing title
        title.addEventListener("input", function () {
            slug.value = createSlug(title.value);
        });
    });

// edit page js


document.addEventListener('DOMContentLoaded', function () {

    const sortable = new Sortable(
        document.getElementById('sortableSections'),
        {
            animation: 150,
            onEnd: function () {
                let order = [];

                document.querySelectorAll('#sortableSections li')
                    .forEach((el, index) => {
                        order.push({
                            type: el.dataset.type,
                            order: index + 1
                        });
                    });

                document.getElementById('sectionOrderInput').value =
                    JSON.stringify(order);
            }
        }
    );

});





// banner add layout selection
document.addEventListener("DOMContentLoaded", () => {

    let bannerIndex = 1;
    const bannerContainer = document.getElementById("bannerContainer");
    const addBannerBtn = document.getElementById("addBannerBtn");

    const bannerTemplate = (index) => `
        <div class="banner-block p-4 border rounded bg-white mt-4">
            <h4 class="font-semibold mb-3">Banner ${index}</h4>

            <label class="block font-semibold mb-1">Background Image</label>
            <input type="file" name="banner_bg_image[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Main Image</label>
            <input type="file" name="banner_image[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Text Image</label>
            <input type="file" name="banner_text_img[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="banner_titles[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Subtitle</label>
            <input type="text" name="banner_subtitles[]" class="w-full border p-2 rounded mb-3">

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
    `;

    addBannerBtn?.addEventListener("click", () => {
        bannerIndex++;
        bannerContainer.insertAdjacentHTML("beforeend", bannerTemplate(bannerIndex));
    });

});


// end

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



// Delete 

// Delete buttons (Slider, Carousel, Grid)
document.addEventListener("click", function (e) {
    const form = document.querySelector("form");
    if (!form) return;

    // Helper to add hidden delete input
    function addDeleteInput(name, id) {
        if (!id) return;
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = id;
        form.appendChild(input);
    }

    // SLIDER DELETE
    if (e.target.classList.contains("delete-slider")) {
        const block = e.target.closest(".slider-item");
        const idInput = block.querySelector("input[name='slider_ids[]']");
        addDeleteInput("delete_slider_ids[]", idInput ? idInput.value : null);
        block.remove();
    }

    // CAROUSEL DELETE
    if (e.target.classList.contains("delete-carousel")) {
        const block = e.target.closest(".carousel-item");
        const idInput = block.querySelector("input[name='carousel_ids[]']");
        addDeleteInput("delete_carousel_ids[]", idInput ? idInput.value : null);
        block.remove();
    }

    // GRID DELETE
    if (e.target.classList.contains("delete-grid")) {
        const block = e.target.closest(".grid-block");
        const idInput = block.querySelector("input[name='grid_ids[]']");
        addDeleteInput("delete_grid_ids[]", idInput ? idInput.value : null);
        block.remove();
    }
    // Banner Delete
    if (e.target.classList.contains("delete-banner")) {
        const block = e.target.closest(".banner-block"); // CORRECT BLOCK
        const idInput = block.querySelector("input[name='banner_ids[]']"); // CORRECT INPUT
        addDeleteInput("delete_banner_ids[]", idInput?.value); // CORRECT ARRAY NAME
        block.remove();
    }
});

// end

// <!-- Add Slider Button -->

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


   

// Delete buttons (Slider, Carousel, Grid)
document.addEventListener("click", function (e) {
    const form = document.querySelector("form");
    if (!form) return;

    // Helper to add hidden delete input
    function addDeleteInput(name, id) {
        if (!id) return;
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = id;
        form.appendChild(input);
    }

    // SLIDER DELETE
    if (e.target.classList.contains("delete-slider")) {
        const block = e.target.closest(".slider-item");
        const idInput = block.querySelector("input[name='slider_ids[]']");
        addDeleteInput("delete_slider_ids[]", idInput ? idInput.value : null);
        block.remove();
    }

    // CAROUSEL DELETE
    if (e.target.classList.contains("delete-carousel")) {
        const block = e.target.closest(".carousel-item");
        const idInput = block.querySelector("input[name='carousel_ids[]']");
        addDeleteInput("delete_carousel_ids[]", idInput ? idInput.value : null);
        block.remove();
    }

    // GRID DELETE
    if (e.target.classList.contains("delete-grid")) {
        const block = e.target.closest(".grid-block");
        const idInput = block.querySelector("input[name='grid_ids[]']");
        addDeleteInput("delete_grid_ids[]", idInput ? idInput.value : null);
        block.remove();
    }

     // LOGO DELETE
    if (e.target.classList.contains("delete-logo")) {
        const block = e.target.closest(".logo-block");
        const idInput = block.querySelector("input[name='logo_ids[]']");
        addDeleteInput("delete_logo_ids[]", idInput ? idInput.value : null);
        block.remove();
    }
});


// <!-- Carousel Add Item Button -->

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


// <!-- end -->





// <!-- grid images -->

//     document.addEventListener("DOMContentLoaded", () => {

//     let gridIndex = 1;
//     const gridContainer = document.getElementById("gridContainer");
//     const addGridBtn = document.getElementById("addGridBtn");

//     // Grid Block Template Function
//     const gridTemplate = (index) => `
//         <div class="grid-block p-4 border rounded bg-white mt-4">
//             <h4 class="font-semibold mb-3">Section ${index}</h4>

//             <label class="block font-semibold mb-1">Image</label>
//             <input type="file" name="grid_images[]" class="w-full border p-2 rounded mb-3">

//             <label class="block font-semibold mb-1">Title</label>
//             <input type="text" name="grid_titles[]" class="w-full border p-2 rounded mb-3" placeholder="Enter Title">

//             <label class="block font-semibold mb-1">Description</label>
//             <textarea name="grid_descriptions[]" class="w-full border p-2 rounded mb-3" placeholder="Enter Description"></textarea>

//             <label class="block font-semibold mb-1">Layout</label>
//             <select name="grid_layouts[]" class="w-full border p-2 rounded">
//                 <option value="left">Image Left – Text Right</option>
//                 <option value="right">Image Right – Text Left</option>
//             </select>
//         </div>
//     `;

//     // Add New Section
//     addGridBtn?.addEventListener("click", () => {
//         gridIndex++;
//         gridContainer.insertAdjacentHTML("beforeend", gridTemplate(gridIndex));
//     });

// });


// GRID SECTIONS + UNIQUE SECTION ID
document.addEventListener("DOMContentLoaded", () => {

    let gridIndex = document.querySelectorAll("#gridContainer .grid-block").length || 1;
    const gridContainer = document.getElementById("gridContainer");
    const addGridBtn = document.getElementById("addGridBtn");

    // Section ID generator
    const generateSectionId = (index) => `grid${index}`;

    // Grid Template
    const gridTemplate = (index) => `
        <div class="grid-block p-4 border rounded bg-white mt-4">
            <h4 class="font-semibold mb-3">Section ${index}</h4>

            <!-- ⭐ Section ID: grid1, grid2, grid3 -->
            <input type="hidden" name="grid_section_ids[]" value="${generateSectionId(index)}">

            <label class="block font-semibold mb-1">Image</label>
            <input type="file" name="grid_images[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="grid_titles[]" class="w-full border p-2 rounded mb-3">

            <label class="block font-semibold mb-1">Description</label>
            <textarea name="grid_descriptions[]" class="w-full border p-2 rounded mb-3"></textarea>

            <label class="block font-semibold mb-1">Layout</label>
            <select name="grid_layouts[]" class="w-full border p-2 rounded">
                <option value="left">Image Left – Text Right</option>
                <option value="right">Image Right – Text Left</option>
            </select>
        </div>
    `;

    // Add Grid Section
    addGridBtn?.addEventListener("click", () => {
        gridIndex++;
        gridContainer.insertAdjacentHTML("beforeend", gridTemplate(gridIndex));
    });

});




// <!-- end -->

// Division Logos Layout Selection
document.addEventListener("DOMContentLoaded", () => {

    let logoIndex = 1;
    const logoContainer = document.getElementById("logoContainer");
    const addLogoBtn = document.getElementById("addLogoBtn");

    if (addLogoBtn) {
        addLogoBtn.addEventListener("click", () => {
            logoIndex++;
            logoContainer.insertAdjacentHTML("beforeend", `
                <div class="logo-block p-4 border rounded bg-white mt-4">
                    <h4 class="font-semibold mb-2">Logo ${logoIndex}</h4>

                    <label class="block font-semibold mb-1">Logo Image</label>
                    <input type="file" name="logo_images[]" class="w-full border p-2 rounded mb-2">
                </div>
            `);
        });
    }

});

// end

// <!-- Layout Selection Script -->

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

