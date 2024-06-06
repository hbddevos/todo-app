@extends('home')

@section('title')
    Edition
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="my-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <form action="{{ route('task.update', $task) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                @include('shared.input', [
                    'type' => 'text',
                    'placeholder' => 'Todo...',
                    'class' => 'col',
                    'name' => 'title',
                    'value' => $task->title,
                    'label' => 'Nom de la tâche',
                ])
                @include('shared.input', [
                    'type' => 'date',
                    'class' => 'col',
                    'name' => 'dateExecution',
                    'label' => 'Date d\'exécution',
                    'value' => $task->dateExecution,
                ])

            </div>
            <div>
                @include('shared.input', [
                    'type' => 'textarea',
                    'name' => 'description',
                    'label' => 'Description de la tâche',
                    'value' => $task->description,
                ])

            </div>
            @include('shared.check', ['class' => 'mb-3', 'name' => 'done', 'value' => $task->done])
            <div><button type="submit" class="btn btn-primary">Add</button></div>
        </form>

    </div>
@endsection
