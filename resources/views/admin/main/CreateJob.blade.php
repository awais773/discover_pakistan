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
        <h1 class="h2 mb-4 text-gray-800">Add Job</h1>
        <form action="{{ url('Jobstore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="image">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Title Enter" required>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="time">Time</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="time" name="time" required>
                            <select class="form-control" id="time_period" name="time_period">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
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
        var Job = document.getElementById('category');
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
