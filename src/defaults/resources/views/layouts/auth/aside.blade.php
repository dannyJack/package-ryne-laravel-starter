<aside class="main-sidebar elevation-4 bg-white">
    <a href="{{-- route('dashboard.index') --}}" class="brand-link">
        <img src="{{ _vers('images/common/logo.svg') }}" alt="{{ config('app.name') }}" class="brand-image" />
        <span class="brand-text font-weight-bold text-blue">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{-- route('dashboard.index') --}}" class="nav-link{{-- _isRoute('dashboard.index') ? ' active' : '' --}}">
                        <i class="nav-icon fas fa-tachometer-alt half"></i>
                        <p>{{ __('words.Dashboard') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>