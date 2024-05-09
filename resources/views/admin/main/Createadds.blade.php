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
        <h1 class="h2 mb-4 text-gray-800">Add Adds</h1>
        <form action="{{ url('Addupdate/' . $Add->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <br>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="">Category </label>
                        <select id="category" name="category" class="select2 form-control" required
                            onchange="toggleImageField()">
                            <option value="">Select Category</option>
                            <option {{ $Add->category === 'Live Broadcast' ? 'selected' : '' }}>Live Broadcast</option>
                            <option {{ $Add->category === 'Paharo Ka Safar' ? 'selected' : '' }}>Paharo Ka Safar
                            </option>
                            <option {{ $Add->category === 'Discover Shorts' ? 'selected' : '' }}>Discover Shorts
                            </option>
                            <option {{ $Add->category === 'Details' ? 'selected' : '' }}>Details</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                            placeholder="image enter">
                        @if ($Add->image)
                            <img src="{{ asset($Add->image) }}" alt="Old Image" style="max-width: 100%; height: auto;">
                        @else
                            <p>No old image available</p>
                        @endif
                        <span class="text-danger" id="imageField" style="display: none;">(1920px width and 511px
                            height)</span>
                        <span class="text-danger" id="Broadcast" style="display: none;">( Image should be
                            268x324)</span>
                        <span class="text-danger" id="Paharo" style="display: none;">(Image should be
                            536x1148)</span>
                        <span class="text-danger" id="Shorts" style="display: none;">(Image should be 340x577)</span>
                    </div>
                </div>

                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="mobile_image">Mobile Image</label>
                        <input type="file" class="form-control" id="mobile_image" name="mobile_image"
                            placeholder="image enter">
                        @if ($Add->mobile_image)
                            <img src="{{ asset($Add->mobile_image) }}" alt="Old Mobile Image"
                                style="max-width: 100%; height: auto;">
                        @else
                            <p>No old mobile image available</p>
                        @endif
                        <span class="text-danger">(1000px width and 312px height)</span>
                    </div>
                </div>

                <div class="col-sm">
                    <div class="form-group">
                        <label class="h4 mb-2 text-gray-800" for="link">Link</label>
                        <input type="text" class="form-control" id="links" name="links"
                            value="{{ $Add->links }}" placeholder="link enter" required>
                    </div>
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
        var Broadcast = document.getElementById('Broadcast');
        var Paharo = document.getElementById('Paharo');
        var Shorts = document.getElementById('Shorts');

        if (category.value === 'Details') {
            imageField.style.display = 'block';
        } else {
            imageField.style.display = 'none';
        }

        if (category.value === 'Live Broadcast') {
            Broadcast.style.display = 'block';
        } else {
            Broadcast.style.display = 'none';
        }

        if (category.value === 'Paharo Ka Safar') {
            Paharo.style.display = 'block';
        } else {
            Paharo.style.display = 'none';
        }

        if (category.value === 'Discover Shorts') {
            Shorts.style.display = 'block';
        } else {
            Shorts.style.display = 'none';
        }
    }
</script>
<!-- --------End of Category--------- -->
@include('Layoutspage.footer')
