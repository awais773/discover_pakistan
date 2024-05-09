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
        <h1 class="h2 mb-4 text-gray-800">Add Category</h1>
        <form action="{{ url('Categorystore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="image">Category</label>
                        <input type="text" class="form-control" id="name" name=" "
                            placeholder="name enter" required>
                    </div>
                </div>
                <div class="col-sm">
                    <label class="h4 mb-2 text-gray-800" for="image">Icon</label>
                        <input type="file" class="form-control" id="icon" name="icon"
                            placeholder="icon" required>
                            <span class="text-danger">Icon size should be in 80x80</span>
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


<script>
    function toggleImageField() {
        var category = document.getElementById('category');
        var imageField = document.getElementById('imageField');

        if (category.value === 'Details') {
            imageField.style.display = 'block';
        } else {
            imageField.style.display = 'none';
        }
    }
</script>
<!-- --------End of Category--------- -->
@include('Layoutspage.footer')
