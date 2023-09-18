@extends('layout.erp.app')

@section('page')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <!-- Payment form -->
        <form action="{{ route('stripe.submit') }}" method="post">
            @csrf
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ $publishableKey }}"
                data-amount="1000" data-name="Shamim Apon" data-description="Stripe Payment"
                data-image="https://www.logostack.com/wp-content/uploads/designers/eclipse42/small-panda-01-600x420.jpg"
                data-currency="USD" data-email="shamimapon@gmail.com"></script>
        </form>

    </body>


    </html>
@endsection
