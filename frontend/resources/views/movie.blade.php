@extends('layout.movielayout')

@section('content')
    <style>
        .dot {
            height: 5px;
            width: 5px;
            background-color: #fff;
            border-radius: 50%;
            display: inline-block;
        }
    </style>

    <div class="container-fluid position-relative bg-dark">
        <div class="card mb-3 p-md-5 m-md-3 bg-dark border-0 text-light">
            <div class="row">
                <div class="col-md-4">
                    @if ($movie['poster_path'])
                        <img src="https://www.themoviedb.org/t/p/w300/{{ $movie['poster_path'] }}" class="img-fluid rounded-start" alt="{{ $movie['title'] }}">
                    @else
                        <img src="https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg" class="img-fluid rounded-start" alt="{{ $movie['title'] }}" />
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title">
                            <strong>{{ $movie['title'] }}</strong>
                            <span class="text-muted">({{ date("Y", strtotime($movie['release_date'])) }})</span>
                        </h3>

                        <div class="d-inline py-4">
                            {{ date('Y/m/d', strtotime($movie['release_date'])) }}
                            
                            <span class="dot mx-1"></span>

                            @foreach ($movie['genres'] as $genre)
                                {{ $genre['name'] }}@if (!$loop->last), @endif
                            @endforeach

                            <span class="dot mx-1"></span>
                            
                            {{ intdiv($movie['runtime'], 60) . 'h'. ($movie['runtime'] % 60) }}
                        </div>

                        <p class="card-text py-3">
                            <small class="text-muted">{{ $movie['tagline'] }}</small>
                        </p>

                        <div class="py-3">
                            <h3 class="card-title">Sinopse</h3>
                            <p class="card-text">{{ $movie['overview'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection