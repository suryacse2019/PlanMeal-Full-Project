@php
use App\Helpers\Helper;
$role = Helper::role_slug();
@endphp
<nav>
    <div class="main-navbar">
        <div id="mainnav">
            <ul class="nav-menu custom-scrollbar">
                <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li><a class="nav-link arrow-none " href="{{ route('dashboard') }}" ><i data-feather="home"></i><span>Dashboard</span></a></li>

            @if($role != 'viewer' && $role != 'user' && $role != 'content-editor' && $role != 'nutrient')
                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)" ><i data-feather="anchor"></i><span>User</span></a>
                    
                    <ul class="nav-submenu menu-content">
                        <li><a class="submenu-title" href="{{ route('user.create') }}" >Add User<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            
                        </li>
                        <li><a class="submenu-title" href="{{ route('user.index') }}"  >List User<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            
                        </li>
                       
                    </ul>
                </li>
                @endif
                 

                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)" ><i data-feather="anchor"></i><span>Ingredient</span></a>
                    <ul class="nav-submenu menu-content">
                        @if($role!='viewer' && $role != 'content-editor' && $role != 'nutrient')
                        <li><a class="submenu-title" href="{{ route('ingredient.create') }}" >Add Ingredient<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            
                        </li>
                        @endif

                        <li><a class="submenu-title" href="{{ route('ingredient.index') }}">List Ingredient<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            
                        </li>
                        
                    </ul>
                </li>
                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)" ><i data-feather="anchor"></i><span>Recipe</span></a>
                    <ul class="nav-submenu menu-content">
                        <li>     <a class="submenu-title" href="{{ route('recipe.index') }}">List Recipe<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            </li>

                          @if($role!='viewer' && $role != 'nutrient' && $role != 'content-editor')
                         <li><a class="submenu-title" href="{{ route('recipe.create') }}" >Add Recipe<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            
                        </li>
                        @endif
                    </ul>
                 </li>

                </li>
            </ul>
        </div>
    </div>
</nav>
