<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /* ===============================
        DASHBOARD
    =============================== */
    public function dashboard()
    {
        $pagecount = Page::count();
        return view('layouts.dashboard', compact('pagecount'));
    }

    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    /* ===============================
        CREATE PAGE (UNCHANGED)
    =============================== */
  public function create(Request $request)
{
    if (!$request->isMethod('post')) {
        return view('pages.add');
    }

    /* ===============================
        1. PAGE
    =============================== */
    $page = Page::create([
        'title'            => $request->title,
        'slug'             => Str::slug($request->slug ?? $request->title),
        'content'          => $request->content,
        'meta_title'       => $request->meta_title,
        'meta_keywords'    => $request->meta_keywords,
        'meta_description' => $request->meta_description,
        'status'           => $request->status ?? 1,
    ]);

    $sortOrder = 1;

    /* ===============================
        2. SLIDER
    =============================== */
    if (!empty($request->slider_titles)) {

        $slides = [];

        foreach ($request->slider_titles as $i => $title) {
            $slides[] = [
                'image' => $request->hasFile("slider_images.$i")
                    ? $request->file("slider_images.$i")->store('sliders', 'public')
                    : null,
                'title' => $title,
                'description' => $request->slider_descriptions[$i] ?? null,
            ];
        }

        PageLayout::create([
            'page_id'    => $page->id,
            'type'       => 'slider',
            'section_id' => 'slider1',
            'data'       => ['slides' => $slides],
            'sort_order' => $sortOrder++
        ]);
    }

    /* ===============================
        3. CAROUSEL
    =============================== */
    if (!empty($request->carousel_titles)) {

        $items = [];

        foreach ($request->carousel_titles as $i => $title) {
            $items[] = [
                'image' => $request->hasFile("carousel_images.$i")
                    ? $request->file("carousel_images.$i")->store('carousels', 'public')
                    : null,
                'title' => $title,
                'description' => $request->carousel_descriptions[$i] ?? null,
            ];
        }

        PageLayout::create([
            'page_id'    => $page->id,
            'type'       => 'carousel',
            'section_id' => 'carousel1',
            'data' => [
                'settings' => [
                    'desktop'  => $request->carousel_items_desktop,
                    'tablet'   => $request->carousel_items_tablet,
                    'mobile'   => $request->carousel_items_mobile,
                    'autoplay' => $request->carousel_autoplay,
                    'speed'    => $request->carousel_speed,
                    'loop'     => $request->carousel_loop,
                    'nav'      => $request->carousel_nav,
                    'dots'     => $request->carousel_dots,
                ],
                'items' => $items
            ],
            'sort_order' => $sortOrder++
        ]);
    }

    /* ===============================
        4. 2 COLUMN GRID (MULTIPLE SECTIONS)
    =============================== */
    if (!empty($request->grid_titles)) {

        $items = [];

        foreach ($request->grid_titles as $i => $title) {
            $items[] = [
                'image' => $request->hasFile("grid_images.$i")
                    ? $request->file("grid_images.$i")->store('grids', 'public')
                    : null,
                'title'       => $title,
                'description' => $request->grid_descriptions[$i] ?? null,
                'layout'      => $request->grid_layouts[$i] ?? 'left',
            ];
        }

        PageLayout::create([
            'page_id'    => $page->id,
            'type'       => 'grid',
            'section_id' => 'grid2',
            'data'       => [
                'columns' => 2,
                'items'   => $items
            ],
            'sort_order' => $sortOrder++
        ]);
    }

    /* ===============================
        5. 3 COLUMN GRID
    =============================== */
    if (!empty($request->grid3_titles)) {

        $items = [];

        foreach ($request->grid3_titles as $i => $title) {
            $items[] = [
                'image' => $request->hasFile("grid3_images.$i")
                    ? $request->file("grid3_images.$i")->store('grid3', 'public')
                    : null,
                'title'        => $title,
                'description'  => $request->grid3_descriptions[$i] ?? null,
                'button_text'  => $request->grid3_button_texts[$i] ?? null,
                'button_link'  => $request->grid3_button_links[$i] ?? null,
                'sort_order'   => $i + 1,
            ];
        }

        PageLayout::create([
            'page_id'    => $page->id,
            'type'       => 'grid_3',
            'section_id' => 'grid3',
            'data'       => [
                'columns' => 3,
                'items'   => $items
            ],
            'sort_order' => $sortOrder++
        ]);
    }

    /* ===============================
        6. BANNER (FULLY FIXED)
    =============================== */
    if (!empty($request->banner_title)) {

        $banners = [];

        foreach ($request->banner_title as $i => $title) {
            $banners[] = [
                'bg_image' => $request->hasFile("banner_bg_image.$i")
                    ? $request->file("banner_bg_image.$i")->store('banners/bg', 'public')
                    : null,

                'image' => $request->hasFile("banner_image.$i")
                    ? $request->file("banner_image.$i")->store('banners/main', 'public')
                    : null,

                'text_img' => $request->hasFile("banner_text_img.$i")
                    ? $request->file("banner_text_img.$i")->store('banners/text', 'public')
                    : null,

                'title'    => $title,
                'subtitle' => $request->banner_subtitle[$i] ?? null,

                'buttons' => [
                    [
                        'text' => $request->banner_button1_text[$i] ?? null,
                        'url'  => $request->banner_button1_link[$i] ?? null,
                    ],
                    [
                        'text' => $request->banner_button2_text[$i] ?? null,
                        'url'  => $request->banner_button2_link[$i] ?? null,
                    ]
                ]
            ];
        }

        PageLayout::create([
            'page_id'    => $page->id,
            'type'       => 'banner',
            'section_id' => 'banner1',
            'data'       => $banners,
            'sort_order' => $sortOrder++
        ]);
    }

    /* ===============================
        7. LOGOS
    =============================== */
    if ($request->hasFile('logo_images')) {

        $logos = [];

        foreach ($request->file('logo_images') as $logo) {
            $logos[] = $logo->store('logos', 'public');
        }

        PageLayout::create([
            'page_id'    => $page->id,
            'type'       => 'logos',
            'section_id' => 'logos1',
            'data'       => ['logos' => $logos],
            'sort_order' => $sortOrder++
        ]);
    }

    return redirect()
        ->back()
        ->with('success', 'Page Created Successfully!');
}


    /* ===============================
        EDIT PAGE (FIXED)
    =============================== */
  public function edit($id)
{
    $page = Page::with('layouts')->findOrFail($id);
    $layouts = $page->layouts->sortBy('sort_order')->values();

    // SAFE FETCHERS
    $sliderLayout  = $layouts->where('type','slider')->first();
    $gridLayout    = $layouts->where('type','grid')->first();
    $grid3Layout   = $layouts->where('type','grid_3')->first();
    $bannerLayout  = $layouts->where('type','banner')->first();
    $logosLayout   = $layouts->where('type','logos')->first();
    $carouselLayout = $layouts->where('type','carousel')->first();


    // ALWAYS PROVIDE DEFAULT STRUCTURE
    $sliders = $sliderLayout->data['slides'] ?? [
        ['image'=>null,'title'=>null,'description'=>null]
    ];

    $gridItems = $gridLayout->data['items'] ?? [
        ['image'=>null,'title'=>null,'description'=>null,'layout'=>'left']
    ];

    $grid3Items = $grid3Layout->data['items'] ?? [
        ['image'=>null,'title'=>null,'description'=>null,'button_text'=>null,'button_link'=>null],
        ['image'=>null,'title'=>null,'description'=>null,'button_text'=>null,'button_link'=>null],
        ['image'=>null,'title'=>null,'description'=>null,'button_text'=>null,'button_link'=>null],
    ];

    $bannerItems = $bannerLayout->data ?? [
        [
            'bg_image'=>null,
            'image'=>null,
            'text_img'=>null,
            'title'=>null,
            'subtitle'=>null,
            'button1_text'=>null,
            'button1_link'=>null,
            'button2_text'=>null,
            'button2_link'=>null,
        ]
    ];

    $carouselItems = $carouselLayout->data['items'] ?? [
    ['image'=>null,'title'=>null,'description'=>null]
];

    $logos = $logosLayout->data['logos'] ?? [];

    /* 🔥 SECTION ORDER (UNCHANGED) */
    $sortedSections = [];
    foreach ($layouts as $layout) {
        $sortedSections[] = [
            'type' => $layout->type,
            'ref'  => $layout->id,
        ];

        if ($layout->type === 'grid') {
            foreach ($layout->data['items'] ?? [] as $i => $item) {
                $sortedSections[] = [
                    'type' => 'grid_item',
                    'ref'  => $layout->id,
                    'index'=> $i,
                    'layout_position' => $item['layout'] ?? 'left',
                ];
            }
        }
    }

    return view('pages.edit', compact(
        'page',
        'sliders',
        'carouselItems',
        'gridItems',
        'grid3Items',
        'bannerItems',
        'logos',
        'sortedSections'
    ));
}



    /* ===============================
        UPDATE PAGE (FIXED)
    =============================== */
  public function update(Request $request, $id)
{
    $page = Page::findOrFail($id);

    /* ===============================
        BASIC PAGE UPDATE
    =============================== */
    $page->update([
        'title'            => $request->title,
        'slug'             => Str::slug($request->slug ?? $request->title),
        'content'          => $request->content,
        'meta_title'       => $request->meta_title,
        'meta_keywords'    => $request->meta_keywords,
        'meta_description' => $request->meta_description,
        'status'           => $request->status ?? 1,
    ]);

    /* ===============================
        GRID (2 COLUMN)
    =============================== */
    if ($request->grid_titles) {

        $items = [];

        foreach ($request->grid_titles as $i => $title) {
            $items[] = [
                'image' => $request->hasFile("grid_images.$i")
                    ? $request->file("grid_images.$i")->store('grids', 'public')
                    : ($request->existing_grid_images[$i] ?? null),

                'title'       => $title,
                'description' => $request->grid_descriptions[$i] ?? null,
                'layout'      => $request->grid_layouts[$i] ?? 'left',
            ];
        }

        PageLayout::updateOrCreate(
            ['page_id' => $id, 'type' => 'grid'],
            [
                'section_id' => 'grid2',
                'data' => [
                    'columns' => 2,
                    'items'   => $items
                ]
            ]
        );
    }


    // Slider Fixed
    /* ===============================
    🔥 SLIDER (ADD + UPDATE)
=============================== */
if ($request->slider_titles) {

    $slides = [];

    foreach ($request->slider_titles as $i => $title) {
        $slides[] = [
            'image' => $request->hasFile("slider_images.$i")
                ? $request->file("slider_images.$i")->store('sliders', 'public')
                : ($request->existing_slider_images[$i] ?? null),

            'title'       => $title,
            'description' => $request->slider_descriptions[$i] ?? null,
        ];
    }

    PageLayout::updateOrCreate(
        ['page_id' => $id, 'type' => 'slider'],
        [
            'section_id' => 'slider1',
            'data' => [
                'slides' => $slides
            ]
        ]
    );
}

    // end

    // Division Logos
/* ===============================
    🔥 DIVISION LOGOS (ADD + UPDATE)
=============================== */
/* ===============================
    🔥 DIVISION LOGOS (MULTIPLE ADD + KEEP OLD)
=============================== */

// 1️⃣ Existing logos safely fetch karo
$logosLayout = PageLayout::where('page_id', $id)
    ->where('type', 'logos')
    ->first();


$existingLogos = [];

if ($logosLayout && isset($logosLayout->data['logos'])) {
    $existingLogos = $logosLayout->data['logos'];
}

// 2️⃣ New logos upload
$newLogos = [];

if ($request->hasFile('logo_images')) {
    foreach ($request->file('logo_images') as $file) {
        if ($file && $file->isValid()) {
            $newLogos[] = $file->store('logos', 'public');
        }
    }
}

// 3️⃣ Merge old + new
$finalLogos = array_values(array_merge($existingLogos, $newLogos));

// 4️⃣ Save only if at least one logo exists
if (!empty($finalLogos)) {
    PageLayout::updateOrCreate(
        ['page_id' => $id, 'type' => 'logos'],
        [
            'section_id' => 'logos1',
            'data' => [
                'logos' => $finalLogos
            ]
        ]
    );
}



    // end

    /* ===============================
        🔥 BANNER (FIXED)
    =============================== */
    if ($request->banner_titles) {

        $banners = [];

        foreach ($request->banner_titles as $i => $title) {
            $banners[] = [
                'bg_image' => $request->hasFile("banner_bg_image.$i")
                    ? $request->file("banner_bg_image.$i")->store('banners/bg', 'public')
                    : ($request->existing_banner_bg_images[$i] ?? null),

                'image' => $request->hasFile("banner_image.$i")
                    ? $request->file("banner_image.$i")->store('banners/main', 'public')
                    : ($request->existing_banner_images[$i] ?? null),

                'text_img' => $request->hasFile("banner_text_img.$i")
                    ? $request->file("banner_text_img.$i")->store('banners/text', 'public')
                    : ($request->existing_banner_text_images[$i] ?? null),

                'title'    => $title,
                'subtitle' => $request->banner_subtitles[$i] ?? null,
                   // 🔹 BUTTON 1
                'button1_text' => $request->banner_button1_text[$i] ?? null,
                'button1_link' => $request->banner_button1_link[$i] ?? null,

                // 🔹 BUTTON 2
                'button2_text' => $request->banner_button2_text[$i] ?? null,
                'button2_link' => $request->banner_button2_link[$i] ?? null,
            ];
        }

        PageLayout::updateOrCreate(
            ['page_id' => $id, 'type' => 'banner'],
            [
                'section_id' => 'banner1',
                'data'       => $banners
            ]
        );
    }

    /* ===============================
        DRAG & DROP ORDER (TOP + GRID)
    =============================== */
    if ($request->filled('section_order')) {

        $orderData = json_decode($request->section_order, true);
        $gridReorders = [];

        foreach ($orderData as $row) {

            // 🔹 Top-level sections
            if ($row['type'] !== 'grid_item') {
                PageLayout::where('id', $row['ref'])
                    ->where('page_id', $id)
                    ->update([
                        'sort_order' => (int) $row['sort_order']
                    ]);
            }

            // 🔹 Grid internal sections
            if ($row['type'] === 'grid_item') {
                $gridReorders[$row['ref']][] = [
                    'index' => (int) $row['index'],
                    'order' => (int) $row['sort_order'],
                ];
            }
        }

        foreach ($gridReorders as $layoutId => $rows) {

            $layout = PageLayout::find($layoutId);
            if (!$layout) continue;

            $items = $layout->data['items'] ?? [];

            foreach ($rows as $r) {
                if (isset($items[$r['index']])) {
                    $items[$r['index']]['_order'] = $r['order'];
                }
            }

            usort($items, fn($a, $b) =>
                ($a['_order'] ?? 0) <=> ($b['_order'] ?? 0)
            );

            foreach ($items as &$item) unset($item['_order']);

            $layout->data = [
                ...$layout->data,
                'items' => $items
            ];
            $layout->save();
        }
    }

    return redirect()
        ->route('admin.editpage', $id)
        ->with('success', 'Page updated successfully!');
}


}