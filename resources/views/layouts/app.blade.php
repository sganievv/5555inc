<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '5555inc') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.datetimepicker.min.css') }}" rel="stylesheet">

    @yield('styles')
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div id="app">

        @include('components.navbar')

        <div style="margin-top: 100px"></div>

        <main class="mt-5 mb-5" style="padding-left: 50px; padding-right: 50px;">
            <div class="row">
                <div class="col-md-12">
                    {{--    Error and success alerts    --}}
                    <div class="row" id="response">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                @include('components.alerts.errors', ['message' => $error])
                            @endforeach
                        @elseif(session('error'))
                            @include('components.alerts.errors', ['message' => session('error')])
                        @endif

                        @if(session('success'))
                            @include('components.alerts.success', ['message' => session('success')])
                        @endif
                    </div>
                    {{--    Error and success alerts    --}}

                    <div class="row">
                        <div class="lds-ring" style="display: none;">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    @yield('menu')
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>

                <div class="col-md-12">
                    @yield('full-content')
                </div>
            </div>
        </main>

        <div class="panel panel-default">
            <div class="panel-body">
                © {{ date('Y') }}  <br/>
                {{ config('app.name', '5555inc') }}
            </div>
            <div class="panel-footer">
                Developed by ALPHAZET
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.1.js') }}" type="application/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="application/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="application/javascript"></script>
    <script src="{{ asset('js/jquery-ui-1.13.2.custom.js') }}"></script>
    <script src="{{ asset('js/jquery.datetimepicker.full.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('scripts')
    @livewireScripts
</body>
</html>
