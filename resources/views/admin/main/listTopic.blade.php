@include('Layoutspage.Head')
@include('Layoutspage.sidebar')


<div class="container">
    <div class="container-fluid">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
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
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Topic</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ url('/TopicCreate') }}">Add Topic</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        {{-- <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="dataTable_length"><label class="label-top">Show
                                        <select name="dataTable_length" aria-controls="dataTable"
                                            class="custom-select custom-select-sm form-control form-control-sm label-inner">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                            class="form-control form-control-sm" placeholder=""
                                            aria-controls="dataTable"></label></div>
                            </div>
                        </div> --}}
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
                                                style="width: 131.172px;">Video</th>
                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Name: activate to sort column ascending"
                                                style="width: 131.172px;">Short Video</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Name: activate to sort column ascending"
                                                style="width: 131.172px;">Catgory</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1"
                                                aria-label="Start date: activate to sort column ascending"
                                                style="width: 131.172px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Withdraw as $user)
                                            <tr class="even">
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->video }}</td>
                                                <td>{{ $user->shorts_video }}</td>
                                                <td>{{ $user->category }}</td>
                                                <td style="display: flex">
                                                    {{-- <div style="  margin-right: 10px">
                                                        <a class="btn btn-success" href="{{ url('/AddEdit',$user->id) }}">Add Adds</a>
                                                    </div> --}}
                                                    <div style="  margin-left: 10px;">
                                                        <form method="post" action="{{ url('/Adddelete', $user->id) }}">
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
