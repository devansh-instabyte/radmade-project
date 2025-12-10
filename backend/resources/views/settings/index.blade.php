@extends('layouts.main')

@section('title', 'Settings')

@section('content')

<div class="max-w-6xl mx-auto">


    <form action="{{ route('admin.settings') }}" method="POST" enctype="multipart/form-data"
        class="space-y-8 bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        @csrf


        <!-- REUSABLE COMPONENT STYLE -->
        @php
            $fields = [
                ['label' => 'Logo',        'name' => 'logo',        'field' => 'logo',    'width' => 'w-32'],
                ['label' => 'Footer Logo', 'name' => 'flogo',       'field' => 'flogo',   'width' => 'w-32'],
                ['label' => 'Banner 1',    'name' => 'banner_1',    'field' => 'banner1', 'width' => 'w-32'],
                ['label' => 'Banner 2',    'name' => 'banner_2',    'field' => 'banner2', 'width' => 'w-32'],
                ['label' => 'Banner 3',    'name' => 'banner_3',    'field' => 'banner3', 'width' => 'w-32'],
            ];
        @endphp


        @foreach ($fields as $item)
        <div class="p-4 bg-gray-50 border rounded-lg">

            <label class="block font-semibold text-[#0A3A5C] mb-2">{{ $item['label'] }}</label>

            <div class="flex items-start gap-4">

                {{-- Preview Box --}}
                @if($setting->{$item['field']})
                    <div class="relative {{ $item['width'] }}">
                        <img src="{{ asset('storage/'.$setting->{$item['field']}) }}"
                             class="{{ $item['width'] }} rounded-lg shadow">

                        <a href="{{ route('admin.removeSettingImage', ['field' => $item['field']]) }}"
                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full px-2 py-1 text-xs hover:bg-red-700 shadow">
                            ✕
                        </a>
                    </div>
                @else
                    <div class="flex items-center justify-center {{ $item['width'] }} h-24 border-2 border-dashed border-gray-300 rounded-lg text-gray-400">
                        No Image
                    </div>
                @endif

                {{-- Upload Input --}}
                <div class="flex-1">
                    <input type="file" name="{{ $item['name'] }}"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5FA7D4] bg-white">
                </div>

            </div>

        </div>
        @endforeach


        <!-- SUBMIT BUTTON -->
        <button type="submit"
            class="w-full py-3 bg-[#0A3A5C] text-white rounded-lg text-lg font-semibold hover:bg-[#082d47] transition">
            Update Settings
        </button>

    </form>

</div>

@endsection
