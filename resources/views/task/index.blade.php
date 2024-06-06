@extends('home')

@section('title')
    Toutes les tâches
@endsection


@section('content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nom de la tâche</th>
                    <th scope="col">Description</th>
                    <th class="text-end" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tasks as $task)
                    <tr class="">
                        <td>
                            <div>
                                <h5>{{$task->title}}</h5>
                                <h6 class="text-danger">Créée le {{ $task->created_at }}</h6>
                                <h6 class="text-info"> A faire le {{ $task->dateExecution}} </h6>
                            </div>
                        </td>
                        <td> {{ $task->description }} </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-end">
                                <div><a href=" {{route('task.edit', $task)}} " class="btn btn-primary d-flex gap-2 align-items-center"><i class="fa-solid fa-pencil"></i>Edit</a></div>
                                <form action="{{route('task.destroy', $task)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger d-flex gap-2 align-items-center"><i class="fa-solid fa-trash"></i>Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{--        {{$tasks->links()}}--}}
    </div>
@endsection
