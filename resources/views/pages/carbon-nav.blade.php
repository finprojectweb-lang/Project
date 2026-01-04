
<link rel="stylesheet" href="{{ asset('css/calcnav.css') }}">

<div class="calc-nav-wrapper">
    <div class="icon-nav d-flex gap-2">

        <a href="{{ route('calc.housing') }}"
           class="icon-btn {{ Route::is('calc.housing') ? 'active' : '' }}">
            <i class="bi bi-house-fill"></i>
        </a>

        <a href="{{ route('calc.transport') }}"
           class="icon-btn {{ Route::is('calc.transport') ? 'active' : '' }}">
            <i class="bi bi-bus-front-fill"></i>
        </a>

        <a href="{{ route('calc.food') }}"
           class="icon-btn {{ Route::is('calc.food') ? 'active' : '' }}">
            <i class="bi bi-egg-fried"></i>
        </a>

        <a href="{{ route('calc.expenditure') }}"
           class="icon-btn {{ Route::is('calc.expenditure') ? 'active' : '' }}">
            <i class="bi bi-coin"></i>
        </a>

    </div>
</div>
