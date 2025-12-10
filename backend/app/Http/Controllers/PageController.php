<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageSlider;
use App\Models\PageCarousel;
use App\Models\PageGrid;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function dashboard()
    {
        $pagecount = Page::count();
        return view('layouts.dashboard' , compact('pagecount'));
    }

    // -----------------------------------------------------------------------------------------------------------------------------
    public function index()
    {
          $pages = Page::all();
        return view('pages.index' , compact('pages'));
    }



// -------------------------------------------------------------------------------------------------------------------------------
    /**
     * Show the form for creating a new resource.
     */

public function create(Request $request)
{
    if ($request->isMethod('post')) {

        // -------------------------------
        // 1. Save Page
        // -------------------------------
        $page = new Page();
        $page->title = $request->title;
        $page->slug = Str::slug($request->slug ?? $request->title);
        $page->content = $request->content;
        $page->status = $request->status;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->save();


        // -------------------------------
        // 2. Save Sliders
        // -------------------------------
        if (!empty($request->slider_titles)) {

            foreach ($request->slider_titles as $i => $title) {

                $imagePath = null;

                if ($request->hasFile("slider_images.$i")) {
                    $imagePath = $request->file("slider_images.$i")
                                         ->store("sliders", "public");
                }

                PageSlider::create([
                    'page_id'     => $page->id,
                    'title'       => $title,
                    'description' => $request->slider_descriptions[$i] ?? null,
                    'image'       => $imagePath,
                ]);
            }
        }



        // -------------------------------
        // 3. Save Carousel Items (MULTIPLE ROWS)
        // -------------------------------
        if (!empty($request->carousel_titles)) {

            foreach ($request->carousel_titles as $i => $title) {

                $path = null;

                if ($request->hasFile("carousel_images.$i")) {
                    $path = $request->file("carousel_images.$i")
                                   ->store("carousels", "public");
                }

                PageCarousel::create([
                'page_id'     => $page->id,
                'items_desktop'  => $request->carousel_items_desktop ?? 3,
                'items_tablet'   => $request->carousel_items_tablet ?? 2,
                'items_mobile'   => $request->carousel_items_mobile ?? 1,
                'autoplay'       => $request->carousel_autoplay ?? 1,
                'speed'          => $request->carousel_speed ?? 3000,
                'loop'           => $request->carousel_loop ?? 1,
                'nav'            => $request->carousel_nav ?? 1,
                'dots'           => $request->carousel_dots ?? 1,
                    // ITEM CONTENT
                    'image'       => $path,
                    'title'       => $title,
                    'description' => $request->carousel_descriptions[$i] ?? null,
                    'sort_order'  => $i + 1,
                ]);
            }
        }


                // SAVE GRID SECTIONS
            if (!empty($request->grid_titles)) {

                foreach ($request->grid_titles as $i => $title) {

                    $imagePath = null;

                    if ($request->hasFile("grid_images.$i")) {
                        $imagePath = $request->file("grid_images.$i")
                                            ->store("grids", "public");
                    }

                    PageGrid::create([
                        'page_id'     => $page->id,
                        'image'       => $imagePath,
                        'title'       => $title ?? "",
                        'description' => $request->grid_descriptions[$i] ?? "",
                        'layout'      => $request->grid_layouts[$i] ?? "left",
                        'sort_order'  => $i + 1,
                    ]);
                }
            }



        return redirect()->back()->with("success", "Page Created Successfully");
    }

    return view('pages.add');
}



// -----------------------------------------------------------------------------------------------------------------------------


   public function edit($id)
{
    $page = Page::findOrFail($id);

    $sliders = PageSlider::where('page_id', $id)->get();
    $carouselItems = PageCarousel::where('page_id', $id)->get();
    $gridItems = PageGrid::where('page_id', $id)->get();

    return view('pages.edit', compact('page', 'sliders', 'carouselItems', 'gridItems'));
}

// -----------------------------------------------------------------------------------------------------------------------------------



public function update(Request $request, $id)
{
    $page = Page::findOrFail($id);

    /* -------------------------------------------------------
        UPDATE PAGE BASIC FIELDS
    ------------------------------------------------------- */
    $page->title = $request->title;
    $page->slug = Str::slug($request->slug ?? $request->title);
    $page->content = $request->content;
    $page->meta_title = $request->meta_title;
    $page->meta_keywords = $request->meta_keywords;
    $page->meta_description = $request->meta_description;
    $page->save();


    /* -------------------------------------------------------
        HANDLE DELETE REQUESTS FIRST
    ------------------------------------------------------- */

    if ($request->delete_slider_ids) {
        PageSlider::whereIn('id', $request->delete_slider_ids)->delete();
    }

    if ($request->delete_carousel_ids) {
        PageCarousel::whereIn('id', $request->delete_carousel_ids)->delete();
    }

    if ($request->delete_grid_ids) {
        PageGrid::whereIn('id', $request->delete_grid_ids)->delete();
    }


    /* ============================================================
        1. SLIDER — UPDATE OLD + ADD NEW
    ============================================================= */
    if ($request->layout == "slider") {

        $existing = PageSlider::where('page_id', $id)->get()->values(); // reindex

        foreach ($request->slider_titles as $i => $title) {

            // Get existing or new
            $slider = $existing[$i] ?? new PageSlider();
            $slider->page_id = $id;
            $slider->title = $title;
            $slider->description = $request->slider_descriptions[$i] ?? null;

            // If new image uploaded
            if ($request->hasFile("slider_images.$i")) {
                $slider->image = $request->file("slider_images.$i")
                                        ->store("sliders", "public");
            }

            $slider->save();
        }
    }


    /* ============================================================
        2. CAROUSEL — UPDATE OLD + ADD NEW
    ============================================================= */
    if ($request->layout == "carousel") {

        $existing = PageCarousel::where('page_id', $id)->orderBy('sort_order')->get()->values();

        foreach ($request->carousel_titles as $i => $title) {

            $item = $existing[$i] ?? new PageCarousel();
            $item->page_id = $id;

            // Settings stored in every row
            $item->items_desktop = $request->carousel_items_desktop;
            $item->items_tablet  = $request->carousel_items_tablet;
            $item->items_mobile  = $request->carousel_items_mobile;
            $item->autoplay      = $request->carousel_autoplay;
            $item->speed         = $request->carousel_speed;
            $item->loop          = $request->carousel_loop;
            $item->nav           = $request->carousel_nav;
            $item->dots          = $request->carousel_dots;

            // Content
            $item->title = $title;
            $item->description = $request->carousel_descriptions[$i] ?? null;

            // Image update only if new uploaded
            if ($request->hasFile("carousel_images.$i")) {
                $item->image = $request->file("carousel_images.$i")
                                       ->store("carousels", "public");
            }

            $item->sort_order = $i + 1;

            $item->save();
        }
    }


    /* ============================================================
        3. GRID — UPDATE OLD + ADD NEW
    ============================================================= */
    if ($request->layout == "grid") {

        $existing = PageGrid::where('page_id', $id)->orderBy('sort_order')->get()->values();

        foreach ($request->grid_titles as $i => $title) {

            $grid = $existing[$i] ?? new PageGrid();
            $grid->page_id = $id;

            $grid->title = $title;
            $grid->description = $request->grid_descriptions[$i] ?? null;
            $grid->layout = $request->grid_layouts[$i] ?? "left";

            if ($request->hasFile("grid_images.$i")) {
                $grid->image = $request->file("grid_images.$i")
                                      ->store("grids", "public");
            }

            $grid->sort_order = $i + 1;

            $grid->save();
        }
    }


    return redirect()->route('admin.editpage', $id)
                     ->with('success', 'Page updated successfully!');
}



// ------------------------------------------------------------------------------------------------------------------------------


}
