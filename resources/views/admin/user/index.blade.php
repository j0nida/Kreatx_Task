@extends('layouts.adminLayout')

@section('content')

    <h1 class="m-0 text-dark">List of Users</h1>

    <br>

    <div class="container">

        <div class="card shadow mb-4">
            @include('alerts')

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="datatable table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Department</th>
                                <th>Salary</th>
                                <th>Registered at</th>
                                <th>Updated at</th>
                                <th>Edit/Delete</th>
                            </tr>

                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Department</th>
                                <th>Salary</th>
                                <th>Registered at</th>
                                <th>Updated at</th>
                                <th>Edit/Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($users as $user)

                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->age }}</td>
                                    <td>{{ $user->department->name }}</td>
                                    <td>{{ $user->salary }}</td>
                                    <td>{{ $user->created_at->diffForhumans() }}</td>
                                    <td>{{ $user->updated_at->diffForhumans() }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="btn btn-flat btn-info  btn-sm">Edit</a>
                                        <form method="post" action="{{ route('admin.user.destroy', $user->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-flat btn-danger  btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="d-sm-flex justify-content-center ">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection


@section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                "searching": true,
                "paging": false,
                "info": false,
                sDom: 'lrtip',
                orderCellsTop: true,
                fixedHeader: true,
                "order": [
                    [0, "asc"]
                ],
            });

            $('#dataTable tfoot tr th:not(:last-child) ').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            $('#dataTable tfoot tr th').each(function(i) {
                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table.column(i).search(this.value).draw();
                    }
                });
            });


        });

    </script>
@endsection
