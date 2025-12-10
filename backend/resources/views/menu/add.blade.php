@extends('layouts.main')

@section('title', 'Add New Page')

@section('content')


<div class="max-w-12xl mx-auto ">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- LEFT SIDE FORM -->
        <div>

            <div class="bg-white p-6 rounded-lg shadow-md">

                <form action="" method="POST" class="space-y-6">
                    @csrf

                    <!-- Page Title -->
                    <div>
                        <label class="block font-semibold text-[#0A3A5C] mb-1">Page Title</label>
                        <input 
                            type="text" 
                            name="title"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5FA7D4] focus:outline-none"
                            placeholder="Enter page title"
                            required>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label class="block font-semibold text-[#0A3A5C] mb-1">Slug</label>
                        <input 
                            type="text"
                            name="slug"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5FA7D4] focus:outline-none"
                            placeholder="example-page-slug">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block font-semibold text-[#0A3A5C] mb-1">Status</label>
                        <select 
                            name="status"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5FA7D4] focus:outline-none">
                            
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full bg-[#0A3A5C] text-white py-3 rounded-lg text-lg font-semibold hover:bg-[#082d47] transition">
                        Add New Menu
                    </button>

                </form>

            </div>

        </div>

   
        </div>

    </div>

</div>




@endsection



<script>
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
</script>

