@include('Layoutspage.Head')
@include('Layoutspage.sidebar')


<div class="container">
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DiscoverPakisatn DataTables</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                    style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 131.172px;">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Name: activate to sort column ascending"
                                                style="width: 131.172px;">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 131.172px;">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 131.172px;">Premimum</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 131.172px;">Amount</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1"
                                                aria-label="Start date: activate to sort column ascending"
                                                style="width: 131.172px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Users as $user )
                                        <tr class="even">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{$user->email }}</td>
                                            <td>{{$user->premium }}</td>
                                            <td>{{$user->amount }}</td>
                                            <td style="display: flex">
                                                {{-- <div style="  margin-right: 10px">    
                                                <a class="btn btn-success" href="{{ url('/User',$user->id) }}"> <i class="fas fa-edit"></i></a>
                                            </div> --}}
                                            <div style="  margin-left: 10px;">
                                                <form method="post" action="{{url('/Users',$user->id)}}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i
                                                        class="far fa-trash-alt"></i></button>                                               
                                                     </form>
                                                    </div>
                                                    </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-secondary float-right export-btn"
                        onclick="exportTableToExcel('dataTable' , 'members-data');"> Export Data</button>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#example').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        });
                    });
                </script>
            </div>
        </div>

    </div>
</div>
@include('Layoutspage.footer')

