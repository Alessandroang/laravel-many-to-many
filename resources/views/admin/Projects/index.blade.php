@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('content')
    <div class="container mt-5">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
            Crea un nuovo progetto
        </a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Tipologia</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{!! $project->getTypeBadge() !!}</td>


                        <td>{{ $project->slug }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.projects.show', $project) }}" class="mx-1">
                                    <i class="fa-solid fa-up-right-from-square"></i>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project) }}" class="mx-1">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <a href="#" class="mx-1" data-bs-toggle="modal"
                                    data-bs-target="#delete-modal-{{ $project->id }}">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </a>
                            </div>

                            <div class="modal fade" id="delete-modal-{{ $project->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina Progetto</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Sei sicuro di voler eliminare definitivamente il Progetto
                                            "{{ $project->title }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annulla</button>

                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                                class="mx-1">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Elimina</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"><i>Non c'è nessun progetto</i></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection
