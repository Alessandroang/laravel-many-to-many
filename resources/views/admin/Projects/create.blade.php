@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-success my-4">
            Torna alla lista Progetti
        </a>

        <h1 class="my-4">Crea il tuo Progetto</h1>


        @if ($errors->any())
            <div class="alert alert-danger">
                <h3>Correggi i seguenti errori</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.projects.store') }}" method="POST" class="row g-3">
            @csrf <!-- Aggiunto il token CSRF -->

            <div class="col-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-3">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                    value="{{ old('slug') }}">
                @error('slug')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-3">
                <label for="created_at">Created at</label>
                <input type="date" name="created_at" id="created_at" class="form-control"
                    value="{{ old('created_at') }}">
            </div>

            <div class="col-3">
                <label for="updated_at">Updated at</label>
                <input type="text" name="updated_at" id="updated_at" class="form-control"
                    value="{{ old('updated_at') }}">
            </div>

            <div class="col-3">
                <label for="type_id">Tipologia</label>
                <select name="type_id" id="type_id" class="form-select">
                    <option value="">Seleziona una tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="4">{{ old('content') }}</textarea>
                @error('content')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Inserisci Progetto</button>
            </div>
        </form>


    </div>
    </div>
@endsection
