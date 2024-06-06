@extends('home')

@section('title', 'Inscription')


@section('content')

    <div class="card border-primary mt-5">
        <div class="card-body">
            <h4 class="card-title">Inscription</h4>
            <div class="card-text">
                {{--                @if ($errors) --}}
                {{--                    @foreach ($errors->all() as $error) --}}
                {{--                        <div class="alert alert-danger alert-dismissible fade show" role="alert"> --}}
                {{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" --}}
                {{--                                    aria-label="Close"></button> --}}

                {{--                            <strong>{{$error}}</strong> --}}
                {{--                        </div> --}}

                {{--                    @endforeach --}}
                {{--                @endif --}}
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="">
                    </div>
                    @if (session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="">
                    </div>
                    @if (session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Mot de passe">
                    </div>
                    @if (session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="conf_password" class="form-label">Confirmation</label>
                        <input type="password" class="form-control" name="conf_password" id="conf_password"
                            placeholder="Confirmation de mot de passe">
                    </div>
                    @if (session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @error('conf_password')
                                {{ $message }}
                            @enderror
                        </div>
                    @endif
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
