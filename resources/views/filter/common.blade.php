@php
    $filtre ??= '';
    $titre ??= '';

@endphp

@extends('home')


@section('navigation')
    @if ($filtre == 'corbeille')
        Corbeille
    @elseif ($filtre == 'complete')
        Completed
    @elseif ($filtre == 'pending')
        Pending
    @elseif ($filtre == 'planned')
        Planned
    @elseif ($filtre == 'expired')
        Expired
    @elseif ($filtre == 'today')
       Today
    @else
       All
    @endif
@endsection

@section('title')
    @if ($filtre == 'corbeille')
        Corbeille
    @elseif ($filtre == 'complete')
        Tâches Completées
    @elseif ($filtre == 'pending')
        Tâches en attente
    @elseif ($filtre == 'planned')
        Tâches a faire
    @elseif ($filtre == 'expired')
        Tâches expirées
    @elseif ($filtre == 'today')
        Tâches du jour
    @else
        Toutes les tâches
    @endif
@endsection

@section('content')
    <h1 class="text-center text-decoration-underline mb-3">{{ $titre }}</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>
                <h5 class="text-start">Nom des tâches</h5>
            </th>
            <th>
                <h5 class="text-center">Description</h5>
            </th>
            <th>
                <h5 class="text-end">Supprimer définitivement</h5>
            </th>
        </tr>
        </thead>
        <tbody>

        @forelse ($tasks as $task)
            <tr>
                <td>
                    <div>
                        <h5>{{ $task->title }}</h5>
                        <h6 class="text-danger">Créée le {{ $task->created_at }}</h6>
                        @if ($filtre == 'complete')
                            <h6 class="text-success text-decoration-line-through">Tâckes effectuée</h6>
                        @elseif($filtre == 'expired')

                            <h6 class="text-warning text-decoration-line-through"> Non
                                fait {{ $task->dateExecution }}</h6>

                        @elseif($filtre == 'planned')
                            <h6 class="text-info"> Planifier pour le: {{ $task->dateExecution }}</h6>
                        @elseif($filtre == 'pending')
                            <h6 class="text-info"> Tâche en attente </h6>
                        @elseif($filtre == 'today')
                            <h6 class="text-info"> Tâche a faire aujourd'hui </h6>
                        @else
                            <h6 class="text-info"> Créer le: {{ $task->dateExecution }}  </h6>
                        @endif


                    </div>
                </td>
                <td> {{ $task->description }} </td>
                <td>
                    <div class="d-flex justify-content-end align-items-center">
                        <form action="{{route('task.destroy', $task)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger d-flex gap-2 align-items-center "><i
                                    class="fa-solid fa-trash"></i>Delete
                            </button>
                        </form>
                    </div>
                </td>
        @empty
            {{-- <tr>
            <td>
                <strong class="text-center">
                    Aucune tâche
                </strong>
            </td>
        </tr> --}}
        @endforelse
        </tbody>
    </table>
@endsection
