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
use App\Models\MealDiseases;
use App\Models\MealMasterIngredientsDisease;
use App\Models\IngredientState;
use App\Models\MDState;
use App\Models\MealIngAyurveda;
use App\Helpers\Helper;
use App\Models\RecipeIngredents;
use App\Models\OtherSeo;
use Illuminate\Support\Facades\Validator;
use App\Models\MealIngrestate;
class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_term = $subFilterAry = array();
        if($request->has('filterBy')){
            $filterBy =  $request->filterBy;
            $search_term['filterBy'] = $filterBy;
            $search_term['subFilter'] =  $request->subFilter;
        } else{
            $search_term['filterBy'] = 0;
            $search_term['subFilter'] = 0;
        }


       $ingredentsQuery = Ingredents::query();
        
        if(!empty($filterBy) && $filterBy == 1){
            $ingredentsQuery = $ingredentsQuery->where('id',  $request->subFilter);
            $ingredentsList = Ingredents::all();
            foreach($ingredentsList as $ing)
            $subFilterAry[] = array("id"=>$ing->id, "name"=> $ing->name);
       
        } else if(!empty($filterBy) && $filterBy == 2 ){
            $ingredentsQuery = $ingredentsQuery->where('category', $request->subFilter);

            $categoryList = IngredientCategory::all();
            foreach($categoryList as $category)
            $subFilterAry[] = array("id"=>$category->id, "name"=> $category->name);

           
                
        }
        // else if(!empty($filterBy) && $filterBy == 3 ){
        //     $recipeQuery->with('ingredents')
        //     ->whereHas('ingredents', function($recipeQuery)use($request) {
        //         $recipeQuery->where('ingredent_id', '=', $request->subFilter);
        //     });

        //     $ingredentList = Ingredents::all();
        //     foreach($ingredentList as $ingredent)
        //     $subFilterAry[] = array("id"=>$ingredent->id, "name"=> $ingredent->name);

            

        // }
        // else if(!empty($filterBy) && $filterBy == 4 ){
        //     $recipeQuery = $recipeQuery->where('sub_category', $request->subFilter);

        //     $categoryList = RecipeSubCategory::all();
        //     foreach($categoryList as $category)
        //     $subFilterAry[] = array("id"=>$category->id, "name"=> $category->sub_category_name);

        // }
        // else if(!empty($filterBy) && $filterBy == 4 ){
        //     $recipeQuery = $recipeQuery->where('dish_type',  $request->subFilter);

        //     $dishList =DishType::all();
        //     foreach($dishList as $dish)
        //     $subFilterAry[] = array("id"=>$dish->id, "name"=> $dish->name);

        // }

        $ingredient = $ingredentsQuery->orderBy('id', 'DESC')->get();
       //$ingredient=Ingredents::all();
      
       foreach($ingredient as $key => $ingd){

             $recipeCount =RecipeIngredents::where('ingredent_id', $ingd->id)->count();
             $otherseo=OtherSeo::where('page_url','like','%'.$ingd->url_rewrite.'%')->first();
            //dd($otherseo);
      
             $ingredient[$key]->recipeCount = $recipeCount;
             $ingredient[$key]->otherseo=(!empty($otherseo))? $otherseo->id : '';

            $parameter= $ingd->parameter;

            if(!empty($parameter)){
                
                $exp = explode(',', $parameter);
                $unit_name = [];

                if(!empty($exp)){
                    foreach ($exp as $pkey => $ids) {
                        $data = Measurements::find($ids);
                        array_push($unit_name, (!empty($data)) ? $data->unit :'');

                    }
                    if(!empty($unit_name))
                    $unit_name_str = implode(',', $unit_name);
                    else
                    $unit_name_str = '';

                    $ingredient[$key]->unit_name = $unit_name_str;
                }
            
            }
            
        }
            
        return view('ingredient.index',compact('ingredient', 'search_term', 'subFilterAry'));
    
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
        $measurementlist=Measurements::all();
        $allergyCategorylist=AllergyCategory::all();
        $diseaseslist=Diseases::all();
        $mealdatabaselist=MealDatabase::all();
        $spicetagslist=Spicetags::where('spice_tag_categories_id',1)->get();
        $mealdiseaseslist=MealDiseases::all();
        
        return view('ingredient.create',compact('categorylist','foodgrouplist','ayurvedalist','measurementlist','allergyCategorylist','diseaseslist','mealdatabaselist','spicetagslist','mealdiseaseslist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ingredient_name' => 'required|unique:meal_ingredents,name',
            'ingredient_hindi' => 'required',
            'known_as'=>'required',
            'Meserment'=>'required',
            'Category'=>'required',
            'food_group'=>'required',
            'directly_eatable'=>'required',
            

        ]);
        
        if ($validator->fails()) {
            return redirect()->route('ingredient.create')->withErrors($validator)->withInput();
        }
 


       $ingredient= new Ingredents();
       $ingredient->name=$request->ingredient_name;
       $ingredient->name_in_hindi=$request->ingredient_hindi;
       if(!empty($request->Meserment))
       $ingredient->parameter= implode(',',$request->Meserment);
       if(!empty($request->file('images')))
       $ingredient->image= $request->file('images')->store('public/uploads');
       if(!empty($request->allergies))
       $ingredient->allergies= implode(',',$request->allergies);

       $ingredient->also_known=$request->known_as;
       $ingredient->database_id=$request->database;
       $ingredient->storage=$request->how_to_store;
       $ingredient->shelf_life=$request->shelf_life;
       $ingredient->category=$request->Category;
       $ingredient->food_group=$request->food_group;
       $ingredient->ayurveda_type=0;
       $ingredient->inayurveda=0;
       $ingredient->approved=0;
       $ingredient->vitamin_done=0;
       $ingredient->content_edit_check=0;
       $ingredient->complete=0;
       $ingredient->fat_sugar_done=0;
       $ingredient->directly_edible=$request->directly_eatable;
       $ingredient->measurement_done=1;
       $ingredient->is_healthy=0;
       $ingredient->url_rewrite=$request->slug;
       $ingredient->per_gram_serving= (!empty($request->gram)) ? $request->gram : 0;
        $ingredient->serving = (!empty($request->gram)) ? $request->gram : 0;
        $ingredient->calories=(!empty($request->calories)) ? $request->calories : 0;
        $ingredient->fats=(!empty($request->fat)) ? $request->fat : 0;
        $ingredient->carbs=(!empty($request->carbs)) ? $request->carbs : 0;
        $ingredient->protein=(!empty($request->protein)) ? $request->protein : 0;
        $ingredient->fiber_in_gm=(!empty($request->fiber)) ? $request->fiber : 0;
        $ingredient->sodium_in_mg=(!empty($request->sodium)) ? $request->sodium : 0;
        $ingredient->potassium=(!empty($request->potassium)) ? $request->potassium : 0;
        $ingredient->cholesterol=(!empty($request->cholestrol)) ? $request->cholestrol : 0;
        $ingredient->water=(!empty($request->water)) ? $request->water : 0;
        $ingredient->yield=(!empty($request->yeild)) ? $request->yeild : 0;
       $ingredient->price=0;
       $ingredient->short_desc=$request->short_desc;
       $ingredient->description=$request->long_desc;
       $ingredient->save();  



        $ingredient_id=$ingredient->id;

        if(!empty($request->sugar_G) || !empty($request->gulcose_g)){

            Sugars::create([
                'ingredent_id'=>$ingredient_id,
                'sugar'=>$request->sugar_G,
                'sucrose'=>$request->sucrose_G,
                'glucose'=>$request->gulcose_g,
                'fructose'=>$request->fructose_g,
                'lactose'=>$request->lactose_g,
                'maltose'=>$request->maltose_g,
                'glactose'=>$request->galactose_g,
            ]);

            Fats::create([
                'ingredent_id'=>$ingredient_id,
                'saturated_fat'=>$request->saturated_fat,
                'mono_unsaturated_fat'=>$request->monounsaturated,
                'poly_unsaturated_fat'=>$request->polyunsaturated,
                'trans_fat'=>$request->trans_fat,
                'omega_3_fatty_acid'=>$request->omega_3_fatty,
                'omega_6_fatty_acid'=>$request->omega_6_fatty,
            ]);
        
            $ingredient = Ingredents::find($ingredient_id);
            $ingredient->fat_sugar_done=1;
            $ingredient->save();

        }
    

       if(!empty($request->betaine) || !empty($request->calcium) || !empty($request->copper)){
       VitaminsMinerals::create([
            'ingredent_id'=>$ingredient_id,
            'betaine'=> (!empty($request->betaine)) ? $request->betaine : 0,
            'calcium'=> (!empty($request->calcium)) ? $request->calcium : 0,
            'copper'=> (!empty($request->copper)) ? $request->copper : 0,
            'folate'=>(!empty($request->folate)) ? $request->folate : 0,
            'lycopene'=>(!empty($request->lycopene)) ? $request->lycopene : 0,
            'manganese'=>(!empty($request->manganese)) ? $request->manganese : 0,
            'riboflavin'=>(!empty($request->reboflavin)) ? $request->reboflavin : 0,
            'vitamin_a'=>(!empty($request->vitamin_a)) ? $request->vitamin_a : 0,
            'vitamin_b6'=>(!empty($request->vitamin_b6)) ? $request->vitamin_b6 : 0,
            'vitamin_c'=>(!empty($request->vitamin_c)) ? $request->vitamin_c : 0,
            'vitamine_d2'=>(!empty($request->vitamin_d2)) ? $request->vitamin_d2 : 0,
            'vitamin_d3'=>(!empty($request->vitamin_d3)) ? $request->vitamin_d3 : 0,
            'vitamin_e'=>(!empty($request->vitamin_e)) ? $request->vitamin_e : 0,
            'vitamin_b12'=>(!empty($request->vitamin_b12)) ? $request->vitamin_b12 : 0,
            'vitamin_k'=>(!empty($request->vitamin_k)) ? $request->vitamin_k : 0,
            'choline'=>(!empty($request->choline)) ? $request->choline : 0,
            'fluoride'=>(!empty($request->fluride)) ? $request->fluride : 0,
            'iron'=>(!empty($request->iron)) ? $request->iron : 0,
            'magnesium'=>(!empty($request->magnesium)) ? $request->magnesium : 0,
            'niacin'=>(!empty($request->niacin)) ? $request->niacin : 0,
            'retinol'=>(!empty($request->retinol)) ? $request->retinol : 0,
            'thiamine'=>(!empty($request->thiamine)) ? $request->thiamine : 0,
            'selenium'=>(!empty($request->selenium)) ? $request->selenium : 0,
            'zinc'=>(!empty($request->zinc)) ? $request->zinc : 0,
            'vitamin_d'=>(!empty($request->vitamin_d)) ? $request->vitamin_d : 0,
            'caffeine'=>(!empty($request->caffeine)) ? $request->caffeine : 0,
        ]);     
 

        $ingredient = Ingredents::find($ingredient_id);
            $ingredient->vitamin_done=1;
            $ingredient->save();

            }
       
       $m_unit_ary = $request->mesure_unit;
        if(!empty($m_unit_ary)){
             foreach( $m_unit_ary as $key=>$m_id) {
                $m_value = $request->mesure_value[$key];
                $price=$request->price[$key];
                if($m_value != ''){
                    IngredentMeasurements::create([
                        'ingredent_id'=>$ingredient_id,
                        'measurement_id'=>$m_id,
                        'measure'=>$m_value,
                        'price'=>$price,
                    ]);
                }
             }
        }
    
         $avoid=$request->avoidit;
            if(!empty($avoid)){
                foreach ($avoid as $avoidkey => $avoid_id) {
                   
                        MealMasterIngredientsDisease::create([
                            'ingredients_id'=>$ingredient_id,
                            'disease_id'=>$avoid_id,
                        ]);
                    
                }
            }


        $ayurved=$request->Ayurveda;
         if(!empty($ayurved)){
                foreach($ayurved as $ayurkey=>$ayurval){
                    MealIngAyurveda::create([
                        'ingredients_id'=>$ingredient_id,
                        'ayurveda_id'=>$ayurval,
                    ]);
                }
            }



         return  redirect()->route('ingredient.index')->with('success', 'Ingredient Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $fats=Fats::where('ingredent_id',$id)->first();
        $sugar=Sugars::where('ingredent_id',$id)->first();
        $categorylist=IngredientCategory::all();
        $food_group=foodgroup::all();
        $ayur_Veda=AyurVeda::all();
        $allergyCategorylist=AllergyCategory::all();
        $measurementlist=Measurements::all();
        $mealdiseaseslist=MealDiseases::all();
        $mealdatabaselist=MealDatabase::all();
        $mmidisease=MealMasterIngredientsDisease::where('ingredients_id',$id)->get();
        $ingdmeasurelist=IngredentMeasurements::where('ingredent_id',$id)->get();
        $mealingayurveda =MealIngAyurveda::where('ingredients_id',$id)->get();

        return view('ingredient.edit', compact('ingredient','categorylist','food_group','ayur_Veda','allergyCategorylist','vitamins','fats','sugar','measurementlist','mealdiseaseslist','mealdatabaselist','ingdmeasurelist','mmidisease','mealingayurveda'));
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
         $role = Helper::role_slug();
  
         if($role == 'content-editor'){

            $validated = $request->validate([
                'ingredient_name' => 'required',
                'ingredient_hindi' => 'required',
                'known_as'=>'required',
            ]);

            $ingredient=Ingredents::find($id);
            $ingredient->name_in_hindi=$request->ingredient_hindi;
            $ingredient->also_known=$request->known_as;
            $ingredient->description=$request->long_desc;
            $ingredient->short_desc=$request->short_desc;
            $ingredient->update();  

            return redirect()->back()->with('success','Description Updated Successfully!');
         }

         if($role=='viewer'){
            return redirect()->back()->with('success','You are not autherise for update');
         }

        $validated = $request->validate([
            'ingredient_name' => 'required',
            'ingredient_hindi' => 'required',
            'known_as'=>'required',
            'measurement'=>'required',
            'Category'=>'required',
            'food_group'=>'required',
            'directly_eatable'=>'required',
            
        ]);

       $ingredient=Ingredents::find($id);
       $old_m_ary = explode(',', $ingredient->parameter);
       $ingredient->name=$request->ingredient_name;
       $ingredient->name_in_hindi=$request->ingredient_hindi;
       if(!empty($request->measurement))
       $ingredient->parameter= implode(',',$request->measurement);
       if(!empty($request->file('images')))
       $ingredient->image= $request->file('images')->store('uploads');
       if(!empty($request->allergies))
       $ingredient->allergies= implode(',',$request->allergies);
       $ingredient->also_known=$request->known_as;
       $ingredient->storage=$request->how_to_store;
       $ingredient->shelf_life=$request->shelf_life;
       $ingredient->category=$request->Category;
       $ingredient->food_group=$request->food_group;
       $ingredient->inayurveda=0;
       $ingredient->approved=0;
       $ingredient->vitamin_done=0;
       $ingredient->content_edit_check=0;
       $ingredient->complete=0;
       $ingredient->fat_sugar_done=0;
       $ingredient->directly_edible=$request->directly_eatable;
       $ingredient->measurement_done=1;
       $ingredient->is_healthy=0;
       $ingredient->url_rewrite=$request->slug;
        $ingredient->per_gram_serving= (!empty($request->gram)) ? $request->gram : 0;
        $ingredient->serving = (!empty($request->gram)) ? $request->gram : 0;
        $ingredient->calories=(!empty($request->calories)) ? $request->calories : 0;
        $ingredient->fats=(!empty($request->fat)) ? $request->fat : 0;
        $ingredient->carbs=(!empty($request->carbs)) ? $request->carbs : 0;
        $ingredient->protein=(!empty($request->protein)) ? $request->protein : 0;
        $ingredient->fiber_in_gm=(!empty($request->fiber)) ? $request->fiber : 0;
        $ingredient->sodium_in_mg=(!empty($request->sodium)) ? $request->sodium : 0;
        $ingredient->potassium=(!empty($request->potassium)) ? $request->potassium : 0;
        $ingredient->cholesterol=(!empty($request->cholestrol)) ? $request->cholestrol : 0;
        $ingredient->water=(!empty($request->water)) ? $request->water : 0;
        $ingredient->yield=(!empty($request->yeild)) ? $request->yeild : 0;
        $ingredient->price=0;
        if($role != 'nutrient'){
        $ingredient->description= $request->long_desc;
        $ingredient->short_desc=$request->short_desc;
        }
        $ingredient->update();  



        $ingredient_id=$ingredient->id;
        if(!empty($request->sugar_G) || !empty($request->sucrose_G) ){
            Sugars::updateOrCreate( ['ingredent_id'=>$ingredient_id],
            [
                'sugar'=> (!empty($request->sugar_G)) ? $request->sugar_G : 0,
                'sucrose'=> (!empty($request->sucrose_G)) ? $request->sucrose_G : 0,
                'glucose'=> (!empty($request->gulcose_g)) ? $request->gulcose_g : 0,
                'fructose'=> (!empty($request->fructose_g)) ? $request->fructose_g : 0,
                'lactose'=> (!empty($request->lactose_g)) ? $request->lactose_g : 0,
                'maltose'=> (!empty($request->maltose_g)) ? $request->maltose_g : 0,
                'glactose'=> (!empty($request->galactose_g)) ? $request->galactose_g : 0,
            ]);
        }
        
        if(!empty($request->betaine) || !empty($request->calcium) ){
            VitaminsMinerals::updateOrCreate(
                ['ingredent_id'=>$ingredient_id],
                [
                'betaine'=>(!empty($request->betaine)) ? $request->betaine: 0,
                'calcium'=>(!empty($request->calcium)) ? $request->calcium: 0,
                'copper'=>(!empty($request->copper)) ? $request->copper: 0,
                'folate'=>(!empty($request->folate)) ? $request->folate: 0,
                'lycopene'=>(!empty($request->lycopene)) ? $request->lycopene: 0,
                'manganese'=>(!empty($request->manganese)) ? $request->manganese: 0,
                'phosphorus'=>(!empty($request->phosphorus)) ? $request->phosphorus: 0,
                'riboflavin'=>(!empty($request->riboflavin)) ? $request->riboflavin: 0,
                'vitamin_a'=>(!empty($request->vitamin_a)) ? $request->vitamin_a: 0,
                'vitamin_b6'=>(!empty($request->vitamin_b6)) ? $request->vitamin_b6: 0,
                'vitamin_c'=>(!empty($request->vitamin_c)) ? $request->vitamin_c: 0,
                'vitamine_d2'=>(!empty($request->vitamin_d2)) ? $request->vitamin_d2: 0,
                'vitamin_d3'=>(!empty($request->vitamin_d3)) ? $request->vitamin_d3: 0,
                'vitamin_e'=>(!empty($request->vitamin_e)) ? $request->vitamin_e: 0,
                'vitamin_b12'=>(!empty($request->vitamin_b12)) ? $request->vitamin_b12: 0,
                'vitamin_k'=>(!empty($request->vitamin_k)) ? $request->vitamin_k: 0,
                'choline'=>(!empty($request->choline)) ? $request->choline: 0,
                'fluoride'=>(!empty($request->fluride)) ? $request->fluride: 0,
                'iron'=>(!empty($request->iron)) ? $request->iron: 0,
                'magnesium'=>(!empty($request->magnesium)) ? $request->magnesium: 0,
                'niacin'=>(!empty($request->niacin)) ? $request->niacin: 0,
                'retinol'=>(!empty($request->retinol)) ? $request->retinol: 0,
                'thiamine'=>(!empty($request->thiamine)) ? $request->thiamine: 0,
                'selenium'=>(!empty($request->selenium)) ? $request->selenium: 0,
                'zinc'=>(!empty($request->zinc)) ? $request->zinc: 0,
                'vitamin_d'=>(!empty($request->vitamin_d)) ? $request->vitamin_d: 0,
                'caffeine'=>(!empty($request->caffeine)) ? $request->caffeine: 0,

            ]);
        }

        $m_unit_ary = $request->mesure_unit;
        if(!empty($m_unit_ary)){
             foreach( $m_unit_ary as $key=>$m_id) {
                $m_value = $request->mesure_value[$key];
                $price=$request->price[$key];
                if($m_value != ''){
                    IngredentMeasurements::updateOrCreate([
                        'ingredent_id'=>$ingredient_id,
                        'measurement_id'=>$m_id,
                        'measure'=>$m_value,
                        'price'=>$price,
                    ]);
                }
             }
        }

        $new_n_ary = $request->measurement;
        foreach($old_m_ary as $key=>$old_m){
            if (!in_array($old_m, $new_n_ary)) {
                $delMatchAry = ['measurement_id' => $old_m, 'ingredent_id' => $ingredient_id];
                IngredentMeasurements::where($delMatchAry)->delete();
            }
        }

        if(!empty($request->saturated_fat) || !empty($request->monounsaturated) ){
            Fats::updateOrCreate(
                ['ingredent_id'=>$ingredient_id],
                [
                'saturated_fat'=>$request->saturated_fat,
                'mono_unsaturated_fat'=>$request->monounsaturated,
                'poly_unsaturated_fat'=>$request->polyunsaturated,
                'trans_fat'=>$request->trans_fat,
                'omega_3_fatty_acid'=>$request->omega_3_fatty,
                'omega_6_fatty_acid'=>$request->omega_6_fatty,
            ]);
        }

        $old_avoid=MealMasterIngredientsDisease::where('ingredients_id',$id)->get()->toArray();
        $avoid=$request->avoidit;
        if(!empty($avoid)){
            foreach ($avoid as $avoidkey => $avoid_id) {
                MealMasterIngredientsDisease::updateOrCreate([
                    'ingredients_id'=>$ingredient_id,
                    'disease_id'=>$avoid_id,
                ]);
            }
        }


        if(!empty($old_avoid) && !empty($avoid)){
            foreach($old_avoid as $key=>$old_av){
                if (!in_array($old_av['disease_id'], $avoid)) {
                    $delMatchAry = ['ingredients_id' => $ingredient_id, 'disease_id' => $old_av['disease_id'] ];
                    MealMasterIngredientsDisease::where($delMatchAry)->delete();
                }
            }
        }

        
        $old_Ayurveda=MealIngAyurveda::where('ingredients_id',$id)->get()->toArray();
        $ayurved=$request->Ayurveda;
        if(!empty($ayurved)){
            foreach($ayurved as $ayurkey=>$ayurval){
                MealIngAyurveda::updateOrCreate([
                    'ingredients_id'=>$ingredient_id,
                    'ayurveda_id'=>$ayurval,
                ]);
            }
        }

        if(!empty($old_Ayurveda) && !empty($ayurved)){
            foreach($old_Ayurveda as $key=>$old_Ayur){
                if (!in_array($old_Ayur['ayurveda_id'], $ayurved)) {
                    $delMatchAry = ['ingredients_id' => $ingredient_id, 'ayurveda_id' => $old_Ayur['ayurveda_id']];
                    MealIngAyurveda::where($delMatchAry)->delete();
                }

                
            }
        }

        return  redirect()->route('ingredient.index')->with('success', 'Recipe updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $ingredient = Ingredents::findOrFail($id);            

        } catch(\Exception $exception){
            $errormsg = 'Request ingredient not there in database';

            return redirect()->route('ingredient.index')->with('error', $errormsg);
        }


        $suger =Sugars::where('ingredent_id', '=', $id)->delete();

        $vitamin=VitaminsMinerals::where('ingredent_id', '=', $id)->delete();

        $measurement=IngredentMeasurements::where('ingredent_id', '=', $id)->delete();

        $fats=Fats::where('ingredent_id', '=', $id)->delete();

        $mastering=MealMasterIngredientsDisease::where('ingredients_id', '=', $id)->delete();

        $mealing=MealIngAyurveda::where('ingredients_id', '=', $id)->delete();

        $ingredient->delete();

        if ($ingredient)
        return redirect()->route('ingredient.index')->with('success','Recorded deleted Successfully');

    }


    public function getDetails(Request $request){
        $ing_id = $request->ing_id;
        $ing_details = Ingredents::find($ing_id);
        $measer_details=IngredentMeasurements::where('ingredent_id', $ing_id)->get();
        $measure_ary = array();
        foreach ($measer_details as $measure => $measure_value) {
           $measurement_id=$measure_value->measurement_id;
           if(!empty($measurement_id)){
                $measure_details=Measurements::find($measurement_id);
                $measure_name=$measure_details->unit;
                //$measure_ary[$measurement_id]=$measure_name;
                $measure_ary[]=array('id'=> $measurement_id, 'name'=>$measure_name, 'value'=> $measure_value->measure);
            }
        }

        $statelist=MealIngrestate::all();
        $ing_details['measurement'] = $measure_ary;
        $ing_details['state']=$statelist;
        return json_encode($ing_details);

    }

    public function getCateIngredientLIst(Request $request){

        $cate_id = $request->cate_id;

        $ingradient_list = IngredientCategory::find($cate_id)->ingredients;
        
        return json_encode($ingradient_list);

    }

    public function getIngredientFilter(Request $request){

        $filterBy = $request->filterid;
        $subFilterAry = array();
       

        if($filterBy == '1'){
            $ingredentList = Ingredents::all();
            foreach($ingredentList as $ingredent)
            $subFilterAry[] = array("id"=>$ingredent->id, "name"=> $ingredent->name);

        } else if($filterBy == '2'){

            $categorylist=IngredientCategory::all();
            foreach($categorylist as $category)
            $subFilterAry[] = array("id"=>$category->id, "name"=> $category->name);
        }

        // } else if($filterBy == '3'){
        //     $categoryList = RecipeCategory::all();
        //     foreach($categoryList as $category)
        //     $subFilterAry[] = array("id"=>$category->id, "name"=> $category->name);
        // }else if($filterBy == '4'){
        //     $categoryList = RecipeSubCategory::all();
        //     foreach($categoryList as $category)
        //     $subFilterAry[] = array("id"=>$category->id, "name"=> $category->sub_category_name);
        // }else if($filterBy == '5'){
        //     $dishList =DishType::all();
        //     foreach($dishList as $dish)
        //     $subFilterAry[] = array("id"=>$dish->id, "name"=> $dish->name);
        // }
        
        return json_encode($subFilterAry);

    }


    function check(Request $request){
       
        $ingredient_name=$request->ingredient;

        $data=Ingredents::where('name',$ingredient_name)->first();

        if(!empty($data))
            $return_array = array('status'=>0, 'message'=>'Name already exist');
        else
            $return_array = array('status'=>1, 'message'=>'Name looks good');

        return json_encode($return_array);
        
    }


    
}


