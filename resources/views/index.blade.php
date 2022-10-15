@extends('layouts.app')

@section('content')
<!-- Hero -->
<div class="p-5 text-center bg-light">
    <h1 class="mb-3">Finder</h1>
    <h4 class="mb-3">A community to find what are you looking for...</h4>
    <a class="btn btn-primary" href="{{route('home')}}" role="button">Start Seeking</a>
    <div class="d-flex justify-content-center">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets3.lottiefiles.com/packages/lf20_rmjzba0l.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
    </div>

</div>
<!-- Hero -->
</header>
@endsection
