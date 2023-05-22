<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')-My Web</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/clients/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}">
    @yield('css')
</head>

<body>

    @include('clients.blocks.header')
    <main class="py-5">
        <div class="container">
            <div class="row">

                <div class="col-4">
                    <aside>
                        @section('sidebar')
                            @include('clients.blocks.sidebar')
                        @show
                    </aside>
                </div>

                <div class="col-8">
                    <div class="content">
                        @yield('content')
                        {{-- @include('clients.contents.slide')
                        @include('clients.contents.about') --}}
                    </div>
                </div>

            </div>
        </div>
    </main>
    <footer>
        @include('clients.blocks.footer')
    </footer>
    <script src="{{ asset('assets/clients/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/custom.js') }}"></script>
    @yield('js')
    @stack('script')
</body>

</html>
