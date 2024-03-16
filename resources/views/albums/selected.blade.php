@extends('layouts.base',[
    'title' => $title,
])

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection

@section('body')
    <section class="section-products">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                    <div class="header">
                        <h3>{{ $albums_count }} albums selected!!!</h3>
                        <h2>Your selected albums</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($albums as $album)
                    <div class="col-lg-6 col-md-12 mb-1 d-flex flex-column justify-content-between"
                         id="album-section-{{ $album->id }}">
                        <div id="product-{{ $album->id }}" class="single-product">
                            <img class="col-12 rounded" src="{{ $album->image_url }}" alt="{{ $album->name }}">
                            <div class="part-2 font-italic">
                                <h3 class="product-title mt-2 text-center">{{ $album->name }}</h3>
                            </div>
                            <div class="mt-auto justify-content-center d-flex">
                                <button type="button"
                                        onclick="deleteElement({{ $album->id }},'{{ route('albums.delete',['album'=>$album->id]) }}')"
                                        class="w-100 mx-1 btn btn-danger btn-sm">Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>
@endsection

@section('script')
    <script>
        function deleteElement(albumId, url) {
            let elementId = '#product-' + albumId;
            let parentId = '#album-section-' + albumId;
            // Left-click event
            $(elementId).click(function (event) {
                event.preventDefault(); // Prevent default action
                $.ajax({
                    url: url, // Replace with your route
                    method: 'DELETE', // Use POST method for left-click
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        if (response === 'success') {
                            $(parentId).remove();
                        }
                    }
                });
            });

        }


    </script>
@endsection

