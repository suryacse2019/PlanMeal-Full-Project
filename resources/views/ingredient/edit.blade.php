@php
use App\Helpers\Helper;
$role = Helper::role_slug();
@endphp

<x-app-layout>
    <form action="{{ route('ingredient.update', $ingredient->id) }}" method="POST" class="needs-validation"
        id="form_data" enctype="multipart/form-data" novalidate="">
        @csrf
        {{ method_field('PUT') }}
        <div class="col-sm-12">
            @if (session('success'))
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header pb-0">
                    <h5>Edit ingredient</h5>
                </div>


                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                             <label class="form-label">Ingredient Name</label>
                            <input class="form-control" id="ingredient_name" type="text" name="ingredient_name"
                                placeholder="Ingredient Name" value="{{ $ingredient->name }}" required="">
                            <div class="invalid-feedback">Please Insert Ingredient Name</div>
                            @error('ingredient_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-4">
                            <label class="form-label">Name in Hindi</label>
                            <input class="form-control" id="ingredient_hindi" type="text" name="ingredient_hindi"
                                placeholder="Name in Hindi" value="{{ $ingredient->name_in_hindi }}" required="">
                            <div class="invalid-feedback">Please enter name in hindi</div>
                            @error('ingredient_hindi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">known as</label>
                            <div class="input-group">
                                <input class="form-control" id="known_as" name="known_as" type="text"
                                    value="{{ $ingredient->also_known }}" placeholder="known as"
                                    aria-describedby="inputGroupPrepend" required="">
                                <div class="invalid-feedback">Please enter also known as</div>
                            </div>
                            @error('known_as')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <ul class="nav nav-tabs nav-primary" id="top-tab" role="tablist">
                        @if ($role != 'content-editor')
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Basic</a></li>

                        <li class="nav-item"><a class="nav-link" id="top-sugar-tab" data-bs-toggle="tab" href="#top-sugar" role="tab" aria-controls="top-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Sugar & Fat</a></li>

                        <li class="nav-item"><a class="nav-link" id="top-vitamins-tab" data-bs-toggle="tab" href="#top-vitamins" role="tab" aria-controls="top-contact" aria-selected="false"><i class="icofont icofont-contacts"></i>Vitamins & Minerals</a></li>
                        @endif

                        @if ($role != 'nutrient')
                            @php
                                if ($role == 'content-editor') {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }
                            @endphp
                        <li class="nav-item"><a class="nav-link  {{ $active }}" id="top-description-tab" data-bs-toggle="tab" href="#top-description" role="tab" aria-controls="top-description" aria-selected="false"><i class="icofont icofont-contacts"></i>Description</a></li>
                        @endif
                    </ul>

                    <div class="tab-content" id="top-tabContent">
                        @if ($role != 'content-editor')

                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <div class="row g-3 pt-3">
                                <div class="col-md-3">
                                   <label class="form-label">Category</label> 
                                    @if (!empty($categorylist))
                                        <select class="form-select" id="category" name="Category" required="">
                                            <option value="">Category</option>
                                            @foreach ($categorylist as $category)
                                                @php
                                                    $selected = '';
                                                    if ($category->id == $ingredient->category) {
                                                        $selected = 'selected';
                                                    }
                                                @endphp
                                                <option value="{{ $category->id }}" {{ $selected }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a valid Category.</div>
                                    @error('Category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-3">
                                     <label class="form-label">Food Group</label>
                                    <select class="form-select" id="food_group" name="food_group" required="">
                                        <option value="">Food Group</option>
                                        @if (!empty($food_group))
                                            @foreach ($food_group as $foodgroup)
                                                @php
                                                    $selected = '';
                                                    if ($foodgroup->id == $ingredient->food_group) {
                                                        $selected = 'selected';
                                                    }
                                                @endphp
                                                <option value="{{ $foodgroup->id }}" {{ $selected }}>
                                                    {{ $foodgroup->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
    
                                    <div class="invalid-feedback">Please select a valid Food Group.</div>
                                    @error('food_group')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-2">
                                    <label class="form-label">slug</label>
                                    <input class="form-control" id="slug" type="text" name="slug" placeholder="slug"
                                        value="{{ $ingredient->url_rewrite }}" required="">
                                    <div class="invalid-feedback">Please insert the slug</div>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-2">
                                   <label class="form-label">Directly eatable</label>
                                    <select class="form-select" id="directly_eatable" name="directly_eatable"
                                        required="">
                                        <option value="">Directly eatable</option>
                                        <option value="1" {{ $ingredient->directly_edible == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ $ingredient->directly_edible == '0' ? 'selected' : '' }}>No
                                        </option>
    
                                    </select>
                                    <div class="invalid-feedback">Please select a option.</div>
                                    @error('directly_eatable')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-2">
                                    <label class="form-label">Database(India,US,etc)</label>
                                    @if (!empty($mealdatabaselist))
                                        <select class="form-select" id="database" name="database" required="">
                                            <option selected="" disabled="" value="">Database(India,US,etc)</option>
                                            @foreach ($mealdatabaselist as $mealdatabase)
                                                @php
                                                    $selected = '';
                                                    if ($mealdatabase->id == $ingredient->database_id) {
                                                        $selected = 'selected';
                                                    }
                                                @endphp
                                                <option {{ $selected }} value="{{ $mealdatabase->id }}">
                                                    {{ $mealdatabase->database_name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a option.</div>
                                    @error('database')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-6">
                                    <label class="form-label">How to store</label>
                                    <div class="form-group">
                                        <textarea class="form-control inline-editor" required="" placeholder="How to store" value="" id="how_to_store"
                                            name="how_to_store" rows="3">{{ $ingredient->storage }}</textarea>

                                        <div id="how_to_store_charNum"></div>
                                    </div>
    
                                    <div class="invalid-feedback">Please enter text</div>
                                    @error('how_to_store')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-6">
                                    <label class="form-label">Slug Life</label>
                                    <div class="form-group">
                                        <textarea class="form-control inline-editor" placeholder="Slug Life" name="shelf_life" value="" id="shelf_life"
                                            required="" rows="3">{{ $ingredient->shelf_life }}</textarea>

                                        <div id="shelf_life_charNum"></div>
                                    </div>
                                    @error('shelf_life')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-6">
                                     <label class="form-label">Select Measurement units</label>
                                    @if (!empty($measurementlist))
                                        @php
                                            
                                            if ($ingredient->parameter != '') {
                                                $mparameter = explode(',', $ingredient->parameter);
                                            }
                                        @endphp
                                        <select class="js-example-basic-multiple form-control"
                                            data-placeholder="Select Measurement units" name="measurement[]"
                                            id="measurement" multiple="multiple">
    
    
                                            @foreach ($measurementlist as $measurement)
                                                @php
                                                    $selected = '';
                                                    
                                                    if (!empty($mparameter) && in_array($measurement->id, $mparameter)) {
                                                        $selected = 'selected';
                                                    }
                                                    
                                                @endphp
                                                <option {{ $selected }} value="{{ $measurement->id }}">
                                                    {{ $measurement->unit }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a valid Food Group.</div>
                                    @error('measurement')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-6">
                                    <label class="form-label">Allergies if any</label>
                                    @if (!empty($allergyCategorylist))

                                        @php
                                                    
                                            if ($ingredient->allergies != '') {
                                                $allergiesList = explode(',', $ingredient->allergies);
                                            }
                                        @endphp
    
                                        <select class="js-example-basic-multiple form-control"
                                            data-placeholder="Allergies if any" name="allergies[]" id="allergies"
                                            multiple="multiple">
    
                                            @foreach ($allergyCategorylist as $allergyCategory)

                                                @php
                                                    $selected = '';
                                                    
                                                    if (!empty($allergiesList) && in_array($allergyCategory->id, $allergiesList)) {
                                                        $selected = 'selected';
                                                    }
                                                    
                                                @endphp

                                                <option {{ $selected }} value="{{ $allergyCategory->id }}">
                                                    {{ $allergyCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a valid Food Group.</div>
                                    @error('allergies')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-3">
                                     <label class="form-label">Ayurveda</label>
                                    @if (!empty($ayur_Veda))
                                        <select class="js-example-basic-multiple form-control" data-placeholder="Ayurveda"
                                            name="Ayurveda[]" id="Ayurveda" multiple="multiple">
    
    
                                            @foreach ($ayur_Veda as $ayurVeda)
                                                @php
                                                $selected = '';
                                                    foreach($mealingayurveda as $mealing){
                                                    if($ayurVeda->id == $mealing->ayurveda_id) {
                                                        $selected = 'selected';
                                                    }
                                                    }
                                                @endphp
                                                <option {{ $selected }} value="{{ $ayurVeda->id }}">
                                                    {{ $ayurVeda->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a valid Ayurveda.</div>
                                    @error('Ayurveda')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-3">
                                     <label class="form-label">Change Image</label>
                                    <img src="{{ asset('storage/' . $ingredient->image) }}" height="50px" width="100px">
                                    <input class="form-control" id="images" type="file" name="images"
                                        placeholder="Change Image" value="" required="">
    
                                    <div class="invalid-feedback">Please Choose File</div>
                                    @error('images')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
    
    
    
                                <div class="col-md-6">
                                    <label class="form-label">Avoid It</label>
                                    @if (!empty($mealdiseaseslist))
    
                                        <select class="js-example-basic-multiple form-control" data-placeholder="Avoid It"
                                            name="avoidit[]" id="avoid_it" multiple="multiple">
                                            @foreach ($mealdiseaseslist as $mealdiseases)
                                                @if (!empty($mealdiseases))
                                                    @php
                                                        $selected = '';
                                                        foreach($mmidisease as $mmidis){
                                                            if ($mealdiseases->id == $mmidis->disease_id) {
                                                                $selected = 'selected';
                                                            }
                                                        }
                                                    @endphp
                                                    <option {{ $selected }} value="{{ $mealdiseases->id }}">
                                                        {{ $mealdiseases->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="invalid-feedback">Please select a valid Food Group.</div>
                                </div>
                            </div>
    
                            <div class="card-header pb-0">
                                <h5>Measurement</h5>
                            </div>
                            @if (!empty($ingdmeasurelist))
                                @foreach ($ingdmeasurelist as $ingdmeasure)
                                    <div class="row g-3 pt-3" id="mesure_{{ $ingdmeasure->measurement_id }}">
                                        <div class="col-md-2">

                                            @foreach ($measurementlist as $measurement)
                                                @if ($measurement->id == $ingdmeasure->measurement_id)
                                                    <input class="form-control" id="" type="hidden" disable name=""
                                                        placeholder="" value="{{ $measurement->unit }}">{{$measurement->unit}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">value</label> 
                                            <input class="form-control" id="" type="text" name="" placeholder="value"
                                                value="{{ $ingdmeasure->measure }}">
    
                                        </div>
                                        <div class="col-md-2">
                                             <label class="form-label">Price</label> 
                                            <input class="form-control" id="" type="text" name="" placeholder="Price"
                                                value="{{ $ingdmeasure->price }}">
    
                                        </div>
    
                                    </div>
                                @endforeach
                            @endif
    
                            <div id="measurementlist"></div>
                        </div>

                        <div class="tab-pane fade" id="top-sugar" role="tabpanel" aria-labelledby="top-sugar-tab">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-2">
                                                    <label class="form-label">Gram</label> 
                                                    <input class="form-control" id="gram" type="number" name="gram"
                                                        placeholder="Gram" min="0" step=".01" value="{{ $ingredient->per_gram_serving }}">
    
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">calories</label> 
                                                    <input class="form-control" id="calories" type="number" name="calories"
                                                        placeholder="calories"  min="0" step=".01" value="{{ $ingredient->calories }}">
    
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Fat</label> 
                                                    <input class="form-control" id="fat" type="number" name="fat"
                                                        placeholder="Fat" min="0" step=".01"  value="{{ $ingredient->fats }}">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                      <label class="form-label">carbs</label> 
                                                    <input class="form-control" id="carbs" type="number" name="carbs"
                                                        placeholder="carbs" min="0" step=".01"  value="{{ $ingredient->carbs }}">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Protein</label>
                                                    <input class="form-control" id="protein" type="number" name="protein"
                                                        placeholder="Protein"  min="0" step=".01" value="{{ $ingredient->protein }}">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2"> 
                                                    <label class="form-label">Fiber</label>

                                                    <input class="form-control" value="{{ $ingredient->fiber_in_gm }}"
                                                        id="fiber" type="number"  name="fiber" placeholder="Fiber" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                            </div>
    
                                            <div class="row g-3 pt-3">
                                                <div class="col-md-2">
                                                    <label class="form-label">sodium</label>
                                                    <input class="form-control" id="sodium"
                                                        value="{{ $ingredient->sodium_in_mg }}" type="number" name="sodium"
                                                        placeholder="sodium" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">potassium</label>
                                                    <input class="form-control" id="potassium" type="number"
                                                        name="potassium" value="{{ $ingredient->potassium }}"
                                                        placeholder="potassium" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">cholestrol</label>
                                                    <input class="form-control" id="cholestrol" type="number"
                                                        name="cholestrol" placeholder="cholestrol" min="0" step=".01"
                                                        value="{{ $ingredient->cholesterol }}">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                      <label class="form-label">water%</label>
                                                    <input class="form-control" id="water" type="number" name="water"
                                                        placeholder="water%"  min="0" step=".01"value="{{ $ingredient->water }}">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">yeild</label>
                                                    <input class="form-control" id="yeild" type="number" name="yeild"
                                                        placeholder="yeild" min="0" step=".01" value="{{ $ingredient->yield }}">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">sugar</label>
                                                    <input class="form-control" id="sugar" type="number" name="sugar"
                                                        placeholder="sugar" min="0" step=".01" value="{{ $ingredient->sugar }}">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="card-header pb-0">
                                                <h5>Sugar</h5>
                                            </div>
    
                                            <div class="row g-3 pt-3">
                                                <div class="col-md-2">
                                                     <label class="form-label">sugar G</label>
                                                    <input class="form-control" id="sugar_G"
                                                        value="{{ isset($sugar->sugar) ? $sugar->sugar : '' }}"
                                                        type="number" name="sugar_G" placeholder="sugar G" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">sucrose (G)</label>
                                                    <input class="form-control"
                                                        value="{{ isset($sugar->sucrose) ? $sugar->sucrose : '' }}"
                                                        id="sucrose_G" type="number" name="sucrose_G"
                                                        placeholder="sucrose (G)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Gulcose (G)</label>
                                                    <input class="form-control" id="gulcose_g"
                                                        value="{{ isset($sugar->glucose) ? $sugar->glucose : '' }}"
                                                        type="number" name="gulcose_g" placeholder="Gulcose (G)" min="0" step=".01" >
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Fructose(G)</label>
                                                    <input class="form-control" id="fructose_g"
                                                        value="{{ isset($sugar->fructose) ? $sugar->fructose : '' }}"
                                                        type="text" name="fructose_g" placeholder="Fructose(G)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Lactose(G)</label>
                                                    <input class="form-control"
                                                        value="{{ isset($sugar->lactose) ? $sugar->lactose : '' }}"
                                                        id="lactose_g" type="number" name="lactose_g"
                                                        placeholder="Lactose(G)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Maltose(G)</label>
                                                    <input class="form-control"
                                                        value="{{ isset($sugar->maltose) ? $sugar->maltose : '' }}"
                                                        id="maltose_g" type="number" name="maltose_g"
                                                        placeholder="Maltose(G)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                            </div>
    
    
                                            <div class="row g-3 pt-3">
                                                <div class="col-md-2">
                                                     <label class="form-label">Galactose(G)</label>
                                                    <input class="form-control"
                                                        value="{{ isset($sugar->glactose) ? $sugar->glactose : '' }}"
                                                        id="galactose_g" type="number" name="galactose_g"
                                                        placeholder="Galactose(G)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
    
                                                <div class="card-header pb-0">
                                                    <h5>Fat</h5>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Saturated_FAT</label>
                                                    <input class="form-control" id="saturated_fat" type="number"
                                                        name="saturated_fat"
                                                        value="{{ isset($fats->saturated_fat) ? $fats->saturated_fat : '' }}"
                                                        placeholder="Saturated_FAT" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Monounsaturated</label>
                                                    <input class="form-control"
                                                        value="{{ isset($fats->mono_unsaturated_fat) ? $fats->mono_unsaturated_fat : '' }}"
                                                        id="monounsaturated" type="number" name="monounsaturated"
                                                        placeholder="Monounsaturated" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                       <label class="form-label">Polyunsaturated</label>
                                                    <input class="form-control"
                                                        value="{{ isset($fats->poly_unsaturated_fat) ? $fats->poly_unsaturated_fat : '' }}"
                                                        id="polyunsaturated" type="number" name="polyunsaturated"
                                                        placeholder="Polyunsaturated" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Trans FAT</label>
                                                    <input class="form-control"
                                                        value="{{ isset($fats->trans_fat) ? $fats->trans_fat : '' }}"
                                                        id="trans_fat" type="number" name="trans_fat" placeholder="Trans FAT" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Omega 3 Fatty</label>
                                                    <input class="form-control" id="omega_3_fatty"
                                                        value="{{ isset($fats->omega_3_fatty_acid) ? $fats->omega_3_fatty_acid : '' }}"
                                                        type="number" name="omega_3_fatty" placeholder="Omega 3 Fatty" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                            </div>
    
    
                                            <div class="row g-3 pt-3">
                                                <div class="col-md-2">
                                                    <label class="form-label">Omega 6 Fatty</label>
                                                    <input class="form-control"
                                                        value="{{ isset($fats->omega_6_fatty_acid) ? $fats->omega_6_fatty_acid : '' }}"
                                                        id="omega_6_fatty" type="number" name="omega_6_fatty"
                                                        placeholder="Omega 6 Fatty" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
    
    
    
    
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <div class="checkbox p-0">
                                                            <input class="form-check-input" id="invalidCheck"
                                                                type="checkbox" required="">
                                                        </div>
    
                                                    </div>
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="top-vitamins" role="tabpanel" aria-labelledby="top-vitamins-tab">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header pb-0">
                                            Vitamins & Minerals
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-2">
                                                    <label class="form-label">Betaine(MG)</label>
                                                    <input class="form-control" id="betaine"
                                                        value="{{ isset($vitamins->betaine) ? $vitamins->betaine : '' }}"
                                                        type="number" name="betaine" placeholder="Betaine(MG)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Calcium(MG)</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->betaine) ? $vitamins->betaine : '' }}"
                                                        id="calcium" type="number" name="calcium"
                                                        placeholder="Calcium(MG)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Copper(MG)</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->copper) ? $vitamins->copper : '' }}"
                                                        id="copper" type="number" name="copper"
                                                        placeholder="Copper(MG)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Folate(MG)</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->folate) ? $vitamins->folate : '' }}"
                                                        id="folate" type="number" name="folate"
                                                        placeholder="Folate(MG)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Lycopene(MG)</label>
                                                    <input class="form-control" id="lycopene"
                                                        value="{{ isset($vitamins->lycopene) ? $vitamins->lycopene : '' }}"
                                                        type="number" name="lycopene" placeholder="Lycopene(MG)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Manganese(MG)</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->manganese) ? $vitamins->manganese : '' }}"
                                                        id="manganese" type="number" name="manganese"
                                                        placeholder="Manganese(MG)" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                            </div>
    
                                            <div class="row g-3 pt-3">
                                                <div class="col-md-2">
                                                    <label class="form-label">Phosphorus</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->phosphorus) ? $vitamins->phosphorus : '' }}"
                                                        id="phosphorus" type="number" name="phosphorus"
                                                        placeholder="Phosphorus" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                      <label class="form-label">Reboflavin</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->riboflavin) ? $vitamins->riboflavin : '' }}"
                                                        id="reboflavin" type="number" name="reboflavin"
                                                        placeholder="Reboflavin" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Vitamin A</label>
                                                    <input class="form-control" id="vitamin_a" type="number"
                                                        name="vitamin_a"
                                                        value="{{ isset($vitamins->vitamin_a) ? $vitamins->vitamin_a : '' }}"
                                                        placeholder="Vitamin A" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                       <label class="form-label">Vitamin B6</label>
                                                    <input class="form-control" id="vitamin_b"
                                                        value="{{ isset($vitamins->vitamin_b6) ? $vitamins->vitamin_b6 : '' }}"
                                                        type="number" name="vitamin_b6" placeholder="Vitamin B6" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Vitamin C</label>
                                                    <input class="form-control" id="vitamin_c"
                                                        value="{{ isset($vitamins->vitamin_c) ? $vitamins->vitamin_c : '' }}"
                                                        type="number" name="vitamin_c" placeholder="Vitamin C" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Vitamin D2</label>
                                                    <input class="form-control" id="vitamin_d2"
                                                        value="{{ isset($vitamins->vitamin_d2) ? $vitamins->vitamin_d2 : '' }}"
                                                        type="number" name="vitamin_d2" placeholder="Vitamin D2" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                            </div>
    
                                            <div class="row g-3 pt-3">
                                                <div class="col-md-2">
                                                    <label class="form-label">Vitamin D3</label>
                                                    <input class="form-control" id="vitamin_d3"
                                                        value="{{ isset($vitamins->vitamin_d3) ? $vitamins->vitamin_d3 : '' }}"
                                                        type="number" name="vitamin_d3" placeholder="Vitamin D3" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Vitamin E</label>
                                                    <input class="form-control" id="vitamin_e"
                                                        value="{{ isset($vitamins->vitamin_e) ? $vitamins->vitamin_e : '' }}"
                                                        type="number" name="vitamin_e" placeholder="Vitamin E" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Vitamin B12</label>
                                                    <input class="form-control" id="vitamin_b12"
                                                        value="{{ isset($vitamins->vitamin_b12) ? $vitamins->vitamin_b12 : '' }}"
                                                        type="number" name="vitamin_b12" placeholder="Vitamin B12" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Vitamin K</label>
                                                    <input class="form-control" id="vitamin_k"
                                                        value="{{ isset($vitamins->vitamin_k) ? $vitamins->vitamin_k : '' }}"
                                                        type="number" name="vitamin_k" placeholder="Vitamin K" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Choline</label>
                                                    <input class="form-control" id="choline"
                                                        value="{{ isset($vitamins->choline) ? $vitamins->choline : '' }}"
                                                        type="number" name="choline" placeholder="Choline" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Fluride</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->fluoride) ? $vitamins->fluoride : '' }}"
                                                        id="fluride" type="number" name="fluride"
                                                        placeholder="Fluride" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                            </div>
    
    
                                            <div class="row g-3 pt-3">
                                                <div class="col-md-2">
                                                     <label class="form-label">Iron</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->iron) ? $vitamins->iron : '' }}"
                                                        id="iron" type="number" name="iron" placeholder="Iron" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Magnesium</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->magnesium) ? $vitamins->magnesium : '' }}"
                                                        id="magnesium" type="number" name="magnesium"
                                                        placeholder="Magnesium" min="0" step=".01">
                                                    <div class="valid-feedback"></div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Niacin</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->niacin) ? $vitamins->niacin : '' }}"
                                                        id="niacin" type="number" name="niacin" placeholder="Niacin" min="0" step=".01">
    
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Retinol</label>
                                                    <input class="form-control" id="retinol"
                                                        value="{{ isset($vitamins->retinol) ? $vitamins->retinol : '' }}"
                                                        type="number" name="retinol" placeholder="Retinol" min="0" step=".01">
    
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Thiamin</label>
                                                    <input class="form-control" id="thiamin"
                                                        value="{{ isset($vitamins->thiamine) ? $vitamins->thiamine : '' }}"
                                                        type="number" name="thiamine" placeholder="Thiamin" min="0" step=".01">
    
                                                </div>
                                                <div class="col-md-2">
                                                     <label class="form-label">Selenium</label>
                                                    <input class="form-control" id="selenium"
                                                        value="{{ isset($vitamins->selenium) ? $vitamins->selenium : '' }}"
                                                        type="number" name="selenium" placeholder="Selenium" min="0" step=".01">
    
                                                </div>
                                            </div>
    
    
                                            <div class="row g-3 pt-3">
                                                <div class="col-md-2">
                                                     <label class="form-label">Zinc</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->zinc) ? $vitamins->zinc : '' }}"
                                                        id="zinc" type="number" name="zinc" placeholder="Zinc" min="0" step=".01">
    
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Vitamin D</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->vitamin_d) ? $vitamins->vitamin_d : '' }}"
                                                        id="vitamin_d" type="number" name="vitamin_d"
                                                        placeholder="Vitamin D" min="0" step=".01">
    
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Caffeine</label>
                                                    <input class="form-control"
                                                        value="{{ isset($vitamins->caffeine) ? $vitamins->caffeine : '' }}"
                                                        id="caffeine" type="number" name="caffeine"
                                                        placeholder="Caffeine" min="0" step=".01">
    
                                                </div>
                                            </div>
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
                        <div class="tab-pane fade {{ $active}}" id="top-description" role="tabpanel" aria-labelledby="top-description-tab">

                            <div class="card-body">
                                <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                  <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-longDesc" role="tab" aria-controls="top-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Long Description</a></li>
                                  <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-shortDesc" role="tab" aria-controls="top-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Short Description</a></li>
                
                                </ul>

                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-longDesc" role="tabpanel" aria-labelledby="top-home-tab">
                                        <textarea id="long_desc" class="editable" name="long_desc">{{ $ingredient->description }}</textarea>
                                        <div id="long_desc_charNum"></div>
                                    </div>
                                    <div class="tab-pane fade" id="top-shortDesc" role="tabpanel" aria-labelledby="profile-top-tab">
                                        <textarea id="short_desc" class="editable" name="short_desc">{{ $ingredient->short_desc }}</textarea>
                                        <div id="short_desc_charNum"></div>
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
        <!-- Plugins JS start-->
        <script src="{{ asset('assets/js/editor/simple-mde/simplemde.min.js') }}"></script> --}}

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/summernote.css') }}">
        <script src="{{ asset('assets/js/jquery.ui.min.js') }}"></script>
        <script src="{{ asset('assets/js/editor/summernote/summernote.js') }}"></script>
        <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>

        <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/editor/ckeditor/styles.js') }}"></script>
        
        <!-- Plugins JS Ends-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <!-- Plugin used-->

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

            $(document.body).on("change", "#ingredient_name", function() {
                $("#slug").val(slug($(this).val()));
            });

            var editor = CKEDITOR.replaceAll( 'editable', {
                uiColor: '#CCEAEE',
            });

            $('.inline-editor').keyup(function(e) {
                currentLength = $(this).val().length;
                $('#'+ $(this).attr('id') + '_charNum').text(currentLength + ' Chars');
            });


            // (function($) {
            //     var simplemde = new SimpleMDE({
            //         element: $("#short_desc")[0]
            //     });
            //     var simplemde1 = new SimpleMDE({
            //         element: $("#long_desc")[0]
            //     });
            //     //var simplemde2 = new SimpleMDE({ element: $("#instruction")[0] });
            // })(jQuery);


            $('#measurement').on('select2:select', function(e) {
                var dparams = e.params.data;
                // var ing_id = dparams.id;

                var html = '<div class="row g-3 pt-3" id="mesure_' + dparams.id + '">' +
                    '<div class="col-md-2">' +
                    '  <input class="form-control" id="mesure_unit" type="hidden" name="mesure_unit[]" disable value="' +
                    dparams.id + '" >' + dparams.text +
                    '<div class="invalid-feedback">mesurment name required</div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '  <input class="form-control" id="mesure_value" type="number" name="mesure_value[]" placeholder="value" >' +
                    '  <div class="valid-feedback"></div>' +
                    '</div>' +

                    '<div class="col-md-2">' +
                    '  <input class="form-control" id="mesure_value" type="number" name="price[]" placeholder="price" >' +
                    '  <div class="valid-feedback"></div>' +
                    '</div>' +
                    '</div>';

                $('#measurementlist').append(html);


            });


            $('#measurement').on('select2:unselect', function(e) {
                var dparams = e.params.data;
                $('#mesure_' + dparams.id).remove();
            });


            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });



            "use strict";
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    var forms = document.getElementsByClassName('needs-validation');
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            consloe.log(form.checkValidity());
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
