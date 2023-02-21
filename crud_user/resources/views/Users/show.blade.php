@extends('layout.basic')

@section('content')
    <div class="card">
        <h1 class="text-center mt-4">Edit data</h1>
        <div class="card-body">

            <form method="POST" action="{{ route('Users.store') }}"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user_name">user_name</label>
                    <input type="text" value="{{ $user['user_name'] }}" class="form-control" id="user_name" name="user_name">
                </div>

                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="user_role">user_role</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="user_role" id="admin-radio" value="0"
                            type="number">
                        <label class="form-check-label" for="admin radio">
                            Admin
                        </label>
                    </div>
                    <div class="form-check">

                        <input class="form-check-input" type="radio" name="user_role" id="operator-radio" value="1"
                            type="number">
                        <label class="form-check-label" for="operator-radio">
                            Operator
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="upload-profile">foto profile</label>
                    <div class="custom-file">

                        <input type="file" class="form-control" name="user_photoProfile" id="upload-profile">
                        <label class="custom-file-label" for="upload-profile">Choose file</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


@endsection
