<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Ingredents;
use App\Models\Recipe;
use Carbon\Carbon;

class PageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(){
        $ing = Ingredents::all()->count();
        $recipe=Recipe::all()->count();

        $date = Carbon::now()->subDays(30);
        $ing_update_30 = Ingredents::where('updated_at', '>=', $date)->count();
        $recipe_update_30 = Recipe::where('updated_at', '>=', $date)->count();

        return view('dashboard',compact('ing','recipe', 'ing_update_30', 'recipe_update_30'));
    }
}
