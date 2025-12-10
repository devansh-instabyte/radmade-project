@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Card -->
        <div class="p-6 bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-lg font-semibold text-blue-900">Total Pages</h5>
                    <p class="text-3xl font-bold mt-2 text-blue-700">{{$pagecount}}</p>
                </div>
                <div class="bg-blue-500 text-white p-3 rounded-lg">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="p-6 bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-lg font-semibold text-green-900">Total Menus</h5>
                    <p class="text-3xl font-bold mt-2 text-green-700">5</p>
                </div>
                <div class="bg-green-500 text-white p-3 rounded-lg">
                    <i class="fas fa-bars text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="p-6 bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-lg font-semibold text-purple-900">Users</h5>
                    <p class="text-3xl font-bold mt-2 text-purple-700">25</p>
                </div>
                <div class="bg-purple-500 text-white p-3 rounded-lg">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="p-6 bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h5 class="text-lg font-semibold text-red-900">Visits</h5>
                    <p class="text-3xl font-bold mt-2 text-red-700">1,200</p>
                </div>
                <div class="bg-red-500 text-white p-3 rounded-lg">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
