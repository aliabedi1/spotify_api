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
                        <h3>{{ $songs }} songs left!!!</h3>
                        <h2>Your albums</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($albums as $album)
                    <div class="col-2">
                        <div id="product-{{ $album->id }}" class="single-product">
                            <img class="col-12" src="{{ $album->image_url }}" alt="{{ $album->name }}">
                            {{--                            <div class="part-1">--}}
                            {{--                            <ul>--}}
                            {{--                                <li><a href="#"><i class="fas fa-expand"></i></a></li>--}}
                            {{--                            </ul>--}}
                            {{--                            </div>--}}
                            <div class="part-2 ">
                                <h3 class="product-title text-center">{{ $album->name }}</h3>
                                {{--                            <h4 class="product-old-price">$79.99</h4>--}}
                                {{--                            <h4 class="product-price">$49.99</h4>--}}
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            // Left-click event
                            $('#product-1').click(function(event) {
                                event.preventDefault(); // Prevent default action
                                $.ajax({
                                    url: '/your-route', // Replace with your route
                                    method: 'POST', // Use POST method for left-click
                                    success: function(response) {
                                        if (response.status === 200) {
                                            $('#product-1').prop('disabled', true).blur(); // Disable and blur the element
                                        }
                                    }
                                });
                            });

                            // Right-click event
                            $('#product-1').contextmenu(function(event) {
                                event.preventDefault(); // Prevent default context menu
                                $.ajax({
                                    url: '/your-other-route', // Replace with your other route
                                    method: 'DELETE', // Use DELETE method for right-click
                                    success: function(response) {
                                        if (response.status === 200) {
                                            $('#product-1').remove(); // Remove the element from the list
                                        }
                                    }
                                });
                            });
                        });

                        document.getElementById('product-{{ $album->id }}').addEventListener('click', function () {
                            var element = this;

                            // Make an AJAX request
                            var xhr = new XMLHttpRequest();
                            xhr.open('DELETE', '{{ route('albums.delete',['album'=> $album->id]) }}', true);
                            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                            xhr.onload = function () {
                                if (xhr.status === 200) {
                                    element.style.filter = 'blur(3px)';
                                    element.style.pointerEvents = 'none';
                                }
                            };
                            xhr.send();
                        });
                    </script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const productElement = document.getElementById('product-{{ $album->id }}');

                            productElement.addEventListener('click', function (event) {
                                // Send AJAX request on left-click
                                if (event.button === 0) { // 0 represents left-click
                                    sendRequest('{{ route('albums.select',['album'=>$album->id]) }}');
                                }
                            });

                            productElement.addEventListener('contextmenu', function (event) {
                                event.preventDefault(); // Prevent default right-click behavior

                                // Send AJAX request on right-click
                                sendRequest('/route/for/right-click');
                            });

                            function sendRequest(route) {
                                fetch(route)
                                    .then(response => {
                                        if (response.ok) {
                                            handleSuccess();
                                        } else {
                                            // If the response status is not 200, handle error
                                            console.error('Request failed');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            }

                            function handleSuccess() {
                                // Remove the element from the list
                                productElement.remove();
                            }
                        });
                    </script>

                @endforeach

            </div>
            <div class="d-flex justify-content-center  mt-5">
                {{ $albums->links() }}

            </div>
        </div>
    </section>
@endsection

