<header class="top-bar fixed-header">
    @if(auth()->check())
        <div class="login-bar">
            <div class="row">
                <ul class="dropdown menu user-menu" data-dropdown-menu>
                    <li>
                        <a title="user image" class="user-logo"></a>
                        <ul class="menu logout">
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    @endif
    <div class="main-menu-wrap">
        <div class="row">
        <div class="top-bar-left">
            <a href="{{ route('/') }}" class="project-logo">
                <div class="first-section">@lang('general.moldova_contract')</div>
                <div class="second-section">@lang('general.data_visualization')</div>
            </a>
        </div>

        <div class="top-bar-right" id="main-menu">
            <div class="menu-wrap">
                <ul class="menu" class=" ">
                    <li><a href="{{ route('/') }}"
                           class="{{ (\Request::segment(1) === null)?'active':'' }}">@lang('general.home')</a></li>
                    <li><a href="/about"
                           class="{{ (Request::segment(1) === 'about')?'active':'' }}">@lang('general.about')</a></li>
                    <li><a href="{{ route('tenders.index') }}"
                           class="{{ (Request::segment(1) === 'tenders')?'active':'' }}">@lang('general.tenders')</a>
                    </li>
                    <li><a href="{{ route('contracts') }}"
                           class="{{ (Request::segment(1) === 'contracts')?'active':'' }}">@lang('general.contracts')</a>
                    </li>
                    <li><a href="{{ route('procuring-agency.index') }}"
                           class="{{ (Request::segment(1) === 'procuring-agency')?'active':'' }}">@lang('general.agencies')</a>
                    </li>
                    <li>
                        <a href="{{ route('goods.index') }}"
                           class="{{ (Request::segment(1) === 'goods')?'active':'' }}">
                            @lang('general.goods')
                        </a>
                    </li>
                    <li>
                        <a href="/contact"
                           class="{{ (Request::segment(1) === 'contact')?'active':'' }}">@lang('general.contact')</a>
                    </li>
                    @if(auth()->check())
                        @if(Auth::user()->admin)
                            <li>
                                <a href="{{ url('/admin') }}" class="{{ (Request::segment(1) === 'admin')?'active':'' }}">Feedback</a>
                            </li>
                        @endif
                    @endif
                </ul>
                <form action="{{ route('search') }}" method="get" class="search">
                    <input name="q" type="search" class="search-box"
                           placeholder="Type a contractor, procuring agency or goods & services ..." title="Type a contractor, procuring agency or goods & services ...">
                <span class="search-button">
                    <span class="search-icon"></span>
                </span>
                </form>
            </div>

            <div class="language-selector">
                <select id="Language-select">
                    <option value="en" {{ (getLocalLang() === 'en')?'selected':'' }} class="english">English</option>
                    <option value="md" {{ (getLocalLang() === 'md')?'selected':'' }} class="moldova">Romanian</option>
                </select>
            </div>
        </div>

        <div class="title-bar burger-menu-button">
            <button class="burger-menu" type="button">
                <div class="burger"></div>
            </button>
        </div>

    </div>
    </div>
    @include('partials.notifications')
</header>

