<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>{{ config('app.name', 'Formulario Citas') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Scripts -->
</head>
<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="container">
            <div class='row'>
                <div class='col-3'></div>
                <div class='col-6'>
                    <p class="display-4 text-center">Formulario de Citas</p>
                    <form class='form' action="{{ action('App\Http\Controllers\FormController@request') }}" method="POST" >  
                        @csrf {{ csrf_field() }}
                        <div class="form-group mt-2">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nif</label>
                            <input type="text" class="form-control" id="nif" name="nif" placeholder="Nif" required>
                        </div>
                        
                        <div class="form-group mt-2">
                            <label for="nombre">Telefono</label>
                            <input type="phone" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
                        </div>
                        
                        <div class="form-group mt-2">
                            <label for="correo">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" required>
                            <small id="emailHelp" class="form-text text-muted d-none"></small>
                        </div>
                        <div class="form-group mt-2">
                            <label for="tipo_cita">Tipo Cita</label>
                            <select class="form-control" id="tipo_cita" name="tipo_cita" required>
                            
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Pedir Cita</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
          
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>     
    <script src="/js/functions.js"></script> 
</body>
</html>
