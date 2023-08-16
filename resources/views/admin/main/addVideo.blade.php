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
        <h1 class="h2 mb-4 text-gray-800">Add Vides</h1>
        <form action="{{ url('/Video') }}" method="POST">
            @csrf
            <br>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="title">Title </label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title enter" required>
                        {{-- <small id="emailHelp" class="form-text text-muted"></small> --}}
                    </div>
                </div>

                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="">Video </label>
                        <input type="text" class="form-control" id="video" name="video"
                            placeholder="video enter">
                        {{-- <small id="emailHelp" class="form-text text-muted"></small> --}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="">Shorts Video </label>
                        <input type="text" class="form-control" id="shorts_video" name="shorts_video"
                            placeholder="shortsVideo enter">
                        {{-- <small id="emailHelp" class="form-text text-muted"></small> --}}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="">Category </label>
                        <select id="category" name="category"  class="select2 form-control" required>
                            <option value="">Select Category</option>
                            <option>Popular Shows</option>
                            <option>Documentaries</option>
                            <option>Most Viewed</option>
                            <option>Complete Archive</option>
                            <option>Adventure Club</option>
                            <option>Latest videos</option>
                            <option>Discover Shorts</option>
                            <option>Dekho Pakistan</option>
                            <option>Paharon Ka Safar</option>
                            <option>Food Street</option>
                            <option>Hotels For You</option>
                            <option>De-Bikers</option>
                            <option>Travelogue of The Week</option>

                        </select>
                    </div>
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
