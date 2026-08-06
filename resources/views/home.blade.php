@extends('layouts.app')

@section('content')

<section class="bg-dark text-white text-center py-5">

    <div class="container">

        <h1 class="display-3 fw-bold">
            Fresh Coffee Everyday
        </h1>

        <p class="lead">
            Order online and skip the queue.
        </p>

        <a href="/menu" class="btn btn-warning btn-lg mt-3">
            View Menu
        </a>

    </div>

</section>

<section class="container py-5">

    <div class="row text-center">

        <div class="col-md-4">

            <h3>☕ Premium Coffee</h3>

            <p>
                Freshly brewed every day.
            </p>

        </div>

        <div class="col-md-4">

            <h3>⚡ Fast Pickup</h3>

            <p>
                Order ahead and skip the waiting line.
            </p>

        </div>

        <div class="col-md-4">

            <h3>❤️ Friendly Service</h3>

            <p>
                Made with care for every customer.
            </p>

        </div>

    </div>

</section>

@endsection