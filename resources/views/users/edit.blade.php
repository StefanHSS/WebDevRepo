<x-admin-master>

    @section('content')

    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @elseif (Session::has('failure'))
        <div class="alert alert-danger">{{Session::get('failure')}}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" @if ($user->avatar)
                            src="{{$user->avatar->avatar}}"
                            @else src="http://placehold.it/50x50"
                            @endif height="90" width="90">
                        <span class="font-weight-bold">{{$user->firstName}}</span>
                        <span class="text-black-50">{{$user->email}}</span>
                        <span> </span>

                        <div class="form-group">
                            <label for="fileUpload">Upload file</label>
                            <input type="file" name="file" id="file" class="form-control-file">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Edit user: {{$user->firstName . " " . $user->lastName}}</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Name</label>
                                <input type="text" class="form-control" name="firstName" placeholder="first name" value="{{$user->firstName}}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Surname</label>
                                <input type="text" class="form-control" name="lastName" value="{{$user->lastName}}" placeholder="surname">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input type="text" class="form-control" name="email" placeholder="enter email id" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-primary">Save profile</button>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->hasRole('Administrator'))
                <div class="row">
                    <div class="col-md-6 mx-auto border-left">
                        <div class="p-3 mx-auto">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Updated at</th>
                                        <th>Enabled</th>
                                        <th>Disabled</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->updated_at}}</td>
                                            <td>
                                                <form action=""></form>
                                                <form action="{{route('roles.attach', $role)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="userAttach" value="{{$user->id}}">
                                                    <button type="submit" class="btn btn-primary" @if ($user->hasRole($role->name)) disabled @endif>Enable</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('roles.detach', $role)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="userDetach" value="{{$user->id}}">
                                                    <button type="submit" class="btn btn-danger" @if (!$user->hasRole($role->name)) disabled @endif>Disable</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Updated at</th>
                                        <th>Enabled</th>
                                        <th>Disabled</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </form>
    @endsection
</x-admin-master>
