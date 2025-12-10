// edit page & add page js
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



// <!-- end -->

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

