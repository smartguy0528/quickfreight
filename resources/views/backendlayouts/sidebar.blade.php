<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @if (Auth::user() && Auth::user()->role == 0)
                <div class="sb-sidenav-menu-heading">Administrator</div>
                <a class="nav-link" href="{{route('admin.users')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Managers
                </a>
                @endif

                @if (Auth::user() && Auth::user()->role == 1)
                <div class="sb-sidenav-menu-heading">Manager</div>
                <a class="nav-link @if(Route::is('manager.dashboard')) {{'active'}} @endif" href="{{route('manager.dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Dashboard
                </a>
                <a class="nav-link @if(str_contains(Route::currentRouteName(), 'manager.quotes')) active @endif" href="{{route('manager.quotes.requested')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                    Task Quotes
                </a>
                <a class="nav-link @if(Route::is('manager.all.quotes')) {{'active'}} @endif" href="{{route('manager.all.quotes')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    All Quotes
                </a>
                <a class="nav-link @if(Route::is('manager.carriers.all')) {{'active'}} @endif" href="{{route('manager.carriers.all')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                    Carriers
                </a>
                <a class="nav-link @if(Route::is('manager.quote.invoices')) {{'active'}} @endif" href="{{route('manager.quote.invoices')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                    Request Order History
                </a>
                @endif

                @if (Auth::user() && Auth::user()->role == 2)
                    <div class="sb-sidenav-menu-heading">Customer</div>
                    <a class="nav-link @if(Route::is('customer.welcome')) {{'active'}} @endif" href="{{route('customer.welcome')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                        Home
                    </a>
                    @foreach($myQuotes as $myQuote)
                        <a class="nav-link @if(Route::is('customer.quotecheck') && Route::current()->parameters['id'] == $myQuote->id) {{'active'}} @endif" href="{{route('customer.quotecheck', $myQuote->id)}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                            Check Quote ({{$myQuote->id_alias}})
                        </a>
                        @if ($myQuote->status >= 8)
                            <a class="nav-link @if(Route::is('customer.quote.status') && Route::current()->parameters['id'] == $myQuote->id) {{'active'}} @endif" href="{{route('customer.quote.status', $myQuote->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>
                                Load Status ({{$myQuote->id_alias}})
                            </a>
                        @endif
                    @endforeach
                @endif

                @if (Auth::guard('carrierguard')->user())
                <div class="sb-sidenav-menu-heading">Carrier</div>
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="true" aria-controls="collapseLayouts2">
                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                    Task Quotes
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapsed show" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link @if(Route::is('carrier.quotes')) {{'active'}} @endif" href="{{route('carrier.quotes')}}">Requested Quotes</a>
                        <a class="nav-link @if(Route::is('carrier.quotes.published')) {{'active'}} @endif" href="{{route('carrier.quotes.published')}}">Published Quotes</a>
                        <a class="nav-link @if(Route::is('carrier.quotes.completed')) {{'active'}} @endif" href="{{route('carrier.quotes.completed')}}">Completed Quotes</a>
                    </nav>
                </div>
                @endif

                @if (Auth::user() && Auth::user()->role == 4)
                <div class="sb-sidenav-menu-heading">Driver</div>
                <a class="nav-link" href="{{route('driver.status')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>
                    Load Status
                </a>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <span class="small">Logged in as a</span>
            <span>
                @if(Auth::user())
                    @switch(Auth::user()->role)
                        @case(0)
                            Administrator
                            @break
                        @case(1)
                            Manager
                            @break
                        @case(2)
                            Customer
                            @break
                        @case(3)
                            Carrier
                            @break
                        @case(4)
                            Driver
                            @break
                        @default
                            @break
                    @endswitch
                @endif
            </span>
        </div>
    </nav>
</div>
