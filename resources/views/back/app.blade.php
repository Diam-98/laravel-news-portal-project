<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>@yield('title')</title>

        <link
            rel="shortcut icon"
            type="image/x-icon"
            href="{{ asset('back/assets/img/favicon.png') }}"
        />
        <link rel="stylesheet" href="{{ asset('back/assets/css/bootstrap.min.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('back/assets/plugins/fontawesome/css/fontawesome.min.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('back/assets/plugins/fontawesome/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('back/assets/css/feathericon.min.css') }}" />
        <link rel="stylehseet" href="{{ asset('back/https://cdn.oesmith.co.uk/morris-0.5.1.css') }}" />
        <link rel="stylesheet" href="{{ asset('back/assets/plugins/morris/morris.css') }}" />
        <link rel="stylesheet" href="{{ asset('back/assets/css/style.css') }}" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
              rel="stylesheet" />
        <style>
            .bootstrap-tagsinput .tag {
                margin-right: 2px;
                color: #ffffff;
                background: #2196f3;
                padding: 3px 7px;
                border-radius: 3px;
            }
            .bootstrap-tagsinput {
                width: 100%;
            }
        </style>

    </head>
    <body>

    {# Main wrapper #}
    <div class="main-wrapper">
        @include('back.partials.header')
        @include('back.partials.sidebar')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    @yield('dashboard-header')
                </div>

                @yield('dashboard-content')

            </div>
        </div>

    </div>

    <script src="{{ asset('back/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('back/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('back/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('back/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('back/assets/js/chart.morris.js') }}"></script>
    <script src="{{ asset('back/assets/js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js" integrity="sha512-ZESy0bnJYbtgTNGlAD+C2hIZCt4jKGF41T5jZnIXy4oP8CQqcrBGWyxNP16z70z/5Xy6TS/nUZ026WmvOcjNIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

    @if(session()->get('error'))
        <script>
            iziToast.error({
                title: 'Erreur',
                position: 'topRight',
                message: '{{ session()->get('error') }}'
            });
        </script>
    @endif

    @if(session()->get('success'))
        <script>
            iziToast.success({
                title: 'Succes',
                position: 'topRight',
                message: '{{ session()->get('success') }}'
            });
        </script>
    @endif

    </body>
</html>
