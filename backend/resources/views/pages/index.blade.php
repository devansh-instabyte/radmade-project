@extends('layouts.main')

@section('title', 'Add New Page')

@section('content')


<div class="max-w-12xl mx-auto ">

    <div class="grid grid-cols-1 md:grid-cols-1 ">
        <div class="bg-white p-6 rounded-lg shadow ">
            <!-- table starts -->

            <table id="example" class="display">
        <thead>
            <tr>
                <th>Page Title</th>
                <th>Slug</th>
                <th>Meta Title</th>
                <th>Meta Keywords</th>
                <th>Meta Description</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td>{{$page->title}}</td>
                <td>{{$page->slug}}</td>
                 <td>{{$page->meta_title}}</td>
                <td>{{$page->meta_keywords}}</td>
                <td>{{$page->meta_description}}</td>
              

                @if($page->status == 1)
                <td> 
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                        Active
                    </span>
                </td>
                @else
                <td>
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                        Inactive
                    </span>
                </td>
                @endif
                
                <td>{{ $page->created_at->format('d M, Y') }}</td>  
                 <td>
    <a href="{{ route('admin.editpage', $page->id) }}" 
       class="text-blue-600 font-semibold hover:underline">
       Edit
    </a>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>

            <!-- ends -->
        </div>

    </div>

</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.tailwindcss.css">
@endpush



@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.5/js/dataTables.tailwindcss.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>

@endpush

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

