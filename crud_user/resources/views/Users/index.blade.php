@extends('layout.basic')

@section('content')
    <div class="row">
        <div class="col-md-12 my-4">
            <h1 class="text-center">Tabel user</h1>
        </div>
        <div class="col-md-4 pt-4">
            <a href="{{ route('Users.create') }}" class="btn btn-primary">Tambah data</a>
        </div>
        <div class="col mt-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari data user">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Cari</span>
                </div>
            </div>
        </div>
    </div>


    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $data)
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>
        

                        </div>
                        @if ($data->user_photoProfile)
                            <img class="img-fluid" style="background-size: auto;" width="80px" height="80px" src="{{ asset('storage/' . $data->user_photoProfile) }}"
                                alt="">
                        @else
                            <img class="img-fluid" style="background-size: auto;" width="80px" height="80px"
                                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                alt="{{ $data['user_photoProfile'] }}">
                        @endif

                        <p class="d-inline-block pl-3"> {{ $data['user_name'] }} </p>

                    </td>

                    <td>{{ $data['email'] }}</td>
                    <td>
                        @php
                            $a = $data['user_role'];
                            $a === 0 ? ($a = 'Operator') : ($a === 1 ? ($a = 'Admin') : ($a = 'User'));
                        @endphp
                        {{ $a }}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('Users.edit', ['data' => $data]) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete-{{ $data->id }}">
                                Delete
                            </button>

                        </div>
                    </td>

                    {{-- Modal --}}
                    <div class="modal fade" id="delete-{{ $data->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this data?</p>

                                    <form action="{{ route('Users.delete', ['data' => $data]) }}" method="post">
                                        @csrf
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input class="btn btn-danger" type="submit" value="delete">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $no++;
                    @endphp
                </tr>
            @endforeach


        </tbody>
    </table>

    <hr>

    {{-- Pagination --}}
    <div class="row justify">
        <div class="col-10"></div>

        <div class="col">
            <p class="d-inline-block pr-3"> Lihat data : </p>
            <div class="dropdown d-inline-block">
                <a class="btn btn-secondary dropdown-toggle" href="#" user_role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    10
                </a>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">20</a>
                    <a class="dropdown-item" href="#">30</a>
                    <a class="dropdown-item" href="#">all</a>
                </div>
            </div>
        </div>

    </div>
@endsection
