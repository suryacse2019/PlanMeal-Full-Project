<x-app-layout>
@if (session('success'))
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            @endif
    <form class="needs-validation" action="{{ route('recipe.update', $recipe->id) }}" method="POST" novalidate="" id="form_data">
        @csrf
        {{ method_field('PUT') }}
        <div class="col-sm-12">
            

            <div class="card">
                <div class="card-header pb-0">
                    <h5>Edit Recipe</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Recipe Name</label>
                            <input class="form-control" id="Recipe_Name" type="text" name="Recipe_Name"
                                placeholder="Recipe Name" value="{{ $recipe->name }}" required="">
                            <div class="invalid-feedback">Please Insert Recipe name</div>
                            @error('Recipe_Name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Name in Hindi</label>
                            <input class="form-control" id="recipe_hindi" type="text" name="recipe_hindi"
                                placeholder="Name in Hindi" value="{{ $recipe->name_in_hindi }}" required="">
                            <div class="invalid-feedback">Looks good!</div>
                            @error('recipe_hindi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">known as</label>
                            <input class="form-control" id="known_as" name="known_as" type="text"
                                placeholder="known as" value="{{ $recipe->also_known }}"
                                aria-describedby="inputGroupPrepend" required="">
                            <div class="invalid-feedback">Please choose .</div>
                            @error('known_as')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>


                    <ul class="nav nav-tabs nav-primary" id="top-tab" role="tablist">
                        @if ($role != 'content-editor' && $role != 'nutrient')
                            <li class="nav-item"><a class="nav-link active" id="top-basic-tab"
                                    data-bs-toggle="tab" href="#top-basic" role="tab" aria-controls="top-home"
                                    aria-selected="true"><i class="icofont icofont-ui-home"></i>Basic Details</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-section-tab"
                                    data-bs-toggle="tab" href="#top-section" role="tab" aria-controls="top-profile"
                                    aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Sections</a>
                            </li>
                        @endif
                        @if ($role != 'content-editor')
                            @php
                                if ($role == 'nutrient') {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }
                            @endphp

                            <li class="nav-item"><a class="nav-link {{ $active }}" id="top-ingredient-tab"
                                    data-bs-toggle="tab" href="#top-ingredient" role="tab"
                                    aria-controls="top-ingredient" aria-selected="false"><i
                                        class="icofont icofont-contacts"></i>Ingredient</a></li>
                        @endif
                        @if ($role != 'nutrient')
                            @php
                                if ($role == 'content-editor') {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }
                            @endphp

                            <li class="nav-item"><a class="nav-link {{ $active }}" id="top-desc-tab"
                                    data-bs-toggle="tab" href="#top-desc" role="tab" aria-controls="top-desc"
                                    aria-selected="false"><i class="icofont icofont-contacts"></i>Description</a></li>
                        @endif
                        @if ($role != 'content-editor')
                            <li class="nav-item"><a class="nav-link" id="top-tags-tab" data-bs-toggle="tab"
                                    href="#top-tags" role="tab" aria-controls="top-tags" aria-selected="false"><i
                                        class="icofont icofont-contacts"></i>Tags</a></li>
                        @endif
                    </ul>
                    <div class="tab-content" id="top-tabContent">

                        @if ($role != 'content-editor' && $role != 'nutrient')
                            <div class="tab-pane fade show active" id="top-basic" role="tabpanel"
                                aria-labelledby="top-basic-tab">

                                <div class="row g-3 pt-3">

                                    <div class="col-md-2">
                                        <label class="form-label">Category</label>
                                        @if (!empty($recipecategorylist))
                                            <select class="form-select" id="category" name="category" required="">
                                                <option>category</option>
                                                @foreach ($recipecategorylist as $category)
                                                    @php
                                                        $selected = '';
                                                        if ($category->id == $recipe->category) {
                                                            $selected = 'selected';
                                                        }
                                                    @endphp
                                                    <option value="{{ $category->id }}" {{ $selected }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-2">
                                        <label class="form-label">Sub Cat</label>
                                        @if (!empty($recipesublist))
                                            <select class="form-select" id="Sub_Cat" name="Sub_Cat" required="">
                                                <option>Sub Cat</option>
                                                @foreach ($recipesublist as $recipesubsategory)
                                                    @php
                                                        $selected = '';
                                                        if ($recipesubsategory->id == $recipe->sub_category) {
                                                            $selected = 'selected';
                                                        }
                                                    @endphp
                                                    <option value="{{ $recipesubsategory->id }}"
                                                        {{ $selected }}>
                                                        {{ $recipesubsategory->sub_category_name }} </option>
                                                @endforeach
                                            </select>
                                        @endif

                                    </div>
                                    @error('Sub_Cat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">S Sub Cat</label>
                                        @if (!empty($recipesubsubcategorylist))
                                            <select class="form-select" id="S_Sub_Cat" name="S_Sub_Cat" >
                                                <option> S Sub Cat</option>
                                                @foreach ($recipesubsubcategorylist as $recipesubsubcategory)
                                                    <option value="{{ $recipesubsubcategory->id }}">
                                                        {{ $recipesubsubcategory->sub_sub_category_name }}
                                                    </option>
                                                    <option value="1"></option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Dish Type</label>
                                        @if (!empty($dishtypelist))
                                            <select class="form-select" id="Dish_Type" name="dishtype" >
                                                <option value="0">Dish Type</option>
                                                @foreach ($dishtypelist as $dishtype)
                                                    @php
                                                        $selected = '';
                                                        if ($dishtype->id == $recipe->dish_type) {
                                                            $selected = 'selected';
                                                        }
                                                    @endphp
                                                    <option value="{{ $dishtype->id }}" {{ $selected }}>
                                                        {{ $dishtype->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Chef</label>
                                        @if (!empty($dishtypelist))
                                            <select class="form-select" id="chef" name="chef" >
                                                <option selected="" disabled="" value="">chef</option>
                                                @foreach ($mealcheflist as $mealchef)
                                                    @php
                                                        $selected = '';
                                                        if ($mealchef->id == $recipe->chef) {
                                                            $selected = 'selected';
                                                        }
                                                    @endphp
                                                    <option value="{{ $mealchef->id }}" {{ $selected }}>
                                                        {{ $mealchef->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">No of section</label>
                                        <select class="form-select" id="no_of_section" name="no_of_section">
                                            <option selected="" disabled="" value="">No of section</option>
                                            @for ($i = 0; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ $recipe->no_sections == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor

                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Cuisine Type</label>
                                        @if (!empty($cuisineslist))
                                            <select class="form-select" id="Cuisine_Type" name="Cuisine_Type"
                                                required="">
                                                <option selected="" disabled="" value="">Cuisine Type</option>
                                                @foreach ($cuisineslist as $cuisines)
                                                    @php
                                                        $selected = '';
                                                        if ($cuisines->id == $recipe->cuisine_type) {
                                                            $selected = 'selected';
                                                        }
                                                    @endphp
                                                    <option value="{{ $cuisines->id }}" {{ $selected }}>
                                                        {{ $cuisines->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Region</label>
                                        @if (!empty($regionlist))
                                            <select class="form-select" id="Region" name="Region" required="">
                                                <option>Region</option>
                                                @foreach ($regionlist as $regions)
                                                    php
                                                    $selected = '';
                                                    if($regions->id == $recipe->region){
                                                    $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $regions->id }}" {{ $selected }}>
                                                        {{ $regions->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Seasonal</label>
                                        @if (!empty($seasonalist))
                                            <select class="form-select" id="seasonal" name="seasonal" required="">
                                                <option selected="" disabled="" value="">Seasonal</option>
                                                @foreach ($seasonalist as $mealseasons)
                                                    php
                                                    $selected = '';
                                                    if($mealseasons->id == $recipe->type_seasons_recipe){
                                                    $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $mealseasons->id }}" {{ $selected }}>
                                                        {{ $mealseasons->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Complexity</label>
                                        @if (!empty($mealcomplexitylist))
                                            <select class="form-select" id="complexity" name="complexity"
                                                required="">
                                                <option selected="" disabled="" value="">Complexity</option>
                                                @foreach ($mealcomplexitylist as $mealcomplexity)
                                                    php
                                                    $selected = '';
                                                    if($mealcomplexity->id == $recipe->meal_complexity_id){
                                                    $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $mealcomplexity->id }}" {{ $selected }}>
                                                        {{ $mealcomplexity->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Cooking Type</label>
                                        @if (!empty($cooking_type))
                                            <select class="form-select" id="Cooking_Type" name="Cooking_Type"
                                                required="">
                                                <option selected="" disabled="" value="">Cooking Type</option>
                                                @foreach ($cooking_type as $cookingtype)
                                                    php
                                                    $selected = '';
                                                    if($cookingtype->id == $recipe->cooking_type){
                                                    $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $cookingtype->id }}" {{ $selected }}>
                                                        {{ $cookingtype->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>


                                    <div class="col-md-2">
                                        <label class="form-label">Pre-Prepration</label>
                                        <input class="form-control digits" type="number" id="pre_preparation"
                                            name="pre_preparation" placeholder="Pre-Prepration">
                                        <div class="invalid-feedback">Please enter pre-preparation time </div>

                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Prepration</label>
                                        <input class="form-control digits" type="number" id="preparation"
                                            name="preparation" placeholder="Prepration"
                                            value="{{ $recipe->prep_time }}" required>
                                        <div class="invalid-feedback">Please enter preparation time</div>

                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Cooking</label>
                                        <input class="form-control digits" type="number" id="cooking" name="cooking"
                                            placeholder="Cooking" value="{{ $recipe->cook_time }}" required>
                                        <div class="invalid-feedback">Please Insert Ingredient name</div>

                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Keeps Well</label>
                                        <input class="form-control" id="keeps_Well" type="text" name="keeps_Well"
                                            placeholder="keeps Well" value="{{ $recipe->keeps_well }}" required="">
                                        <div class="invalid-feedback">Please Insert Ingredient name</div>

                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Recipe unit</label>
                                        @if (!empty($mealrecipeunitlist))
                                            <select class="form-select" id="Recipe_unit" name="Recipe_unit"
                                                required="">
                                                <option selected="" disabled="" value="">Recipe unit</option>
                                                @foreach ($mealrecipeunitlist as $mealrecipeunit)
                                                    php
                                                    $selected = '';
                                                    if($mealrecipeunit->id == $recipe->recipe_unit){
                                                    $selected = 'selected';
                                                    }
                                                    @endphp

                                                    <option value="{{ $mealrecipeunit->id }}" {{ $selected }}>
                                                        {{ $mealrecipeunit->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        @endif


                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">State</label>
                                        @if (!empty($mdstatelist))
                                            <select class="form-select" id="state" name="state" required="">
                                                <option selected="" disabled="" value="">state</option>
                                                @foreach ($mdstatelist as $mdstate)
                                                    php
                                                    $selected = '';
                                                    if($mdstate->id == $recipe->meal_dish_state){
                                                    $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $mdstate->id }}" {{ $selected }}>
                                                        {{ $mdstate->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Frequency</label>
                                        @if (!empty($frequency))
                                            <select class="form-select" id="Frequency" name="Frequency" required="">
                                                <option selected="" disabled="" value="">Frequency</option>
                                                @foreach ($frequency as $mrfrequency)
                                                    php
                                                    $selected = '';
                                                    if($mrfrequency->id == $recipe->meal_recipe_Frequency){
                                                    $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $mrfrequency->id }}" {{ $selected }}>
                                                        {{ $mrfrequency->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>



                                    <div class="col-md-2">
                                        <label class="form-label">Serve T</label>
                                        @if (!empty($mrtempraturelist))
                                            <select class="form-select" id="serveT" name="serveT" required="">
                                                <option selected="" disabled="" value="">Serve T</option>
                                                @foreach ($mrtempraturelist as $mrtemprature)
                                                    php
                                                    $selected = '';
                                                    if($mrtemprature->id == $recipe->temprature){
                                                    $selected = 'selected';
                                                    }
                                                    @endphp
                                                    <option value="{{ $mrtemprature->id }}" {{ $selected }}>
                                                        {{ $mrtemprature->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Slug</label>
                                        <input class="form-control" id="Slug" type="text" name="Slug"
                                            placeholder="slug" value="{{ $recipe->url_rewrite }}" required="">
                                        <div class="invalid-feedback">Please Insert slug</div>

                                    </div>

                                    @if(!empty($tastelist))
                                    <div class="col-md-2">
                                        <label class="form-label">Taste</label>
                                        <select class="form-select" id="Taste" name="Taste" >
                                            <option selected="" disabled="" value="">Taste</option>
                                            @foreach ($tastelist as $taste)
                                                @php
                                                $selected = '';
                                                if($taste->id == $recipe->taste){
                                                $selected = 'selected';
                                                }
                                                @endphp


                                            <option value="{{ $taste->id }}" {{$selected}}>{{ $taste->taste }}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                    @endif


                                    <div class="col-md-2">
                                        <label class="form-label">Ayurveda</label>
                                        @if (!empty($ayurvedalist))
                                            <select class="form-select" id="Ayurveda" name="Ayurveda" >
                                                <option selected="" disabled="" value="">Ayurveda</option>
                                                @foreach ($ayurvedalist as $ayurveda)
                                                    <option value="{{ $ayurveda->id }}">{{ $ayurveda->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                        @endif
                                    </div>

                                    <div class="row g-2 py-2">
                                        <div class="col-md-3">

                                            <div class="media-body switch-outline">
                                                <label class="align-top">Main dish</label>
                                                <label class="switch">

                                                    <input type="checkbox" name="main_dish" value="1" {{ ($recipe->main_dish == 1)? 'checked' : ''}}><span
                                                        class="switch-state bg-primary"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="media-body switch-outline">
                                                <label class="align-top">Breakfast</label>
                                                <label class="switch">

                                                    <input type="checkbox" name="breakfast" value="1" {{ ($recipe->breakfast == 1)? 'checked' : ''}}><span
                                                        class="switch-state bg-primary"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="media-body switch-outline">
                                                <label class="align-top">Basic Food</label>
                                                <label class="switch">

                                                    <input type="checkbox" name="basic_food" value="1" {{ ($recipe->is_basic_food == 1)? 'checked' : ''}}><span
                                                        class="switch-state bg-primary"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="media-body switch-outline">
                                                <label class="align-top">Batch Cook</label>
                                                <label class="switch">

                                                    <input type="checkbox" name="batch_cook" value="1" {{ ($recipe->cook_time_to == 1)? 'checked' : ''}}><span
                                                        class="switch-state bg-primary"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="media-body switch-outline">
                                                <label class="align-top">Leftover G</label>
                                                <label class="switch">

                                                    <input type="checkbox" name="leftover_G" value="1" {{ ($recipe->recipe_leftover == 1)? 'checked' : ''}}><span
                                                        class="switch-state bg-primary"></span>
                                                </label>
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-3">
                                            <div class="media-body switch-outline">
                                                <label class="align-top">Single Serve</label>
                                                <label class="switch">

                                                    <input type="checkbox" name="single_serve" value="1"
                                                    {{ ($recipe->single_serving == 1)? 'checked' : ''}} ><span class="switch-state bg-primary"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="media-body switch-outline">
                                                <label class="align-top">Fasting</label>
                                                <label class="switch">

                                                    <input type="checkbox" name="fasting" value="1" checked=""><span
                                                        class="switch-state bg-primary"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>

                            </div>

                            <div class="tab-pane fade" id="top-section" role="tabpanel"
                                aria-labelledby="profile-top-tab">

                                <!----------------card Title-------------------------->
                                <div class="col-sm-12">

                                    <div class="card">
                                        <div class="card-header pb-0">
                                            <h5> section </h5>
                                        </div>
                                        @for ($s = 1; $s <= $recipe->no_sections; $s++)
                                            <div class="row g-3 p-3" id="">
                                                <div class="col-md-6">
                                                    <label class="form-label">Section#</label>
                                                    <input class="form-control" id="mesure_unit" type="text" name=""
                                                        placeholder="section#" disable value="">
                                                    <div class="invalid-feedback"> name required</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">section name</label>
                                                    <input class="form-control" id="" value="" type="text" name=""
                                                        placeholder="section name">
                                                    <div class="valid-feedback"></div> 
                                                </div>
                                            </div>
                                        @endfor

                                        <div id="sectionlist"></div>


                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($role != 'content-editor')
                            @php
                                if ($role == 'nutrient') {
                                    $active = 'show active';
                                } else {
                                    $active = '';
                                }
                            @endphp

                            <div class="tab-pane fade {{ $active }}" id="top-ingredient" role="tabpanel"
                                aria-labelledby="top-ingredient-tab">

                                <div class="col-sm-12">

                                    <div class="card">
                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-3">

                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h6 class="py-2">Recipe Details</h5>
                                                        </div>
                                                        <div class="collapse show" id="collapseicon"
                                                            aria-labelledby="collapseicon" data-parent="#accordion">
                                                            <div class="card-body socialprofile filter-cards-view">


                                                                <div class="learning-header"><span
                                                                        class="f-w-600">Details</span></div>
                                                                <ul>

                                                                    @php
                                                                        $total_calories = $total_fats = $total_carbs = $total_protein = $total_qty= 0;
                                                                        
                                                                        if (!empty($recipeingredentslist)) {
                                                                            foreach ($recipeingredentslist as $recipeingredents) {

                                                                                $calories = $recipeingredents->ingredent->calories;
                                                                                $fats = $recipeingredents->ingredent->fats;
                                                                                $carbs = $recipeingredents->ingredent->carbs;
                                                                                $protein = $recipeingredents->ingredent->protein;

                                                                                $gm_serve = $recipeingredents->ingredent->serving;
                                                                                $measure_value =0;

                                                                                $measure_id = $recipeingredents->unit_measure;
                                                                                foreach($recipeingredents->Measurements as $measurement){
                                                                                    if($measurement->measurement_id == $measure_id)
                                                                                    $measure_value = $measurement->measure;
                                                                                }
                                                                            
                                                                                $calculate_calories = $calculate_fats = $calculate_carbs = $calculate_protein =0;

                                                                                if($calories>0)
                                                                                $calculate_calories = round(((($calories/$gm_serve)*$measure_value)*$recipeingredents->quantity),2);
                                                                                if($fats>0)
                                                                                $calculate_fats = round(((($fats/$gm_serve)*$measure_value)*$recipeingredents->quantity),2);
                                                                                if($carbs>0)
                                                                                $calculate_carbs = round(((($carbs/$gm_serve)*$measure_value)*$recipeingredents->quantity),2);
                                                                                if($protein>0)
                                                                                $calculate_protein = round(((($protein/$gm_serve)*$measure_value)*$recipeingredents->quantity),2);
                                                                                
                                                                                $total_calories += $calculate_calories;
                                                                                $total_fats += $calculate_fats;
                                                                                $total_carbs += $calculate_carbs;
                                                                                $total_protein += $calculate_protein;

                                                                                $total_qty += $recipeingredents->quantity;
                                                                            }
                                                                        }

                                                                    @endphp


                                                                    <li><a href="#">Calories </a>
                                                                        <input type="hidden" class="form-control-xs"
                                                                            name="total_calories"
                                                                            value="{{ $total_calories }}"
                                                                            id="ing_calories_total" size="10">
                                                                        <span
                                                                            class="pull-right">{{ $total_calories }}</span>
                                                                    </li>

                                                                    <li><a href="#">Protein </a>
                                                                        <input type="hidden" class="form-control-xs"
                                                                            id="ing_protein_total"
                                                                            value="{{ $total_protein }}"
                                                                            size="10" name="total_protein">
                                                                        <span
                                                                            class="pull-right">{{ !empty($recipe->protein) ? $recipe->protein : $total_protein }}</span>
                                                                    </li>
                                                                    <li><a href="#">Fat </a>
                                                                        <input type="hidden" class="form-control-xs"
                                                                            id="ing_fats_total"
                                                                            value="{{ $total_fats }}"
                                                                            size="10" name="total_fat">
                                                                        <span
                                                                            class="pull-right">{{ $total_fats }}</span>
                                                                    </li>
                                                                    
                                                                    <li><a href="#">Carbs </a>
                                                                        <input type="hidden" name="carbs_total"
                                                                            id="ing_carbs_total"
                                                                            value="{{ $total_carbs }}"
                                                                            size="10">
                                                                        <span
                                                                            class="pull-right">{{ $total_carbs }}</span>
                                                                    </li>

                                                                   
                                                                </ul>



                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="col-md-9">
                                                    <div class="row g-3">
                                                        
                                                        <div class="col-md-12">

                                                            @if (!empty($ingredientcategorylist))
                                                            <label>Ingredients category</label>
                                                                <select class="form-select" name="category_list"
                                                                    id="category_list">
                                                                    <option>Select category</option>
                                                                    @foreach ($ingredientcategorylist as $ingredientcategory)
                                                                        <option value="{{ $ingredientcategory->id }}"
                                                                            >
                                                                            {{ $ingredientcategory->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                            <div class="invalid-feedback">Please select a valid
                                                                category.</div>

                                                        </div>



                                                        <!-- ingredient select  -->

                                                        <div class="col-md-12">
                                                            @php
                                                                $recipe_ing = [];
                                                                if (!empty($recipeingredentslist)) {
                                                                    $recipe_ing = array_map(function ($recipe) {
                                                                        return $recipe['ingredent_id'];
                                                                    }, $recipeingredentslist->toArray());
                                                                }
                                                            @endphp

                                                            @if (!empty($ingredentslist))
                                                            <label>Ingredients</label>
                                                                <select class="js-example-basic-multiple form-control"
                                                                    data-placeholder="Select Ingredient Name"
                                                                    name="ingredient_name[]" id="ingredient_name"
                                                                    multiple="multiple">
                                                                    @foreach ($ingredentslist as $ingredents)
                                                                        <option value="{{ $ingredents->id }}"
                                                                            {{ in_array($ingredents->id, $recipe_ing) ? 'selected' : '' }}>
                                                                            {{ $ingredents->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            @endif
                                                            <div class="invalid-feedback">Please select a valid
                                                                ingredent.</div>

                                                        </div>

                                                    </div>
                                                   
                                                   
                                                 </div>
                                            </div>
                                            <div class="row g-1 pt-3" >
                                                <div class="col-md-2">
                                                    <label>Ingredient</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Unit</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>Quantity</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>State</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Notify</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>Section</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>Main Ing.</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>Sort #</label>
                                                </div>
                                            </div>
                                            <div class="row" style="height: 204px;overflow-y: scroll;overflow-x: hidden;" >
                                                <!-- ingredient start -->
                                                @php $ing =0 ; @endphp
                                                @if (!empty($recipeingredentslist))
                                                    @foreach ($recipeingredentslist as $recipeingredents)

                                                        @php
                                                            $calories = $recipeingredents->ingredent->calories;
                                                            $fats = $recipeingredents->ingredent->fats;
                                                            $carbs = $recipeingredents->ingredent->carbs;
                                                            $protein = $recipeingredents->ingredent->protein;

                                                            $gm_serve = $recipeingredents->ingredent->serving;
                                                            $measure_value =0;

                                                            $measure_id = $recipeingredents->unit_measure;
                                                            foreach($recipeingredents->Measurements as $measurement){
                                                                if($measurement->measurement_id == $measure_id)
                                                                 $measure_value = $measurement->measure;
                                                            }
                                                            //echo $calories . "--".$gm_serve ."--".$measure_value ."--".$recipeingredents->quantity;
                                                            $calculate_calories = $calculate_fats = $calculate_carbs = $calculate_protein =0;

                                                            if($calories>0)
                                                            $calculate_calories = round(((($calories/$gm_serve)*$measure_value)*$recipeingredents->quantity),2);
                                                            if($fats>0)
                                                            $calculate_fats = round(((($fats/$gm_serve)*$measure_value)*$recipeingredents->quantity),2);
                                                            if($carbs>0)
                                                            $calculate_carbs = round(((($carbs/$gm_serve)*$measure_value)*$recipeingredents->quantity),2);
                                                            if($protein>0)
                                                            $calculate_protein = round(((($protein/$gm_serve)*$measure_value)*$recipeingredents->quantity),2);
                                                                          
                                                        @endphp

                                                        <div class="row g-1 pt-1"
                                                            data-calories="{{ $recipeingredents->ingredent->calories }}"
                                                            data-fats="{{ $recipeingredents->ingredent->fats }}"
                                                            data-protein="{{ $recipeingredents->ingredent->protein }}"
                                                            data-carbs="{{ $recipeingredents->ingredent->carbs }}"
                                                            data-fiber="{{ $recipeingredents->ingredent->fiber_in_gm }}"
                                                            data-serving={{ $recipeingredents->ingredent->serving}}
                                                            data-calories-last="{{$calculate_calories}}" 
                                                            data-fats-last="{{$calculate_fats}}"  
                                                            data-protein-last="{{$calculate_protein}}"  
                                                            data-carbs-last="{{$calculate_carbs}}"
                                                            id="r_ing_{{ $recipeingredents->ingredent->id }}">

                                                            <div class="col-md-2">

                                                                <input type="hidden" name="ing_id[]"
                                                                    value="{{ $recipeingredents->ingredent->id }}">
                                                                <input class="form-control" id="" type="text"
                                                                    name="ing_name[]" placeholder="Name"
                                                                    value="{{ $recipeingredents->ingredent->name }}"
                                                                    required="" readonly>

                                                                <div class="invalid-feedback">Ingredient name
                                                                    required
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">

                                                                <select class="form-select calculation_update" data-ing="{{ $recipeingredents->ingredent->id}}" name="mesur[]"
                                                                    required="">
                                                                    @foreach ($recipeingredents->Measurements as $mesure)
                                                                        <option
                                                                            value="{{ $mesure->measurement_id }}" data-weight="{{ $mesure->measure}}"
                                                                            {{ $recipeingredents->unit_measure == $mesure->measurement_id ? 'selected' : '' }}>
                                                                            {{ $mesure->measurementname->unit }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-1">

                                                                <input class="form-control calculation_update" data-ing="{{ $recipeingredents->ingredent->id}}"  type="number"
                                                                    name="qty[]" placeholder="qty"
                                                                    value="{{ $recipeingredents->quantity }}"
                                                                    required="" min="0" step=".01">
                                                                <div class="invalid-feedback">Qty
                                                                    required
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                @if (!empty($ingStateList))
                                                                    <select class="form-select" id=""
                                                                        name="state[]">
                                                                        @foreach ($ingStateList as $ingState)
                                                                            <option value="{{ $ingState->id }}"
                                                                                {{ $recipeingredents->meal_ingre_state == $ingState->id ? 'Selected' : '' }}>
                                                                                {{ $ingState->state }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </div>

                                                            <div class="col-md-2">

                                                                <input class="form-control " type="text"
                                                                    name="notify[]" placeholder="Notify"
                                                                    value="{{ $recipeingredents->notify }}"
                                                                    >
                                                                
                                                            </div>

                                                            <div class="col-md-1">
                                                                <select class="form-select" id=""
                                                                    name="section[]">
                                                                    @for ($i = 1; $i <= $recipe->no_sections; $i++)
                                                                        <option value="{{ $i }}"
                                                                            {{ $recipe->no_sections == $i ? 'selected' : '' }}>
                                                                            {{ $i }}</option>
                                                                    @endfor

                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <select class="form-select" id="" name="main[]"
                                                                    required="">
                                                                    <option value="1"
                                                                        {{ $recipeingredents->is_main_ingredien == 1 }}>
                                                                        Yes</option>
                                                                    <option value="0"
                                                                        {{ $recipeingredents->is_main_ingredien == 0 }}>
                                                                        No</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input class="form-control" id="" placeholder=""
                                                                    type="text" name="order[]"
                                                                    value="{{ $ing++ }}" required="">
                                                                <div class="invalid-feedback"> </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <!-- End ingredient start -->
                                                <div id="ingredient_list" class="p-0"></div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($role != 'nutrient')
                            @php
                                if ($role == 'content-editor') {
                                    $active = 'show active';
                                } else {
                                    $active = '';
                                }
                            @endphp

                            <div class="tab-pane fade {{ $active }}" id="top-desc" role="tabpanel"
                                aria-labelledby="contact-top-tab">

                                <div class="card-body">
                                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-longDesc" role="tab" aria-controls="top-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Long Description</a></li>

                                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-shortDesc" role="tab" aria-controls="top-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Short Description</a></li>
                                        <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-instruction" role="tab" aria-controls="top-contact" aria-selected="false"><i class="icofont icofont-contacts"></i>Instruction</a></li>
                                    </ul>
                                    
                                    <div class="tab-content" id="top-tabContent">
                                        <div class="tab-pane fade show active" id="top-longDesc" role="tabpanel" aria-labelledby="top-home-tab">
                                            <textarea class="editable" id="long_desc" name="long_desc">{{$recipe->full_description}}</textarea>
                                            <div id="long_desc_charNum"></div>
                                        </div>
                                        <div class="tab-pane fade" id="top-shortDesc" role="tabpanel" aria-labelledby="profile-top-tab">
                                            <textarea id="short_desc" class="editable" name="short_desc">{{$recipe->description}}</textarea>
                                            <div id="short_desc_charNum"></div>
                                        </div>
                                        <div class="tab-pane fade" id="top-instruction" role="tabpanel" aria-labelledby="contact-top-tab">
                                            <textarea id="instruction" class="editable" name="instruction">{{$recipe->instruction}}</textarea>
                                            <div id="instruction_charNum"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                        @if ($role != 'content-editor')

                            <div class="tab-pane fade" id="top-tags" role="tabpanel"
                                aria-labelledby="contact-top-tab">


                                <div class="col-sm-12">


                                    <div class="card-header pb-0">
                                        <h5> Tags </h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="row g-3">


                                            <div class="col-md-6">
                                                <label class="form-label">Select Meal Timing</label>
                                                @if (!empty($mealtype))
                                                    <select class="js-example-basic-multiple form-control w-100"
                                                        data-placeholder="Select Meal Timing " name="meal_timming[]"
                                                        id="meal_timming[]" multiple="multiple">

                                                        @foreach ($mealtype as $MealType)
                                                       
                                                    
                                                            <option value="{{ $MealType->id }}" >{{ $MealType->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                @if (!empty($diets))
                                                <label class="form-label">Select Diet Type</label>
                                                <select class="js-example-basic-multiple form-control w-100"
                                                    id="diet_type" data-placeholder="Select Diet Type "
                                                    multiple="multiple" name="diet_type[]" >
                                                    @foreach ($diets as $dietslist)
                                                        @php
                                                            $selected = '';
                                                            foreach($recipeDiettype as $Diettype){
                                                                if ($dietslist->id == $Diettype->diettype_id) {
                                                                    $selected = 'selected';
                                                                }
                                                            }
                                                        @endphp

                                                        <option value="{{ $dietslist->id }}" {{ $selected }}>{{ $dietslist->name }}
                                                     </option>
                                                    @endforeach         
                                                </select>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                @if (!empty($mealtags))
                                                <label class="form-label">Select Occasions</label>
                                                <select class="js-example-basic-multiple form-control w-100"
                                                    data-placeholder="Select Occasions " id="occasions"
                                                    multiple="multiple" name="occasions[]" >
                                                      @foreach ($mealtags as $tags)
                                                        @php
                                                        $selected = '';
                                                        foreach($recipeTags as $recipeTag){
                                                            if ($tags->id == $recipeTag->tag_id) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                        @endphp
                                                      
                                                   <option value="{{ $tags->id }}" {{ $selected }}>{{ $tags->name }}
                                                     </option>
                                                      @endforeach    
                                                </select>
                                                @endif
                                            </div>


                                            <div class="col-md-4">
                                                <label class="form-label">Select Festivals</label>
                                                @if (!empty($festival))
                                                    <select class="js-example-basic-multiple form-control w-100"
                                                        data-placeholder="Select Festivals " id="festivals"
                                                        multiple="multiple" name="festivals[]" >
                                                        @foreach ($festival as $festi)
                                                        @php
                                                        $selected = '';
                                                        foreach($recipeFestival as $recipeF){
                                                            if ($festi->id == $recipeF->festival_id) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                        @endphp
                                                        

                                                            <option value="{{ $festi->id }}" {{ $selected }}>
                                                                {{ $festi->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                             
                                            @if (!empty($recipelist)) 
                                            <div class="col-md-4">
                                                <label class="form-label">Select Best to eat</label>
                                               
                                                <select class="js-example-basic-multiple form-control w-100"
                                                    data-placeholder="Select Best to eat" multiple="multiple"
                                                    id="best_to_eat_with" name="best_to_eat_with[]" >
                                                     
                                                    @foreach ($recipelist as $recipe_details)
                                                    @php
                                                        $selected = '';
                                                        foreach($recipeBestMix as $recipebmix){
                                                            if ($recipe_details->id == $recipebmix->with_recipe_id) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                    @endphp

                                                    <option value="{{ $recipe_details->id }}" {{ $selected }} >{{ $recipe_details->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                            @endif 
                                             
                                            @if (!empty($mealdiseaseslists))
                                            <div class="col-md-6">
                                                <label class="form-label">Select Avoid it</label>
                                                <select class="js-example-basic-multiple form-control w-100"
                                                    data-placeholder="Select Avoid it " multiple="multiple"
                                                    id="avoid_it" name="avoid_it[]" >
                                                    @foreach ($mealdiseaseslists as $mealdiseases)

                                                    <!-- @php
                                                    $selected = '';
                                                    if ($mealdiseases->id == $recipe->disease_id) {
                                                    $selected = 'selected';
                                                    }
                                                    @endphp -->

                                                    <option value="{{ $mealdiseases->id }}" >{{ $mealdiseases->name }}</option>
                                                   @endforeach
                                                </select>
                                               
                                            </div>
                                             @endif
                                            
                                             @if (!empty($recipelist))
                                            <div class="col-md-6">
                                                <label class="form-label">Select Avoid with</label>
                                                <select class="js-example-basic-multiple form-control w-100"
                                                    data-placeholder="Select Avoid with" multiple="multiple"
                                                    id="avoid_with" name="avoid_with[]">
                                                    @foreach ($recipelist as $recipe_details)
                                                    @php
                                                        $selected = '';
                                                        foreach($recipeAvoidMix as $recipeamix){
                                                            if ($recipe_details->id == $recipeamix->avoid_with_recipe) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                    @endphp

                                                    <option value="{{ $recipe_details->id }}" {{ $selected }}>{{ $recipe_details->name }}</option>
                                                    @endforeach
                                                </select>
                                                 
                                            </div>
                                            @endif


                                            
                                        </div>
                                    </div>

                                </div>

                            </div>

                        @endif


                    </div>



                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>

        </div>

    </form>

    @push('extra_script')
        <script src="{{ asset('assets/js/form-wizard/form-wizard-three.js') }}"></script>
        <script src="{{ asset('assets/js/form-wizard/jquery.backstretch.min.js') }}"></script>

        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/simple-mde.css') }}">
        <script src="{{ asset('assets/js/editor/simple-mde/simplemde.min.js') }}"></script> --}}

        <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/editor/ckeditor/styles.js') }}"></script>


        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>

        <!-- Plugins JS Ends-->
        <script type="text/javascript">
            var slug = function(str) {
                str = str.replace(/^\s+|\s+$/g, ''); // trim
                str = str.toLowerCase();

                // remove accents, swap ñ for n, etc
                var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
                var to = "aaaaaeeeeeiiiiooooouuuunc------";
                for (var i = 0, l = from.length; i < l; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }

                str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

                return str;
            };

            var add_total_cal = function(fieldId, curVal) {

                var lastData = parseFloat($("#" + fieldId).val());

                if (lastData > 0) {
                    var curData = parseFloat(lastData) + parseFloat(curVal);

                    $("#" + fieldId).val(curData.toFixed(2));
                    $("#" + fieldId).closest('li').find('span').text(curData.toFixed(2));
                } else {
                    $("#" + fieldId).val(parseFloat(curVal).toFixed(2));
                    $("#" + fieldId).closest('li').find('span').text(parseFloat(curVal).toFixed(2));
                }
            }

            var update_total_cal = function(fieldId, curVal) {

                var lastData = parseFloat($("#" + fieldId).val());

                if (lastData > 0) {
                    var curData = parseFloat(lastData) + curVal;

                    $("#" + fieldId).val(curData.toFixed(2));
                    $("#" + fieldId).closest('li').find('span').text(curData.toFixed(2));
                } else {
                    $("#" + fieldId).val(parseFloat(curVal).toFixed(2));
                    $("#" + fieldId).closest('li').find('span').text(parseFloat(curVal).toFixed(2));
                }
            }

            var remove_total_cal = function(fieldId, ing_id, type) {

                //var del_calories = $('#ingredient_list').find('#r_ing_' + ing_id).attr('data-'+type);

                var last_type_val = $("#r_ing_"+ing_id).attr('data-'+ type +'-last');

                var lastData = $("#" + fieldId).val();
                if(lastData>0)
                var curData = parseFloat(lastData) - last_type_val;
                else
                var curData =0 ;

                $("#" + fieldId).val(curData.toFixed(2));
                $("#" + fieldId).closest('li').find('span').text(curData.toFixed(2));

            }



           

            $(document.body).on("change", "#no_of_section", function() {
                var no_sections = $(this).val();

                var html = '';

                for (var i = 1; i <= no_sections; i++) {
                    html += '<div class="row g-3 pt-3" id="">';

                    html += '<div class="col-md-6">' +
                        '  <input class="form-control" id="mesure_unit" type="text" name="" placeholder="section#" disable value="" >' +
                        '<div class="invalid-feedback"> name required</div>' +
                        '</div>' +

                        '<div class="col-md-6">' +
                        '  <input class="form-control" id="" type="text" name="" placeholder="section name" >' +
                        '  <div class="valid-feedback"></div>' +
                        '</div>' +
                        '</div>';

                }

                $('#sectionlist').html(html);

            });


            $(document.body).on("change", "#category_list", function() {
                var data = {
                    'cate_id': $(this).val()
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('getCateIngredientLIst') }}",
                    data: data,
                    dataType: 'json',
                    success: function(data) {

                        $('#ingredient_name').children('option:not(:selected)').remove();

                        var ingList = [];
                        $.each(data, function(index, value) {

                            var newState = new Option(value.name, value.id, false, false);
                            // Append it to the select
                            $("#ingredient_name").prepend(newState).trigger('change');

                            //ingList.push({id: value.id,text: value.name});
                            //ingList += "<option value='" + value.id + "'>" + value.name +"</option>";
                        });



                        //$('#ingredient_name').select2({data:ingList}).trigger('change');

                        // $('#ingredient_name').html(ingList);

                        //$('.js-example-basic-multiple').select2({
                        //    allowClear: true,
                        // });

                    }
                });

            });


            $('#ingredient_name').on('select2:select', function(e) {
                var dparams = e.params.data;
                var ing_id = dparams.id;

                var data = {
                    'ing_id': ing_id
                };

                var no_section = $("#no_of_section").val();

                var no_ing = 0;
                //console.log(no_section);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('getIngredient') }}",
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        //console.log(data);
                        no_ing++;
                        var no_section = $("#no_of_section").val();

                        var html = ' <div class="row g-1 pt-1" data-calories="' + data.calories +
                             '" data-fats="' + data.fats + '" data-carbs="' + data.carbs +
                             '" data-protein="' + data.protein + '" data-fiber="' + data.fiber_in_gm +
                             '" data-serving="' + data.serving + '" data-calories-last="" data-fats-last=""  data-protein-last=""  data-carbs-last="" id="r_ing_' + data.id + '">' +

                             '<div class="col-md-2">' +
                             '    <input type="hidden" name="ing_id[]" value="' + data.id + '" >' +
                             '    <input class="form-control" readonly type="text" name="ing_name[]" placeholder="Name" value="' +
                             data.name + '" required="">' +
                             '   <div class="invalid-feedback">Ingredient name required</div>' +
                             '</div>' +

                             '<div class="col-md-2">' +
                             '    <select class="form-select calculation_update" data-ing="' + data.id + '" id="" name="mesur[]" required="">';

                         $.each(data.measurement, function(index, value) {
                             html += ' <option value="' + value.id + '" data-weight="' + value.value + '">' + value.name + '</option>';

                         });

                         html += '    </select>' +
                             '</div>' +

                             '<div class="col-md-1">' +
                             '    <input class="form-control calculation_update" data-ing="' + data.id + '" id="" type="number" name="qty[]" placeholder="qty" value="" min="0" step=".01" required="">' +
                             '   <div class="invalid-feedback">Ingredient name required</div>' +
                             '</div>' +



                             '<div class="col-md-2">' +
                             '<select class="form-select" id="" name="state[]" >';
                         $.each(data.state, function(index, value) {
                             html += ' <option value="' + value.id + '">' + value.state + '</option>';
                         });

                         html += '</select>' +
                             '</div>' +

                             '<div class="col-md-2">' +
                             '    <input class="form-control" type="text" name="notify[]" placeholder="Notify" value="" >' +
                             '</div>' +

                             '<div class="col-md-1">' +
                             '<select class="form-select" id="" name="section[]">';

                         for (var i = 1; i <= no_section; i++) {
                             html += ' <option value="' + i + '">' + i + '</option>';
                         }

                         html += '</select>' +
                             '</div>' +
                             '<div class="col-md-1">' +
                             '<select class="form-select" id="" name="main[]" required="">' +

                             ' <option value="1">Yes</option>' +
                             ' <option value="0">No</option>' +
                             '</select>' +
                             '</div>' +


                             '<div class="col-md-1">' +
                             '    <input class="form-control" id="" placeholder="" type="text" name="order[]" value="' +
                             no_ing + '" required="">' +
                             '   <div class="invalid-feedback"> </div>' +
                             '</div>' +

                             '</div>';

                        // add_total_cal('ing_protein_total', data.protein);

                        // add_total_cal('ing_fat_total', data.fats);

                        // add_total_cal('ing_calories_total', data.calories);

                        // add_total_cal('ing_carbs_total', data.carbs);

                        // add_total_cal('ing_fiber_total', data.fiber_in_gm);



                        $('#ingredient_list').append(html);

                    }
                });
            });

            $('#ingredient_name').on('select2:unselect', function(e) {
                var dparams = e.params.data;
                var ing_id = dparams.id;

                remove_total_cal('ing_calories_total', ing_id, 'calories');

                remove_total_cal('ing_protein_total', ing_id, 'protein');
                remove_total_cal('ing_carbs_total', ing_id, 'carbs');
                remove_total_cal('ing_fats_total', ing_id, 'fats');
                remove_total_cal('ing_fiber_total', ing_id, 'fiber');
                

                $('#r_ing_' + ing_id).remove();
            });


            var calculate_adjustment = function(ingrident_id, type) {
                
                var serving = $("#r_ing_"+ingrident_id).data('serving');
                var type_val = $("#r_ing_"+ingrident_id).data(type);
            

                var total_val = $("#r_ing_"+ingrident_id).find('select[name="mesur[]"]').find(':selected').data('weight');
                var total_qty = $("#r_ing_"+ingrident_id).find('input[name="qty[]"]').val();
                var last_type_val = $("#r_ing_"+ingrident_id).attr('data-'+ type +'-last');
                var c_calories = adjust_type_val = 0;

                if(total_qty>0){
                    
                    if(type_val>0){
                        c_calories= ((type_val/serving)*total_val)*total_qty;
                        adjust_type_val = (c_calories - last_type_val);
                        
                    } 
                    update_total_cal('ing_'+ type +'_total', adjust_type_val);
                    $("#r_ing_"+ingrident_id).attr('data-'+ type +'-last', c_calories);

                } else if(last_type_val >0){
                    c_calories = 0;
                    adjust_type_val = -(last_type_val);

                    update_total_cal('ing_'+ type +'_total', adjust_type_val);
                    $("#r_ing_"+ingrident_id).attr('data-'+ type +'-last', c_calories);
                }

             }


             $(document.body).on("change", ".calculation_update", function() {
                var ingrident_id = $(this).data('ing');

                calculate_adjustment(ingrident_id, 'calories');
                calculate_adjustment(ingrident_id, 'fats');
                calculate_adjustment(ingrident_id, 'carbs');
                calculate_adjustment(ingrident_id, 'protein');
             });


            $(document.body).on("change", "#Recipe_Name", function() {
                $("#Slug").val(slug($(this).val()));
            });


            var editor = CKEDITOR.replaceAll( 'editable', {
                uiColor: '#CCEAEE',
                
            } );

            // editor.on('change', function(evt) {
            //     $('#'+ $(this).attr('id') + '_charNum').text(t.trim().length + ' Chars');
            // });


            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({
                    tags: true
                });

            });


            "use strict";
            (function() {
                'use strict';
                1
                window.addEventListener('load', function() {
                    var forms = document.getElementsByClassName('needs-validation');
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {

                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    @endpush

</x-app-layout>
