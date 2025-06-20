<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #2A7B9B, #57C785, #EDDD53);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">📝 FormBuilder</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/about') }}">About</a></li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item "><a class="nav-link btn  btn-light text-dark me-2" href="{{ url('/login') }} ">Login</a></li>
                <li class="nav-item"><a class="nav-link btn btn-light text-dark" href="{{ url('/register') }}">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
