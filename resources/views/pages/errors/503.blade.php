<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found !</title>
    {{-- tailwind css --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- custom insaf css --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>

<body>

    {{-- container --}}
    <div class="block lg:flex wrapper">
        {{-- form login --}}
        <div class="flex w-full lg:w-2/4 h-screen items-center justify-center py-3 lg:py-10 px-6 lg:px-32 forms">
            <div class="w-full h-full rounded card-auth">

                {{-- Header --}}
                <div class="w-full h-full py-2 lg:py-4 block flex flex-col justify-center items-center header">
                    <img class="w-16 lg:w-24" src="http://127.0.0.1:8000/assets/images/insaf-logo-dark.png">

                    <img src="{{url('assets/images/503.png')}}" class="" alt="">
                    <h1 class="text-4xl lg:text-6xl">Bad Gateway</h1>
                    <p class="text-lg text-center font-medium mb-10 lg:mb-28 mt-5">The server is currently unavailable </p>
                    <a href="{{ route('home.insaf') }}"
                    class=" flex items-center justify-center hover:shadow-xl w-full lg:w-64 outline-none ring-1 focus:outline-none bg-gray-900 ring-gray-900 py-5 lg:py6 lg:px-10 text-black rounded-lg font-medium text-base lg:text-lg hover:bg-gray-800 text-white my-2 lg:my-0">Back to Home</a>
                </div>

            </div>
        </div>

        {{-- image side hero --}}
        <div class="hidden lg:flex items-start justify-end w-full lg:w-2/4 p-10 h-screen hero-login"
            style="background-image: url({{ url('assets/images/hero-login.png') }})">
            <img src="{{ url('assets/images/dispriok.png') }}" alt="">
        </div>
    </div>

</body>

</html>
