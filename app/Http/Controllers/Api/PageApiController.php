<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;
use App\Models\Settings;

class PageApiController extends Controller
{
   public function homepage()
{
    $page = Page::where('slug', 'home-3')
        ->with(['layouts' => function ($q) {
            $q->orderBy('sort_order');
        }])
        ->first();

    if (!$page) {
        return response()->json([
            'settings' => [
                'logo' => $settings?->logo
                    ? asset('storage/' . $settings->logo)
                    : null,     
            ],
            'page' => null,
            'sections' => []
        ]);
    }
     $settings = Settings::first(); 

    return response()->json([
        'settings' => [
           'logo' => $settings?->logo
                    ? asset('storage/' . $settings->logo)
                    : null,  
        ],
        'page' => [
            'title'   => $page->title,
            'content' => $page->content,
        ],
        'sections' => $page->layouts->map(function ($layout) {

            $data = $layout->data;

            /* 🔹 Normalize images based on section type */
            switch ($layout->type) {

                case 'slider':
                    $data['slides'] = collect($data['slides'] ?? [])
                        ->map(fn ($item) => $this->mapImages($item))
                        ->values();
                    break;

                case 'grid':
                case 'grid_3':
                    $data['items'] = collect($data['items'] ?? [])
                        ->map(fn ($item) => $this->mapImages($item))
                        ->values();
                    break;

                case 'banner':
                    $data = collect($data)
                        ->map(fn ($item) => $this->mapImages($item))
                        ->values();
                    break;

                case 'logos':
                    $data['logos'] = collect($data['logos'] ?? [])
                        ->map(fn ($logo) => asset('storage/' . $logo))
                        ->values();
                    break;
            }

            return [
                'id'         => $layout->id,
                'type'       => $layout->type,
                'sort_order' => $layout->sort_order, // 🔥 VERY IMPORTANT
                'data'       => $data,
            ];
        })->values()
    ]);
}

/* 🔹 Helper function for image URLs */
private function mapImages(array $item)
{
    foreach (['image', 'bg_image', 'text_img'] as $key) {
        if (!empty($item[$key])) {
            $item[$key] = asset('storage/' . $item[$key]);
        }
    }
    return $item;
}

}
