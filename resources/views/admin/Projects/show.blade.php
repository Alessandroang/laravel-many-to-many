@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna alla lista progetti</a>

        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning my-4">
            Modifica Progetto
        </a>
        <h1>Dettagli del Progetto</h1>

        <div class="card mt-4">
            <div class="row">

                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $project->image) }}" class="img-fluid" alt="Immagine del progetto">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text"><strong>Nome del file:</strong> {{ $project->name }}</p>
                        <p class="card-text"><strong>Slag:</strong> {{ $project->slug }}</p>
                        <p class="card-text"><strong>Created at:</strong> {{ $project->created_at }}</p>
                        <p class="card-text"><strong>Updated at:</strong>{{ $project->updated_at }}</p>
                        <p class="card-text"><strong>Descrizione:</strong> {{ $project->content }}</p>
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

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
