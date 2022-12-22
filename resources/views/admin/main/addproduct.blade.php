@include('Layoutspage.Head')
@include('Layoutspage.sidebar')
<div class="container">
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 mb-4 text-gray-800">Add Product</h1>
        <h3 class="h4 mb-4 text-gray-800">Product Name <span class="star">*</span></h3>

    <form action="{{url('/storePrduct')}}" method="POST" enctype="multipart/form-data">
      @csrf


        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="English Name">
                    {{-- <small id="emailHelp" class="form-text text-muted"></small> --}}
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <input type="text" class="form-control" id="germany_name" name="germany_name" placeholder="German Name">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <input type="text" class="form-control" id="hebrew_name" name="hebrew_name" placeholder="Hebrew Name">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
            </div>
        </div>


    </div>
    <div class="container-fluid box-salect">
        <div class="row">

            <div class="col-3 col-md col-sm-12 check-box">
                <h3 class="h5 text-gray-800 ">Salect Distribution</h3>
                @foreach ($distributer as $distributers)
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">{{ $distributers->name }}</label>
                </div>
                @endforeach
            </div>

            <div class="col-4 col-md col-sm-12 check-box">
                <h3 class="h5  text-gray-800">Salect Categories/Sub-Categories</h3>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwosweet" aria-expanded="true" aria-controls="collapseTwosweet">
                        <span>SWEETS</span>
                    </a>
                    <div id="collapseTwosweet" class="collapse inner-collap" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2  rounded">
                            @foreach ($category as $categorys)
                            <div class="form-check form-switch collapse-inner">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">{{ $categorys->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwomeat" aria-expanded="true" aria-controls="collapseTwomeat">
                        <span>MEAT</span>
                    </a>
                    <div id="collapseTwomeat" class="collapse inner-collap" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 rounded">
                            <div class="form-check form-switch collapse-inner">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Amazon</label>
                            </div>
                            <div class="form-check form-switch collapse-inner">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Amazon</label>
                            </div>
                            <div class="form-check form-switch collapse-inner">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Amazon</label>
                            </div>
                        </div>
                    </div>
                </li> --}}

            </div>

            <div class="col-3 col-md col-sm-12 check-box">
                <h3 class="h5  text-gray-800">Kosher Status</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        KOSHER
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked="">
                    <label class="form-check-label" for="flexRadioDefault2">
                        NOT KOSHER
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div class="container-fluid box-salect">
        <div class="row ">
            <div class="col-6">
                <h3 class="h4 mb-4 text-gray-800">Packaging</h3>
                <div class="form-group">
                    <input type="text" class="form-control" id="packing" name="packing">
                    {{-- <small id="packaging" class="form-text text-muted"></small> --}}
                </div>
                <h3 class="h4 mb-4 text-gray-800">Barcode</h3>
                <div class="form-group">
                    <input type="text" class="form-control" id="barcode" name="barcode">
                    {{-- <small id="emailHelp" class="form-text text-muted"></small> --}}
                </div>
            </div>
            <div class="col-6">
                <h3 class="h4 mb-4 text-gray-800">Diet</h3>
                <div class="row mb-4">
                    <div class="col">
                        <select id="diet" name="diet"  class="select2 form-control">
                            <option>Choose One..</option>
                            <option>Pavve</option>
                            <option>Milk</option>
                            <option>Meat</option>
                        </select>
                    </div>
                 </div>
            </div>
        </div>
    </div>
    <div class="container-fluid box-salect">

        <!-- Page Heading -->

        <h3 class="h4 mb-4 text-gray-800">Ingredients</h3>

        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="English Name">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="German Name">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Hebrew Name">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
            </div>
        </div>


    </div>
    <div class="container-fluid box-salect">

        <div class="row sup-file">
            <div class="col-6">
                <h3 class="h4 mb-4 text-gray-800">Supervisor</h3>
                <input type="text" class="form-control" id="supervisor" name="supervisor" placeholder="">
            </div>
            <div class="col-5">
                <h3 class="h4 mb-4 text-gray-800">File Upload</h3>
                    <input  type="file" name="image[]" accept="image/*" id="image[]" name="filename">
            </div>

        </div>
    </div>
 
    <div class="container-fluid box-salect">

        <!-- Page Heading -->

        <h3 class="h4 mb-4 text-gray-800">Comments</h3>

        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="note">English:</label>
                    <textarea class="form-control" rows="3" id="note" name="note"></textarea>
                  </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="note">German:</label>
                    <textarea class="form-control" rows="3" id="note" name="note"></textarea>
                  </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="note">Hebrew:</label>
                    <textarea class="form-control" rows="3" id="note" name="note"></textarea>
                  </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-right export-btn btn-save-dis">Save</button>

    </form>
    </div>
</div>
@include('Layoutspage.footer')
