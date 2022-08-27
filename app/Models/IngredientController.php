<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredents;
use App\Models\IngredientCategory;
use App\Models\IngredentMeasurements;
use App\Models\foodgroup;
use App\Models\AyurVeda;
use App\Models\Measurements;
use App\Models\Allergies;
use App\Models\AllergyCategory;
use App\Models\Diseases;
use App\Models\VitaminsMinerals;
use App\Models\Fats;
use App\Models\Sugars;
use App\Models\Spicetags;
use App\Models\SpiceInTag;
use App\Models\MealDatabase;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $ingredient=Ingredents::all();

       foreach($ingredient as $key => $ingd){

            $category_id= $ingd->category;

            if(!empty( $category_id)){
                $cate_details = IngredientCategory::find($category_id);
                $cate_name = $cate_details->name;
                $ingredient[$key]->cateName = $cate_name;
            }


            $parameter= $ingd->parameter;

            if(!empty($parameter)){
                
                $exp = explode(',', $parameter);
                $unit_name = [];

                if(!empty($exp)){
                    foreach ($exp as $key => $ids) {
                        $data = Measurements::find($ids);
                        array_push($unit_name, (!empty($data)) ? $data->unit :'');

                    }
                    $unit_name_str = implode(',', $unit_name);
                $ingredient[$key]->unit_name = $unit_name_str;
                }
            
            }
            
        }
            
        return view('ingredient.index',compact('ingredient'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorylist= IngredientCategory::all();
        $foodgrouplist= foodgroup::all();
        $ayurvedalist=AyurVeda::all();
        $Measurementlist=Measurements::all();
        $AllergyCategorylist=AllergyCategory::all();
        $Diseaseslist=Diseases::all();
        $mealdatabaselist=MealDatabase::all();
        $Spicetagslist=Spicetags::where('spice_tag_categories_id',1)->get();

        return view('ingredient.create',compact('categorylist','foodgrouplist','ayurvedalist','Measurementlist','AllergyCategorylist','Diseaseslist','Spicetagslist','mealdatabaselist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_name' => 'required',
            'ingredient_hindi' => 'required',
            'known_as'=>'required',
            'Meserment'=>'required',
            'how_to_store'=>'required',
            'shelf_life'=>'required',
            'Category'=>'required',
            'food_group'=>'required',
            'Ayurveda'=>'required',
            'directly_eatable'=>'required',
            'health_tag'=>'required',
            

        ]);


       $ingredient= new Ingredents();
       $ingredient->name=$request->ingredient_name;
       $ingredient->name_in_hindi=$request->ingredient_hindi;

       $ingredient->parameter= implode(',',$request->Meserment);

        //dd($request->Meserment);
       $ingredient->also_known=$request->known_as;

       $ingredient->storage=$request->how_to_store;
       $ingredient->shelf_life=$request->shelf_life;
       $ingredient->category=$request->Category;
       $ingredient->food_group=$request->food_group;

       $ingredient->ayurveda_type=$request->Ayurveda;
       $ingredient->inayurveda=0;
       $ingredient->approved=0;
       $ingredient->vitamin_done=0;
       $ingredient->content_edit_check=0;
       $ingredient->complete=0;
       $ingredient->fat_sugar_done=0;

       $ingredient->directly_edible=$request->directly_eatable;
        $ingredient->measurement_done=1;
       $ingredient->is_healthy=$request->health_tag;
       $ingredient->url_rewrite=$request->slug;
       if(!empty($request->file('images')))
       $ingredient->image= $request->file('images')->store('public/uploads');
        $ingredient->per_gram_serving=$request->gram;
        $ingredient->serving = $request->gram;
        $ingredient->calories=$request->calories;
        $ingredient->fats=$request->fat;
        $ingredient->carbs=$request->carbs;
        $ingredient->protein=$request->protein;
        $ingredient->fiber_in_gm=$request->fiber;
        $ingredient->sodium_in_mg=$request->sodium;
        $ingredient->potassium=$request->potassium;
        $ingredient->cholesterol=$request->cholestrol;
        $ingredient->water=$request->water;
        $ingredient->yield=$request->yeild;
        $ingredient->price=0;
        $ingredient->description=$request->long_desc;
        $ingredient->save();  



        $ingredient_id=$ingredient->id;
        $ingredient=Sugars::create([
            'ingredent_id'=>$ingredient_id,
            'sugar'=>$request->sugar_G,
            'sucrose'=>$request->sucrose_G,
            'glucose'=>$request->gulcose_g,
            'fructose'=>$request->fructose_g,
            'lactose'=>$request->lactose_g,
            'maltose'=>$request->maltose_g,
            'glactose'=>$request->galactose_g,
        ]);
    


        $ingredient=VitaminsMinerals::create([
            'ingredent_id'=>$ingredient_id,
            'betaine'=>$request->betaine,
            'calcium'=>$request->calcium,
            'copper'=>$request->copper,
            'folate'=>$request->folate,
            'lycopene'=>$request->lycopene,
            'manganese'=>$request->manganese,
            'phosphorus'=>$request->phosphorus,
            'riboflavin'=>$request->reboflavin,
            'vitamin_a'=>$request->vitamin_a,
            'vitamin_b6'=>$request->vitamin_b6,
            'vitamin_c'=>$request->vitamin_c,
            'vitamine_d2'=>$request->vitamin_d2,
            'vitamin_d3'=>$request->vitamin_d3,
            'vitamin_e'=>$request->vitamin_e,
            'vitamin_b12'=>$request->vitamin_b12,
            'vitamin_k'=>$request->vitamin_k,
            'choline'=>$request->choline,
            'fluoride'=>$request->fluride,
            'iron'=>$request->iron,
            'magnesium'=>$request->magnesium,
            'niacin'=>$request->niacin,
            'retinol'=>$request->retinol,
            'thiamine'=>$request->thiamine,
            'selenium'=>$request->selenium,
            'zinc'=>$request->zinc,
            'vitamin_d'=>$request->vitamin_d,
            'caffeine'=>$request->caffeine,

        ]);


        $ingredient=Fats::create([
            'ingredent_id'=>$ingredient_id,
            'saturated_fat'=>$request->saturated_fat,
            'mono_unsaturated_fat'=>$request->monounsaturated,
            'poly_unsaturated_fat'=>$request->polyunsaturated,
            'trans_fat'=>$request->trans_fat,
            'omega_3_fatty_acid'=>$request->omega_3_fatty,
            'omega_6_fatty_acid'=>$request->omega_6_fatty,
        ]);


        $ingredient=SpiceInTag::create([
            'ingredent_id'=>$ingredient_id,
            'spice_tag_id'=>$request->avoid_it,
        ]);


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

        $ingredient=Ingredents::find($id);
        $vitamins=VitaminsMinerals::where('ingredent_id',$id)->first();
        //dd($vitamins);
        $Fats=Fats::where('ingredent_id',$id)->first();
        $sugar=Sugars::where('ingredent_id',$id)->first();
        $categorylist=IngredientCategory::all();
        $food_group=foodgroup::all();
        $Ayur_Veda=AyurVeda::all();
        $AllergyCategorylist=AllergyCategory::all();
        $Measurementlist=Measurements::all();

        $Spicetagslist=Spicetags::where('spice_tag_categories_id',1)->get();
        return view('ingredient.edit', compact('ingredient','categorylist','food_group','Ayur_Veda','AllergyCategorylist','vitamins','Fats','sugar','Spicetagslist','Measurementlist'));
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

$validated = $request->validate([
            'ingredient_name' => 'required',
            'ingredient_hindi' => 'required',
            'known_as'=>'required',
            'measurement'=>'required',
            'how_to_store'=>'required',
            'shelf_life'=>'required',
            'Category'=>'required',
            'food_group'=>'required',
            'Ayurveda'=>'required',
            'directly_eatable'=>'required',
            'health_tag'=>'required',
            

        ]);

       $ingredient=Ingredents::find($id);
       $ingredient->name=$request->ingredient_name;
       $ingredient->name_in_hindi=$request->ingredient_hindi;

       if(!empty($request->measurement))
       $ingredient->parameter= implode(',',$request->measurement);

       if(!empty($request->file('images')))
       $ingredient->image= $request->file('images')->store('uploads');

        //dd($request->Meserment);
       $ingredient->also_known=$request->known_as;

       $ingredient->storage=$request->how_to_store;
       $ingredient->shelf_life=$request->shelf_life;
       $ingredient->category=$request->Category;
       $ingredient->food_group=$request->food_group;

       $ingredient->ayurveda_type=$request->Ayurveda;
       $ingredient->inayurveda=0;
       $ingredient->approved=0;
       $ingredient->vitamin_done=0;
       $ingredient->content_edit_check=0;
       $ingredient->complete=0;
       $ingredient->fat_sugar_done=0;

       $ingredient->directly_edible=$request->directly_eatable;
       $ingredient->measurement_done=1;
       $ingredient->is_healthy=$request->health_tag;
       $ingredient->url_rewrite=$request->slug;

        $ingredient->per_gram_serving=$request->gram;
        $ingredient->serving = $request->gram;
        $ingredient->calories=$request->calories;
        $ingredient->fats=$request->fat;
        $ingredient->carbs=$request->carbs;
        $ingredient->protein=$request->protein;
        $ingredient->fiber_in_gm=$request->fiber;
        $ingredient->sodium_in_mg=$request->sodium;
        $ingredient->potassium=$request->potassium;
        $ingredient->cholesterol=$request->cholestrol;
        $ingredient->water=$request->water;
        $ingredient->yield=$request->yeild;
        $ingredient->price=0;
        $ingredient->description=$request->long_desc;

        $ingredient->update();  



        $ingredient_id=$ingredient->id;
        Sugars::updateOrCreate([
            'ingredent_id'=>$ingredient_id,
            'sugar'=>$request->sugar_G,
            'sucrose'=>$request->sucrose_G,
            'glucose'=>$request->gulcose_g,
            'fructose'=>$request->fructose_g,
            'lactose'=>$request->lactose_g,
            'maltose'=>$request->maltose_g,
            'glactose'=>$request->galactose_g,
        ]);
    


        VitaminsMinerals::updateOrCreate([
            'ingredent_id'=>$ingredient_id,
            'betaine'=>$request->betaine,
            'calcium'=>$request->calcium,
            'copper'=>$request->copper,
            'folate'=>$request->folate,
            'lycopene'=>$request->lycopene,
            'manganese'=>$request->manganese,
            'phosphorus'=>$request->phosphorus,
            'riboflavin'=>$request->reboflavin,
            'vitamin_a'=>$request->vitamin_a,
            'vitamin_b6'=>$request->vitamin_b6,
            'vitamin_c'=>$request->vitamin_c,
            'vitamine_d2'=>$request->vitamin_d2,
            'vitamin_d3'=>$request->vitamin_d3,
            'vitamin_e'=>$request->vitamin_e,
            'vitamin_b12'=>$request->vitamin_b12,
            'vitamin_k'=>$request->vitamin_k,
            'choline'=>$request->choline,
            'fluoride'=>$request->fluride,
            'iron'=>$request->iron,
            'magnesium'=>$request->magnesium,
            'niacin'=>$request->niacin,
            'retinol'=>$request->retinol,
            'thiamine'=>$request->thiamine,
            'selenium'=>$request->selenium,
            'zinc'=>$request->zinc,
            'vitamin_d'=>$request->vitamin_d,
            'caffeine'=>$request->caffeine,

        ]);


        Fats::updateOrCreate([
            'ingredent_id'=>$ingredient_id,
            'saturated_fat'=>$request->saturated_fat,
            'mono_unsaturated_fat'=>$request->monounsaturated,
            'poly_unsaturated_fat'=>$request->polyunsaturated,
            'trans_fat'=>$request->trans_fat,
            'omega_3_fatty_acid'=>$request->omega_3_fatty,
            'omega_6_fatty_acid'=>$request->omega_6_fatty,
        ]);


        // $ingredient=SpiceInTag::create([
        //     'ingredent_id'=>$ingredient_id,
        //     'spice_tag_id'=>$request->avoid_it,
        // ]);


        return view('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient=Ingredents::find($id);
        $ingredient->delete();
    }
}

