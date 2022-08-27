<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\MRFrequency;
use App\Models\mealcomplexity;
use App\Models\RecipeSubCategory;
use App\Models\RecipeSubSubCategory;
use App\Models\DishType;
use App\Models\MealChef;
use App\Models\Cuisines;
use App\Models\Regions;
use App\Models\mealseasons;
use App\Models\mealrecipeunit;
use App\Models\cookingtype;
use App\Models\MDState;
use App\Models\AyurVeda;
use App\Models\MealType;
use App\Models\Festivals;
use App\Models\MRtemprature;
use App\Models\IngredientCategory;
use App\Models\Ingredents;
use App\Models\RecipeIngredents;
use App\Models\IngredientState;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Models\Taste;
use App\Models\MealDiseases;
use App\Models\RecipeBestMix;
use App\Models\RecipeAvoidMix;
use Illuminate\Support\Facades\Validator;
use App\Models\Tags;
use App\Models\Diets;
use App\Models\RecipeTags;
use App\Models\RecipeDiettypeTags;
use App\Models\RecipeFestival;
use App\Models\MealDiseasesAvoidRecipe;
use App\Models\RecipeMealPlanSettings;

use DB;


class RecipeController extends Controller
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


       $recipeQuery = Recipe::query();
        
        // if(!empty($filterBy) && $filterBy == 1){
        //  $recipeQuery = $recipeQuery->where('id',  $request->subFilter);
        //  $recipeList = Recipe::all();
        //  foreach($recipeList as $recipe)
        //  $subFilterAry[] = array("id"=>$recipe->id, "name"=> $recipe->name);
       
        // } else 
        if(!empty($filterBy) && $filterBy == 1 ){

            $recipeQuery->with('ingredents')
            ->whereHas('ingredents', function($recipeQuery)use($request) {
                $recipeQuery->where('ingredent_id', '=', $request->subFilter);
            });

            $ingredentList = Ingredents::all();
            foreach($ingredentList as $ingredent)
            $subFilterAry[] = array("id"=>$ingredent->id, "name"=> $ingredent->name);
                
        }
        else if(!empty($filterBy) && $filterBy == 2 ){
            $recipeQuery = $recipeQuery->where('category', $request->subFilter);

            $categoryList = RecipeCategory::all();
            foreach($categoryList as $category)
            $subFilterAry[] = array("id"=>$category->id, "name"=> $category->name);

        }
        else if(!empty($filterBy) && $filterBy == 3 ){
            $recipeQuery = $recipeQuery->where('sub_category', $request->subFilter);

            $categoryList = RecipeSubCategory::all();
            foreach($categoryList as $category)
            $subFilterAry[] = array("id"=>$category->id, "name"=> $category->sub_category_name);

        }
        else if(!empty($filterBy) && $filterBy == 4 ){
            $recipeQuery = $recipeQuery->where('dish_type',  $request->subFilter);

            $dishList =DishType::all();
            foreach($dishList as $dish)
            $subFilterAry[] = array("id"=>$dish->id, "name"=> $dish->name);

        }
        else if(!empty($filterBy) && $filterBy == 5 ){
            $recipeQuery = $recipeQuery->where('cook_time',  $request->subFilter);

            //$dishList =DishType::all();
            for($i=1; $i<=180; $i++)
            $subFilterAry[] = array("id"=>$i, "name"=> $i);

        }
        else if(!empty($filterBy) && $filterBy == 6 ){
            $recipeQuery = $recipeQuery->where('type_seasonal_recipe',  $request->subFilter);

            $seasonalist = mealseasons::all();
            foreach($seasonalist as $season)
            $subFilterAry[] = array("id"=>$season->id, "name"=> $season->name);

        }
        
         
         
    //   if(!empty($search))
    //      $blankQuery = $blankQuery->where('ProBody','=',$category);
       
 
       $recipelist = $recipeQuery->orderBy('id', 'DESC')->get();


        foreach ($recipelist as $key => $recipe) {

            $category_id = $recipe->category;

            if (!empty($category_id)) {
                $cate_details = RecipeCategory::find($category_id);
                $cate_name = $cate_details->name;
                $recipelist[$key]->categoryName = $cate_name;
            }


            $frequency_id = $recipe->meal_recipe_Frequency;

            if (!empty($frequency_id)) {
                $frequency_details = MRFrequency::find($frequency_id);
                $frequency_name = $frequency_details->name;
                $recipelist[$key]->Frequency_name = $frequency_name;
            }


            $complexcity_id = $recipe->meal_complexity_id;

            if (!empty($category_id)) {
                $complexcity_details = mealcomplexity::find($complexcity_id);
                $complexity_name = $complexcity_details->name;
                $recipelist[$key]->complexcityName = $complexity_name;
            }
        }




        return view('recipe.index', compact('recipelist', 'search_term', 'subFilterAry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $recipecategorylist = RecipeCategory::all();
        $recipesublist = RecipeSubCategory::all();
        $recipesubsubcategorylist = RecipeSubSubCategory::all();
        $dishtypelist = DishType::all();
        $mealcheflist = MealChef::all();
        $cuisineslist = Cuisines::all();
        $regionlist = Regions::all();
        $seasonalist = mealseasons::all();
        $mealcomplexitylist = mealcomplexity::all();
        $mealrecipeunitlist = mealrecipeunit::all();
        $cooking_type = cookingtype::all();
        $mdstatelist = MDState::all();
        $frequency = MRFrequency::all();
        $ayurvedalist = AyurVeda::all();
        $mealtype = MealType::all();
        $festival = Festivals::all();
        $mrtempraturelist = MRtemprature::all();
        $ingredientcategorylist = IngredientCategory::all();
        $ingredentslist = Ingredents::All();
        $role = Helper::role_slug();
        $tastelist= Taste::all();
        $mealdiseaseslist=MealDiseases::all();
        $recipename=Recipe::all();
        $mealtags=Tags::all();
        $diets=Diets::all();
        

       
        return view('recipe.create', compact('recipecategorylist', 'recipesublist', 'recipesubsubcategorylist', 'dishtypelist', 'mealcheflist', 'cuisineslist', 'regionlist', 'seasonalist', 'mealcomplexitylist', 'mealrecipeunitlist', 'cooking_type', 'mdstatelist', 'frequency', 'ayurvedalist', 'mealtype', 'festival', 'mrtempraturelist', 'ingredientcategorylist', 'ingredentslist', 'role','tastelist','mealdiseaseslist','recipename','mealtags','diets'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $role = Helper::role_slug();
        if ($role != 'admin' && $role != 'user') {
            return redirect()->back()->with('success', 'You dont have authorised for update');
        }

        $validator = Validator::make($request->all(), [
            'Recipe_Name' => 'required|unique:meal_recipe,name',
            'category' => 'required',
            'known_as' => 'required',
            'category' => 'required',
            'Sub_Cat' => 'required',
            'dishtype' => 'required',
            'Cuisine_Type' => 'required',
            'Region' => 'required',
            'seasonal' => 'required',
            'complexity' => 'required',
            'Cooking_Type' => 'required',
            'preparation' => 'required',
            'no_of_section' => 'required',
            'chef' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('recipe.create')->withErrors($validator)->withInput();
        }
 

        $recipe = new Recipe();
        $recipe->name = $request->Recipe_Name;
        $recipe->name_in_hindi = $request->recipe_hindi;
        $recipe->also_known = $request->known_as;
        $recipe->category = $request->category;
        $recipe->sub_category = $request->Sub_Cat;
        $recipe->sub_sub_category = $request->S_Sub_Cat;
        $recipe->dish_type = $request->dishtype;
        $recipe->chef = $request->chef;
        $recipe->cuisine_type = $request->Cuisine_Type;
        $recipe->region = $request->Region;
        $recipe->type_seasonal_recipe = $request->seasonal;
        $recipe->meal_complexity_id = $request->complexity;
        $recipe->cooking_type = $request->Cooking_Type;
        $recipe->keeps_well = $request->keeps_Well;
        $recipe->recipe_unit = $request->Recipe_unit;
        $recipe->main_dish = ($request->main_dish == 1) ? 1 : 0;
        $recipe->breakfast = ($request->breakfast == 1) ? 1 : 0;
        $recipe->is_basic_food = ($request->basic_food == 1) ? 1 : 0;
        $recipe->recipe_leftover = ($request->leftover_G == 1) ? 1 : 0;
        $recipe->single_serving = ($request->single_serve == 1) ? 1 : 0;
        $recipe->prep_time = (!empty($request->preparation)) ? $request->preparation : 0;
        $recipe->pre_prep_time = (!empty($request->pre_preparation)) ? $request->pre_preparation : 0;
        $recipe->cook_time =  (!empty($request->cooking)) ? $request->cooking : 0;
        $recipe->cook_time_to = ($request->batch_cook == 1) ? 1 : 0;
        $recipe->category = $request->category;
        $recipe->no_sections =  (!empty($request->no_of_section)) ? $request->no_of_section : 0;
        $recipe->serving_description = 1;
        $recipe->directions = 0;
        $recipe->positive_point = 0;
        $recipe->tags = 0;
        $recipe->meta_title = 0;
        $recipe->meta_desctiption = 0;
        $recipe->meta_tags = 0;
        $recipe->festivals = 0;
        $recipe->serving_size = -0;
        $recipe->approved = 0;
        $recipe->created_by = Auth::id();
        $recipe->full_description = $request->long_desc;
        $recipe->description = $request->short_desc;
        $recipe->instruction = $request->instruction;
        $recipe->calorie = 0;
        $recipe->yields = 0;
        $recipe->fiber =0;
        $recipe->calories = (!empty($request->total_calories)) ? $request->total_calories : 0;
        $recipe->protien = (!empty($request->total_protein)) ? $request->total_protein : 0;
        $recipe->fat = (!empty($request->total_fat)) ? $request->total_fat : 0;
        $recipe->carbs = (!empty($request->carbs_total)) ? $request->carbs_total : 0;
        $recipe->price = 0;
        $recipe->breakfast_food = 0;
        $recipe->per_serving_calories = 0;
        $recipe->sugar = 0;
        $recipe->saturated_fat = 0;
        $recipe->cholesterol = 0;
        $recipe->meal_dish_state = 1;
        $recipe->temprature = $request->serveT;
        $recipe->meal_recipe_Frequency = $request->Frequency;
        $recipe->existing_url = 0;
        $recipe->remarks = 0;
        $recipe->Ingredient_check = 0;
        $recipe->content_edit_check = 0;
        $recipe->complete = 0;
        $recipe->new_name = 0;
        $recipe->new_serving_size = 0;
        $recipe->title = 0;
        $recipe->recipe_origin = 0;
        $recipe->url_rewrite = $request->Slug;
        $recipe->taste= $request->Taste;
        $recipe->sub_sub_category = 0;

        $recipe->save();


        $recipe_id = $recipe->id;


        $ingd = $request->ingredient_name;
        if (!empty($ingd)) {
            foreach ($ingd as $key => $ingval) {

                $ing_position = array_search($ingval, $request->ing_id);

                if (!is_null($ing_position)) {
                    $mesur = $request->mesur[$ing_position];
                    $qty = $request->qty[$ing_position];
                    $state = $request->state[$ing_position];
                    $section = (!empty($request->section[$ing_position])) ? $request->section[$ing_position] : 0;
                    $main = $request->main[$ing_position];
                    $order = $request->order[$ing_position];
                    RecipeIngredents::create([
                        'recipe_id' => $recipe_id,
                        'ingredent_id' => $ingval,
                        'unit_measure' => $mesur,
                        'quantity' => $qty,
                        'meal_ingre_state' => $state,
                        'section_id' => $section,
                        'is_main_ingredien' => $main,
                        'in_order' => $order,
                        'notify' => 0,
                    ]);

                }
            }
        }


        $besteatList= $request->best_to_eat_with;
        if(!empty($besteatList)){
            foreach ($besteatList as $key=> $besteat) {
                RecipeBestMix::create([
                    'recipe_id'=>$recipe_id,
                    'with_recipe_id'=>$besteat,
                ]);
                
            }
        }
        
        $avoidList=$request->avoid_with;
        if(!empty($avoid_with)){
            foreach ($avoid_with as $key=> $avoidwith) {
               
                RecipeAvoidMix::create([
                    'recipe_id'=>$recipe_id,
                    'avoid_with_recipe'=>$avoidwith,
                ]);
                
            }
        }  
        
          $dietTypeList=$request->diet_type;
        if(!empty($dietTypeList)){
            foreach ($dietTypeList as $key=> $dietType) {
            
                RecipeDiettypeTags::create([
                    'recipe_id'=>$recipe_id,
                    'diettype_id'=>$dietType,
                ]);
                
            }
        }
           $occasionsList=$request->occasions;
        if(!empty($occasionsList)){
            foreach ($occasionsList as $key=> $occasion) {
            
                RecipeTags::create([
                    'recipe_id'=>$recipe_id,
                    'tag_id'=>$occasion,
                ]);
                
            }
        }
         
            $festivalsList=$request->festivals;
        if(!empty($festivalsList)){
            foreach ($festivalsList as $key=> $festival) {
            
                RecipeFestival::create([
                    'recipe_id'=>$recipe_id,
                    'festival_id'=>$festival,
                ]);
                
            }
        }


        $avoiditlist=$request->avoid_it;
        if(!empty($avoiditlist)){
           foreach ($avoiditlist as $key=> $avoidit) { 
             
             MealDiseasesAvoidRecipe::create([
                'recipe_id'=>$recipe_id,
                'diseases_id'=>$avoidit,

             ]);

            }
           }
            
          $mealtimminglist=$request->meal_timming;
            if(!empty($mealtimminglist)){
               foreach ($mealtimminglist as $key=> $mealtimming) {  

                RecipeMealPlanSettings::create([
                   'recipe_id'=>$recipe_id,
                    'type_of_plan'=>$mealtimming,
                ]);
            }

        }
         
       





        return  redirect()->route('recipe.index')->with('success', 'Recipe Created Successfully');
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
        $recipe = Recipe::find($id);
        $recipecategorylist = RecipeCategory::all();
        $recipesublist = RecipeSubCategory::all();
        $recipesubsubcategorylist = RecipeSubSubCategory::all();
        $dishtypelist = DishType::all();
        $mealcheflist = MealChef::all();
        $cuisineslist = Cuisines::all();
        $regionlist = Regions::all();
        $seasonalist = mealseasons::all();
        $mealcomplexitylist = mealcomplexity::all();
        $mealrecipeunitlist = mealrecipeunit::all();
        $cooking_type = cookingtype::all();
        $mdstatelist = MDState::all();
        $frequency = MRFrequency::all();
        $ayurvedalist = AyurVeda::all();
        $mealtype = MealType::all();
        $festival = Festivals::all();
        $mrtempraturelist = MRtemprature::all();
        $ingredientcategorylist = IngredientCategory::all();
        $ingredentslist = Ingredents::All();
        $recipeingredentslist = RecipeIngredents::where('recipe_id', $id)->get();
        $ingStateList = IngredientState::all();
        $role = Helper::role_slug();
        $tastelist= Taste::all();
        $mealdiseaseslists=MealDiseases::all();
        $recipelist = Recipe::all();
        $recipeBestMix = RecipeBestMix::where('recipe_id', $id)->get();
        $recipeAvoidMix = RecipeAvoidMix::where('recipe_id', $id)->get();
        $mealtags=Tags::all();
        $diets=Diets::all();
        $recipeDiettype = RecipeDiettypeTags::where('recipe_id',$id)->get();
        $recipeTags = RecipeTags::where('recipe_id',$id)->get();
        $recipeFestival = RecipeFestival::where('recipe_id',$id)->get();
        $recipemealplansettings=RecipeMealPlanSettings::where('recipe_id',$id)->get();

        return view('recipe.edit', compact('recipe', 'recipelist', 'recipecategorylist', 'recipesublist', 'recipesubsubcategorylist', 'dishtypelist', 'mealcheflist', 'cuisineslist', 'regionlist', 'seasonalist', 'mealcomplexitylist', 'mealrecipeunitlist', 'cooking_type', 'mdstatelist', 'frequency', 'ayurvedalist', 'mealtype', 'festival', 'mrtempraturelist', 'ingredientcategorylist', 'ingredentslist', 'recipeingredentslist', 'ingStateList', 'role','tastelist','mealdiseaseslists', 'recipeBestMix', 'recipeAvoidMix','mealtags','diets', 'recipeDiettype', 'recipeTags', 'recipeFestival','recipemealplansettings'));
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
                'recipe_hindi' => 'required',
                'known_as' => 'required',
            ]);

            $recipe=Recipe::find($id);
            $recipe->name_in_hindi = $request->recipe_hindi;
            $recipe->also_known = $request->known_as;
            $recipe->full_description = $request->long_desc;
            $recipe->description = $request->short_desc;
            $recipe->instruction = $request->instruction;
            $recipe->update();

            return redirect()->route('recipe.index')->with('success','Details Updated Successfully');
        }
        if($role=='viewer'){
            return redirect()->back()->with('success','You are not autherise for update');
         }


        $validated = $request->validate([
            'Recipe_Name' => 'required',
            'category' => 'required',
            'known_as' => 'required',
            'category' => 'required',
            'dishtype' => 'required',
            'Cuisine_Type' => 'required',
            'Region' => 'required',
            'seasonal' => 'required',
            'complexity' => 'required',
            'Cooking_Type' => 'required',
            'preparation' => 'required',
            'cooking' => 'required',
            'Recipe_unit' => 'required',
            'Frequency' => 'required',
        ]);

        $recipe = Recipe::find($id);
        $recipe->name = $request->Recipe_Name;
        $recipe->name_in_hindi = $request->recipe_hindi;
        $recipe->also_known = $request->known_as;
        if ($role == 'admin' || $role == 'user') {
        $recipe->category = $request->category;
        $recipe->sub_category = $request->Sub_Cat;
        $recipe->sub_sub_category = $request->S_Sub_Cat;
        $recipe->dish_type = $request->dishtype;
        $recipe->chef = $request->chef;
        $recipe->cuisine_type = $request->Cuisine_Type;
        $recipe->region = $request->Region;
        $recipe->type_seasonal_recipe = $request->seasonal;
        $recipe->meal_complexity_id = $request->complexity;
        $recipe->cooking_type = $request->Cooking_Type;
        $recipe->keeps_well = $request->keeps_Well;
        $recipe->recipe_unit = $request->Recipe_unit;
        $recipe->main_dish = ($request->main_dish == 1) ? 1 : 0;
        $recipe->breakfast = ($request->breakfast == 1) ? 1 : 0;
        $recipe->is_basic_food = ($request->basic_food == 1) ? 1 : 0;
        $recipe->recipe_leftover = ($request->leftover_G == 1) ? 1 : 0;
        $recipe->single_serving = ($request->single_serve == 1) ? 1 : 0;
        $recipe->cook_time_to = ($request->batch_cook == 1) ? 1 : 0;
        $recipe->prep_time = (!empty($request->preparation)) ? $request->preparation : 0;
        $recipe->pre_prep_time = (!empty($request->pre_preparation)) ? $request->pre_preparation : 0;
        $recipe->cook_time = $request->cooking;
        $recipe->no_sections = $request->no_of_section;
        $recipe->category = $request->category;
        $recipe->serving_description = 1;
        $recipe->url_rewrite = $request->Slug;
        $recipe->taste= $request->Taste;
        $recipe->sub_sub_category = 0;
        }
        
        $recipe->directions = 0;
        $recipe->positive_point = 0;
        $recipe->tags = 0;
        $recipe->meta_title = 0;
        $recipe->meta_desctiption = 0;
        $recipe->meta_tags = 0;
        $recipe->festivals = $request->festivals;
        $recipe->serving_size = -0;
        $recipe->approved = 0;
        $recipe->created_by = Auth::id();
        $recipe->calories = (!empty($request->total_calories)) ? $request->total_calories : 0;
        $recipe->protien = (!empty($request->total_protein)) ? $request->total_protein : 0;
        $recipe->fat = (!empty($request->total_fat)) ? $request->total_fat : 0;
        $recipe->carbs = (!empty($request->carbs_total)) ? $request->carbs_total : 0;
        $recipe->yields = 0;
        $recipe->fiber = 0;
        $recipe->price = 0;
        $recipe->breakfast_food = 0;
        $recipe->per_serving_calories = 0;
        $recipe->sugar = 0;
        $recipe->saturated_fat = 0;
        $recipe->cholesterol = 0;
        $recipe->meal_dish_state = 1;
        $recipe->temprature = $request->serveT;
        $recipe->meal_recipe_Frequency = $request->Frequency;
        $recipe->existing_url = 0;
        $recipe->remarks = 0;
        $recipe->Ingredient_check = 0;
        $recipe->content_edit_check = 0;
        $recipe->complete = 0;
        $recipe->new_name = 0;
        $recipe->new_serving_size = 0;
        $recipe->title = 0;
        $recipe->recipe_origin = 0;
        
        if($role != 'nutrient'){
        $recipe->full_description = $request->long_desc;
        $recipe->description = $request->short_desc;
        $recipe->instruction = $request->instruction;
        }
        $recipe->update();


        $recipe_id = $recipe->id;

        $old_inglist=RecipeIngredents::where('recipe_id',$recipe_id)->get()->toArray();
        $ingd = $request->ingredient_name;
        if (!empty($ingd)) {
            foreach ($ingd as $key => $ingval) {

                $ing_position = array_search($ingval, $request->ing_id);

                if (isset($ing_position)) {
                    $mesur = $request->mesur[$ing_position];
                    $qty = $request->qty[$ing_position];
                    $state = $request->state[$ing_position];
                    $section = (!empty($request->section[$ing_position])) ? $request->section[$ing_position] : 0;
                    $main = $request->main[$ing_position];
                    $order = $request->order[$ing_position];
                    RecipeIngredents::updateOrCreate(
                        ['recipe_id' => $recipe_id,'ingredent_id' => $ingval],
                        [
                        'unit_measure' => $mesur,
                        'quantity' => $qty,
                        'meal_ingre_state' => $state,
                        'section_id' => $section,
                        'is_main_ingredien' => $main,
                        'in_order' => $order,
                        'notify' => 0,
                    ]);
                }
            }
        }
        if(!empty($old_inglist) && !empty($request->ing_id)){
            foreach($old_inglist as $key=>$old_ing){
                if (!in_array($old_ing['ingredent_id'], $request->ing_id)) {
                    $delMatchAry = ['recipe_id' => $recipe_id,'ingredent_id' => $old_ing['ingredent_id'] ];
                    RecipeIngredents::where($delMatchAry)->delete();
                }
            }
        }


        $old_BestMix=RecipeBestMix::where('recipe_id',$recipe_id)->get()->toArray();
        $besteatList=$request->best_to_eat_with;
        if(!empty($besteatList)){
            foreach ($besteatList as $key=> $besteat) {
               
                    RecipeBestMix::updateOrCreate([
                        'recipe_id'=>$recipe_id,
                        'with_recipe_id'=>$besteat,
                    ], ['status' => 1]);
                
            }
        }
        if(!empty($old_BestMix) && !empty($besteatList)){
            foreach($old_BestMix as $key=>$old_bmix){
                if (!in_array($old_bmix['with_recipe_id'], $besteatList)) {
                    $delMatchAry = ['recipe_id' => $recipe_id,'with_recipe_id' => $old_bmix['with_recipe_id'] ];
                    RecipeBestMix::where($delMatchAry)->delete();
                }
            }
        }

        $old_avoid_with=RecipeAvoidMix::where('recipe_id',$recipe_id)->get()->toArray();
       $avoidList=$request->avoid_with;
        if(!empty($avoidList)){
            foreach ($avoidList as $key=> $avoidwith) {
               
                    RecipeAvoidMix::updateOrCreate([
                        'recipe_id'=>$recipe_id,
                        'avoid_with_recipe'=>$avoidwith,
                    ], ['status' => 1]);
                
            }
        }
        if(!empty($old_avoid_with) && !empty($avoidList)){
            foreach($old_avoid_with as $key=>$old_avoid){
                if (!in_array($old_avoid['avoid_with_recipe'], $avoidList)) {
                    $delMatchAry = ['recipe_id' => $recipe_id,'avoid_with_recipe' => $old_avoid['avoid_with_recipe'] ];
                    RecipeAvoidMix::where($delMatchAry)->delete();
                }
            }
        }

        $old_occasions=RecipeTags::where('recipe_id',$recipe_id)->get()->toArray();
        $occasionsList=$request->occasions;
        if(!empty($occasionsList)){
            foreach ($occasionsList as $key=> $occasion) {
            
                RecipeTags::updateOrCreate([
                    'recipe_id'=>$recipe_id,
                    'tag_id'=>$occasion,
                ]);
                
            }
        }
        if(!empty($old_occasions) && !empty($occasionsList)){
            foreach($old_occasions as $key=>$old_occ){
                if (!in_array($old_occ['tag_id'], $occasionsList)) {
                    $delMatchAry = ['recipe_id' => $recipe_id,'tag_id' => $old_occ['tag_id'] ];
                    RecipeTags::where($delMatchAry)->delete();
                }
            }
        }

        $old_Diettype=RecipeDiettypeTags::where('recipe_id',$recipe_id)->get()->toArray();
        $dietTypeList=$request->diet_type;
        if(!empty($dietTypeList)){
            foreach ($dietTypeList as $key=> $dietType) {
            
                RecipeDiettypeTags::updateOrCreate([
                    'recipe_id'=>$recipe_id,
                    'diettype_id'=>$dietType,
                ]);
                
            }
        }
        if(!empty($old_Diettype) && !empty($dietTypeList)){
            foreach($old_Diettype as $key=>$old_diet){
                if (!in_array($old_diet['diettype_id'], $dietTypeList)) {
                    $delMatchAry = ['recipe_id' => $recipe_id,'diettype_id' => $old_diet['diettype_id'] ];
                    RecipeDiettypeTags::where($delMatchAry)->delete();
                }
            }
        }

        
        $old_RFestival=RecipeFestival::where('recipe_id',$recipe_id)->get()->toArray();
        $festivalsList=$request->festivals;
        if(!empty($festivalsList)){
            foreach ($festivalsList as $key=> $festival) {
            
                RecipeFestival::updateOrCreate([
                    'recipe_id'=>$recipe_id,
                    'festival_id'=>$festival,
                ]);
                
            }
        }
        if(!empty($old_RFestival) && !empty($festivalsList)){
            foreach($old_RFestival as $key=>$old_festival){
                if (!in_array($old_festival['festival_id'], $festivalsList)) {
                    $delMatchAry = ['recipe_id' => $recipe_id,'festival_id' => $old_diet['festival_id'] ];
                    RecipeFestival::where($delMatchAry)->delete();
                }
            }
        }
            
        $avoiditlist=$request->avoid_it;
        if(!empty($avoiditlist)){
            foreach ($avoiditlist as $key=> $avoidit) { 
                
                MealDiseasesAvoidRecipe::updateOrCreate([
                'recipe_id'=>$recipe_id,
                'diseases_id'=>$avoidit,

                ]);

            }
        }
            
       $mealtimminglist=$request->meal_timming;
            if(!empty($mealtimminglist)){
               foreach ($mealtimminglist as $key=> $mealtimming) {  

                RecipeMealPlanSettings::updateOrCreate([
                   'recipe_id'=>$recipe_id,
                    'type_of_plan'=>$mealtimming,
                ]);
            }

        }
         


        return redirect()->route('recipe.index')->with('success', 'Recipe Updated Successfully');
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

            $recipe = Recipe::findOrFail($id);            

        } catch(\Exception $exception){
            $errormsg = 'Request ingredient not there in database';

            return redirect()->route('recipe.index')->with('error', $errormsg);
        }

        $recipeing=RecipeIngredents::where('recipe_id', '=', $id)->delete();


        $recipe->delete();

        if ($recipe)
        return redirect()->route('recipe.index')->with('success','Recorded deleted Successfully');

    
    }


    public function getRecipeFilter(Request $request){

        $filterBy = $request->filterid;
        $subFilterAry = array();
       

        // if($filterBy == '1'){
        //     $recipeList = Recipe::all();
        //     foreach($recipeList as $recipe)
        //     $subFilterAry[] = array("id"=>$recipe->id, "name"=> $recipe->name);

        // } else 
        if($filterBy == '1'){
            $ingredentList = Ingredents::all();
            foreach($ingredentList as $ingredent)
            $subFilterAry[] = array("id"=>$ingredent->id, "name"=> $ingredent->name);

        } else if($filterBy == '2'){
            $categoryList = RecipeCategory::all();
            foreach($categoryList as $category)
            $subFilterAry[] = array("id"=>$category->id, "name"=> $category->name);
        }else if($filterBy == '3'){
            $categoryList = RecipeSubCategory::all();
            foreach($categoryList as $category)
            $subFilterAry[] = array("id"=>$category->id, "name"=> $category->sub_category_name);
        }else if($filterBy == '4'){
            $dishList =DishType::all();
            foreach($dishList as $dish)
            $subFilterAry[] = array("id"=>$dish->id, "name"=> $dish->name);
        }
        else if($filterBy == 5 ){

            //$dishList =DishType::all();
            for($i=1; $i<=180; $i++)
            $subFilterAry[] = array("id"=>$i, "name"=> $i);

        }
        else if($filterBy == 6 ){
            $seasonalist = mealseasons::all();
            foreach($seasonalist as $season)
            $subFilterAry[] = array("id"=>$season->id, "name"=> $season->name);

        }
        
        
        return json_encode($subFilterAry);

    }


    function check(Request $request){
       
        $recipe_name=$request->recipe;

        $data=Recipe::where('name',$recipe_name)->first();

        if(!empty($data))
        $return_array = array('status'=>0, 'message'=>'Name already exist');
        else
        $return_array = array('status'=>1, 'message'=>'Name looks good');

        return json_encode($return_array);
        
    }

}
