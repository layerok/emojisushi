<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Админка</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="app-menu__icon fa fa-shopping-bag"></i>
                <span class="app-menu__label">Продукты</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}"
               href="{{ route('admin.categories.index') }}">
                <i class="app-menu__icon fa fa-tags"></i>
                <span class="app-menu__label">Категории</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.ingredients.index' ? 'active' : '' }}"
               href="{{ route('admin.ingredients.index') }}">
                <i class="app-menu__icon fa fa-carrot"></i>
                <span class="app-menu__label">Ингридиенты</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.spots.index' ? 'active' : '' }}"
               href="{{ route('admin.ingredients.index') }}">
                <i class="app-menu__icon fas fa-store"></i>
                <span class="app-menu__label">Заведения</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.attributes.index' ? 'active' : '' }}" href="{{ route('admin.attributes.index') }}">
                <i class="app-menu__icon fa fa-th"></i>
                <span class="app-menu__label">Аттрибуты</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Настройки</span>
            </a>
        </li>
    </ul>
</aside>
