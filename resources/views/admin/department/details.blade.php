@extends('layouts.adminLayout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Departments</h6>
        </div>
        <div class="card-body">
            @include('alerts')
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Updated</th>
                            <th>Edit / Delete</th>
                        </tr>

                    </thead>
                    <tfoot>
                        <tr>
                            <th class="searchable">Id</th>
                            <th class="searchable">Name</th>
                            <th class="searchable">Description</th>
                            <th>Updated</th>
                            <th>Edit / Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($depts as $dept)

                            <tr>
                                <td>{{ $dept->id }}</td>
                                <td>{{ $dept->name }}</td>
                                <td>{{ $dept->description }}</td>
                                <td>{{ $dept->updated_at->diffForhumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.dept.edit', $dept->id) }}"
                                        class="btn btn-flat btn-info  btn-sm">Edit</a>
                                    <form method="post" action="{{ route('admin.dept.destroy', $dept->id) }}"
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

                <div class="d-sm-flex justify-content-center ">
                    {!! $depts->links() !!}
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
            $('#dataTable tfoot .searchable').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });
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

            $('#dataTable tfoot .searchable').each(function(i) {
                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table.column(i).search(this.value).draw();
                    }
                });
            });


        });

    </script>
@endsection
