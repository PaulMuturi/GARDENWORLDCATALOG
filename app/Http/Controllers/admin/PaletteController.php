<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Product;
use App\Models\Palette;
use App\Models\Section;
use App\Models\ProductImage;
use App\Models\LightRequirement;
use App\Models\FoliageColor;
use App\Models\FlowerColor;
use App\Models\GeneralColor;



class PaletteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('palette')->whereHas('palette', function ($query) {
            $query->where('id', '!=', null);
        })->orderBy('created_at', 'desc')->get();

        return view('admin.pages.palettes', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return view('admin.pages.addPalette', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $palette = Palette::where('project_id', $request->project_id)->first();

        if (!$palette){
            $palette = new Palette();
        }

        $palette->project_id = $request->project_id;
        $palette->notes = $request->notes;
        $palette->save();


        return redirect(route('editPalette', $palette->id));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $palette = Palette::where('id', $id)->with('sections')->first();
        $projects = Project::orderBy('created_at', 'desc')->get();
        $all_palettes = Palette::all();

        
        $projects_with_palette = [];
        foreach($all_palettes as $pal){
            array_push($projects_with_palette, $pal->project_id);
        }

        return view('admin.pages.addPalette', compact('projects', 'palette', 'projects_with_palette'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function sectionPage($id){
        
    // }

    public function addSection(Request $request)
    {
        $palette = $this->savePalette($request);
        $project = Project::where('id', $palette->project_id)->first();
        $products = Product::with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->get();


        if ($request->add_section_section_id){
            //If section already exists fetch its data
            $sectionData = Section::where('id', $request->add_section_section_id)->first();
            return view('admin.pages.sectionpage', compact('palette', 'project', 'products', 'sectionData'));
        }
        return view('admin.pages.sectionpage', compact('palette', 'project', 'products'));
    }

    public function savePalette($data){
           
        $palette = Palette::where('project_id', $data->add_section_project_id)->first();
        if (!$palette){
            $palette = new Palette();
        }

        $palette->project_id = $data->add_section_project_id;
        $palette->notes = $data->add_section_palette_notes;
        $palette->save();

        return $palette;
    }

    public function saveSection(Request $request){
        $section;
        return $request;
        if (isset($request->edit_id)){
            $section = Section::where('id', $request->edit_id)->first();
        }else{
            $section = new Section();
        }


        $section->palette_id = $request->palette_id;
        $section->title = $request->title;
        $section->notes = $request->notes;

        $images = '';
        if (isset($request->choice)){
            $images = implode(',', $request->choice);
        }
    
        $section->image_ids = $images;
        $section->save();

        return redirect(route('editSection', $section->id));
    }

    public function editSection($id){

        $sectionData = Section::where('id', $id)->first();

        $palette;
        $products = Product::with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->get();


        if ($sectionData){
            $palette = Palette::where('id', $sectionData->palette_id)->first();
            $project = Project::where('id', $palette->project_id)->first();
            return view('admin.pages.sectionpage', compact('palette', 'project', 'products', 'sectionData'));
        }

        return redirect(route('palettes'));
    }

    //WEB FUNCTIONS FROM HERE

    public function showPalette($id){
        $palette = Palette::where('id', $id)->with('sections')->first();
        $project = Project::where('id', $palette->project_id)->first();
        $categorized_products = [];

        $all_plants = Product::with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('categories')->with('product_image')->get();
        array_push($categorized_products, ['title' => "",'notes' => '', 'data' => $all_plants]);

        // UNCOMMENT FOR AUTO-CATEGORIZATION

        /*
        $undercanopy = Product::where('category', '!=', 'tree')
                        ->where('category', '!=', 'fruit_tree')
                        ->where('category', '!=', 'herb')
                        ->where('category', '!=', 'palm')
                        ->where('category', '!=', 'fruit')
                        ->with('light_requirement')
                        ->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')
                        ->get();
                        
        $trees = Product::where('category', 'tree')->with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->get();
     
        $edibles = Product::where('category','herb')->orWhere('category', 'fruit')->with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->get();
        
        $fruit_trees = Product::where('category','fruit_tree')->with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->get();
        
        $palms = Product::where('category','palm')->with('light_requirement')->with('foliage_color')->with('flower_color')->with('general_color')->with('product_image')->get();

        // return $products;
        if ($undercanopy){
            array_push($categorized_products, ['title' => "Under Canopy",  'notes' => 'Groundcovers, Herbaceous plants & Shrubs', 'data' => $undercanopy]);
        }
        if ($palms){
            array_push($categorized_products, ['title' => "Palms",'notes' => 'Palms and Palm-like plants', 'data' => $palms]);
        }
        if ($edibles){
            array_push($categorized_products, ['title' => "Edibles", 'notes' => 'Fruits, vines & herbs', 'data' => $edibles]);
        }
        if ($fruit_trees){
            array_push($categorized_products, ['title' => "Fruit Trees",'notes' => '', 'data' => $fruit_trees]);
        }
        if ($trees){
            array_push($categorized_products, ['title' => "Trees",'notes' => 'Shade / Screening trees', 'data' => $trees]);
        } 
        */

        $categorized_products = json_decode(json_encode($categorized_products));
        // return $categorized_products;
        return view('web.pages.showPalette', compact('palette', 'project', 'categorized_products'));
    }
}


