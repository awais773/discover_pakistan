@include('Layoutspage.Head')
@include('Layoutspage.sidebar')
<!-- --------Category--------- -->
<div class="main-sub">
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
        <h1 class="h2 mb-4 text-gray-800">Add Slider</h1>
        <form action="{{ url('/SliderStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                            placeholder="image enter" required>
                            <span class="text-danger">Image should be 1920x540 in size</span>
                    </div>
                </div> 
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="link">link</label>
                        <input type="text" class="form-control" id="link" name="link"
                            placeholder="link enter" required>
                    </div>
                </div>
                <div class="col-sm">

                </div>
                <div class="col-sm">

                </div>
                <div class="col-sm">
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right export-btn btn-save-dis">Save</button>
        </form>
    </div>
</div>
<script>
    document.getElementById("addBtn").addEventListener("click", function(e) {
      e.preventDefault();
      var input = document.createElement("input");
      input.type = "text";
      input.name = "levels[]";
      document.getElementById("inputContainer").appendChild(input);
    });
    </script>
<!-- --------End of Category--------- -->
@include('Layoutspage.footer')
