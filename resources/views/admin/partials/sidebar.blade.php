<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Админка</span>
            </a>
        </li>
        <li class="treeview {{ Route::currentRouteName() == 'admin.products.index' ||
                               Route::currentRouteName() == 'admin.categories.index' ||
                               Route::currentRouteName() == 'admin.orders.index'  ||
                               Route::currentRouteName() == 'admin.delivery.index' ||
                               Route::currentRouteName() == 'admin.payment.index' ||
                               Route::currentRouteName() == 'admin.attributes.index' ||
                               Route::currentRouteName() == 'admin.payment-status.index' ||
                               Route::currentRouteName() == 'admin.orders.index' ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fas fa-store"></i>
                <span class="app-menu__label">Магазин</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu ">

                <li>
                    <a class="treeview-item {{ Route::currentRouteName() == 'admin.products.index' ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                        <i class="app-menu__icon fa fa-shopping-bag"></i>
                        <span class="app-menu__label">Продукты</span>
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}"
                       href="{{ route('admin.categories.index') }}">
                        <i class="app-menu__icon fa fa-tags"></i>
                        <span class="app-menu__label">Категории</span>
                    </a>
                </li>
                <li>
                    <a class="treeview-item "
                       href="#">
                        <i class="app-menu__icon fas fa-code-branch"></i>
                        <span class="app-menu__label">Заведения</span>
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ Route::currentRouteName() == 'admin.orders.index' ? 'active' : '' }}"
                       href="{{ route('admin.orders.index') }}">
                        <i class="app-menu__icon fas fa-shopping-cart"></i>
                        <span class="app-menu__label"> Заказы</span>
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ Route::currentRouteName() == 'admin.delivery.index' ? 'active' : '' }}"
                       href="{{ route('admin.delivery.index') }}">
                        <i class="app-menu__icon fas fa-truck"> </i>
                        <span class="app-menu__label"> Способы доставки</span>
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ Route::currentRouteName() == 'admin.payment.index' ? 'active' : '' }}"
                       href="{{ route('admin.payment.index') }}">
                        <i class="app-menu__icon fas fa-wallet"></i>
                        <span class="app-menu__label"> Способы оплаты</span>
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ Route::currentRouteName() == 'admin.payment-status.index' ? 'active' : '' }}"
                       href="{{ route('admin.payment-status.index') }}">
                        <i class="app-menu__icon fas fa-money-bill-alt"></i>
                        <span class="app-menu__label"> Статусы оплаты</span>
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ Route::currentRouteName() == 'admin.attributes.index' ? 'active' : '' }}" href="{{ route('admin.attributes.index') }}">
                        <i class="app-menu__icon fa fa-th"></i>
                        <span class="app-menu__label">Аттрибуты</span>
                    </a>
                </li>
            </ul>
        </li>


        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Настройки</span>
            </a>
        </li>
    </ul>
</aside>
