@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <h1 class="mb-4">Progetti</h1>
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">

                        <img src="{{ $project->immagine_url }}" class="card-img-top" alt="{{ $project->title }}">
                        <div class="card-body ">

                            <h5 class="card-title">{{ $project->title }}</h5>

                            <p class="card-text">{{ $project->getAbstract(170) }}</p>

                            @if ($project->type)
                                <p class="card-text"><strong>Tipologia:</strong> {!! $project->getTypeBadge() !!}</p>
                            @endif
                            <p class="card-text"><strong>Tecnologie:</strong>
                                @if ($project->technologies->isEmpty())
                                    Nessuna tecnologia associata
                                @else
                                    @foreach ($project->technologies as $technology)
                                        {!! $technology->getTechnologyBadge() !!}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                @endif
                            </p>


                            <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-primary">Dettagli</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $projects->links('pagination::bootstrap-5') }}

    </div>
@endsection
