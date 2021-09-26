@extends('layout.mainlayout')

@section('content')
    <style type="text/css">
        .star_rated { color: gold; }
        .star { text-shadow: 0 0 1px #F48F0A; }
    </style>

    <div class="container">
        <form action="" method="get" class="d-flex">
            <input class="form-control me-2" name="query" type="search" placeholder="Search by name..." aria-label="Search by name...">
            <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
    </div>

    <hr>

    <ul class="nav col-12 justify-content-center">
        @foreach ($genres as $genre)
            <li class="nav-item">
                <a href="/?genre={{ $genre['id'] }}" class="nav-link link-dark">{{ $genre['name'] }}</a>
            </li>
        @endforeach
    </ul>

    <hr>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach ($trending as $trend)
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            @if ($trend['poster_path'])
                                <img src="https://www.themoviedb.org/t/p/w780/{{ $trend['poster_path'] }}" class="card-img-top" alt="{{ $trend['title'] }}" />
                            @else
                                <img height="456" src="https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg" class="card-img-top" alt="{{ $trend['title'] }}" />
                            @endif
                
                            <div class="card-body">
                                <h5 class="card-title">{{ $trend['title'] }}</h5>
                                <p>
                                    <small class="text-muted">
                                        @foreach ($trend['genre_ids'] as $genre_id)
                                            @foreach ($genres as $genre)
                                                @if ($genre['id'] == $genre_id)
                                                    {{ $genre['name'] }},
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </small>
                                </p>

                                <p>
                                    <span class="text-muted">{{ date($trend['release_date']) }}</span>
                                </p>

                                <p class="card-text">{{ $trend['overview'] }}</p>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-inline p-2 star" title="Vote average: {{ $trend['vote_average'] }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $trend['vote_average']/2)
                                                <span class="star_rated">&#x2605;</span>
                                            @else
                                                <span>&#x2605;</span>
                                            @endif
                                        @endfor
                                    </div>
                                    
                                    <div class="btn-group">
                                        <a href="./movie/{{ $trend['id'] }}">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View details</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection