<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <style>

        body{
            font-size: 20px;
        }

        table{
            font-size: 30px;
            width: 100%;

        }
        table,th,td {
            border: 2px solid black;
            border-collapse: collapse;
            padding: 20px;
            text-align:center;
        }

        .etat{
            background-color: lightblue;
        }
        .error{
            background-color: lightpink;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        #t01{
            width: 100%;
            background-color: #f1f1c1;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
@section('menu')
    <table>
        @guest()
            <th><a href="{{route('login')}}">Login</a></th>
            <th><a href="{{route('register')}}">Enregistrement</a></th>

        @endguest
    </table>

    <table>
        @auth
            <tr>
                <th><a href="{{route('logout')}}">Deconnexion</a></th>
                <th><a href="{{route('admin.home')}}">Partie admin</a> </th>
                <th><a href="{{route('home.pizzaiolo')}}"> Pizzaiolo</a></th>
                <th><a href="{{route('home.user')}}">homer user</a></th>
            </tr>
        @endauth
    </table>


@show

@section('etat')
    @if(session()->has('etat'))
        <p class="etat">{{session()->get('etat')}}</p>
    @endif
@show

@section('errors')
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@show

@yield('contents')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>
