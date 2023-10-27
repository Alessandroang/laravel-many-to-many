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
                    {{-- <img src="{{ $comic->thumb }}" alt="{{ $comic->title }}" class="img-fluid"> --}}
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text"><strong>Titolo:</strong> {{ $project->name }}</p>
                        <p class="card-text"><strong>Slag:</strong> {{ $project->slug }}</p>
                        <p class="card-text"><strong>Created at:</strong> {{ $project->created_at }}</p>
                        <p class="card-text"><strong>Updated at:</strong>{{ $project->updated_at }}</p>
                        <p class="card-text"><strong>Descrizione:</strong> {{ $project->content }}</p>
                        @if ($project->type)
                            <p class="card-text"><strong>Tipologia:</strong>{!! $project->getTypeBadge() !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
