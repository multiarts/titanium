<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
    @include('adminlte::partials.common.brand-logo-xl')
    @else
    @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="mt-2">
            @if(config('adminlte.sidebar_user'))
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if(Auth::user()->image)
                    <img src="{{ asset("storage/".Auth::user()->image) }}" class="img-circle elevation-2"
                        alt="{{ Auth::user()->name }}">
                    @else
                    <img src="{{ asset("images/image_default.png") }}" alt="{{ $user->name }}"
                        class="profile-user-img img-fluid img-circle">
                    @endif
                </div>
                <div class="info">
                    <a href="{{ route('dashboard.perfil.index') }}" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
            @endif
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') !=300)
                data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>