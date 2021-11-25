<x-admin-master>
    @section('content')
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>slug</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{$role->name}}</td>
                    <td>{{$role->slug}}</td>
                    <td>{{$role->created_at}}</td>
                    <td>{{$role->updated_at}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>slug</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </tfoot>
    </table>
    @endsection
</x-admin-master>
