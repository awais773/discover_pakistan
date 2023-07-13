@include('Layoutspage.Head')
@include('Layoutspage.sidebar')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h2 mb-4 text-gray-800">Add Distribution</h1>
    @if(session()->has('message'))
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
    <h3 class="h4 mb-4 text-gray-800">Withdraw<span class="star">*</span></h3>
    <form action="{{ route('deposits.update',$deposit->id) }}" method="POST"enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm">
                {{-- <div class="form-group">
                    <label class="h4 mb-2 text-gray-800" for="">Animals </label>
                    <input type="text" class="form-control" value="{{ $category->animal_length }}" name="animal_length">
                </div> --}}
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label class="h4 mb-2 text-gray-800" for="">Balance </label>
                    <input type="text" class="form-control" value="{{ $deposit->amount }}" name="amount">
                    {{-- <small id="emailHelp" class="form-text text-muted"></small> --}}
                </div>
            </div>
            <div class="col-sm">
                {{-- <div class="form-group">
                    <label class="h4 mb-2 text-gray-800" for="">Max Timer </label>
                    <input type="text" class="form-control" value="{{ $category->max_timer }}" name="max_timer">
                </div> --}}
            </div>
        </div>
        <button type="submit"
        class="btn btn-primary float-right export-btn btn-save-dis">Update</button>
    </form>
</div>
@include('Layoutspage.footer')
