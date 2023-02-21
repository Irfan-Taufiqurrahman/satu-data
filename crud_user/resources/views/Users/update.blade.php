@extends('layout.basic')
@section('content')
    <div class="card">
        <h1 class="text-center mt-4">Edit data</h1>
        <div class="card-body">

            <form method="POST" action="{{ route('Users.update', ['data' => $data]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user_name">user_name</label>
                    <input type="text" value="{{ $data['user_name'] }}"
                        class="form-control  @error('user_name') is-invalid @enderror" id="user_name" name="user_name">
                    @error('user_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" value="{{ $data['email'] }}"
                        class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" value="{{ $data['password'] }}"
                        class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    <a class="btn text-primary" style="font-size:12px;" id="togglePassword">show password</a>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="user_role">user_role</label>
                    <select name="user_role" id="user_role" class="form-control @error('user_role') is-invalid @enderror">
                        <option id="selected" oninput="showRole()" value="{{ $data['user_role'] }}" selected disabled>{{ $user_role }}</option>
                        <option id="user_role_0" value="0">Operator</option>
                        <option id="user_role_1" value="1">Admin</option>
                        <option id="user_role_2" value="2">User</option>
                    </select>
                    @error('user_role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="formFile" class="form-label">upload foto profil</label>
                    <input type="hidden" name="oldImage" value="{{ $data->user_photoProfile }}">
                    @if ($data->user_photoProfile)
                        <img src="{{ asset('storage/' . $data->user_photoProfile) }}"
                            class="img-preview img-fluid rounded mb-3 col-sm-5 d-block">
                    @else
                        <img class="img-preview img-fluid rounded mb-3 col-sm-5 d-block">
                    @endif

                    <input class="form-control pt-1 @error('user_photoProfile') is-invalid @enderror" name="user_photoProfile"
                        onchange="previewImage()" type="file" id="user_photoProfile">
                    @error('user_photoProfile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
