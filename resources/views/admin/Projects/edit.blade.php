@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-success my-4">
            Torna alla lista Progetti
        </a>

        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-success my-4">
            Mostra i Dettagli
        </a>

        <h1 class="my-4">Modifica il tuo Progetto</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="row g-3"
            enctype="multipart/form-data">
            @csrf <!-- Aggiunto il token CSRF -->
            @method('PATCH')

            <div class="col-4">
                <label for="titolo">Titolo</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $project->title }}">
            </div>

            <div class="col-4">
                <label for="thumb">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $project->slug }}">
            </div>



            <div class="col-4">
                <label for="type_id">Tipologia</label>
                <select name="type_id" id="type_id" class="form-control">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id === $project->type_id ? 'selected' : '' }}>
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-4">
                    <label for="image">Immagine</label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4 mt-2">
                    <img src="{{ asset('storage/' . $project->image) }}" class="img-fluid" id="image_preview">

                </div>
            </div>


            <div class="col-12">
                <div class="row">
                    <label for="technologies">Tecnologie</label>
                    @foreach ($technologies as $technology)
                        <div class="col-2">
                            <input type="checkbox" name="technologies[]" id="technology_{{ $technology->id }}"
                                value="{{ $technology->id }}" class="form-check-input"
                                {{ in_array($technology->id, $project->technologies->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label for="technology_{{ $technology->id }}" class="form-check-control">
                                {{ $technology->label }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>



            <div class="col-12">
                <label for="description">Content</label>
                <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="8">{{ $project->content }}</textarea>
                @error('content')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Modifica Progetto</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        const inputFileElement = document.getElementById('image');
        const imagePreview = document.getElementById('image_preview');
        if (!imagePreview.getAttribute('src')) {
            imagePreview.src = "https://placehold.co/400";
        }


        inputFileElement.addEventListener('change', function() {
            const [file] = this.files;
            imagePreview.src = URL.createObjectURL(file)
        })
    </script>
@endsection
