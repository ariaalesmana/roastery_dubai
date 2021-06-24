<div class="main-content home-page main-content-home7">
    <div class="container">
        <div class="featured-products">
            <div class="section-head box-has-content">
                <h4 class="section-title">Products</h4>
                <div class="control">
                    <form action="{{ url()->current() }}" style="margin-right: 18px;">
                        <div class="col-md-6">
                            <div class="select-item">
                                <select class="form-control select2" name="filtervendor">
                                    <option></option>
                                    @foreach(get_list_vendor($code_url) as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="select-item" style="margin-left:10px;">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    @include('katalog.home.products')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="section-head box-has-content" style="z-index:2">
    <h4 class="section-title">Produk</h4>
    <ul class="nav list-nav">
        <div class="top-control box-has-content">
            <div class="control">
                <form action="{{ url()->current() }}" style="margin-right: 18px;">
                    <div class="select-item">
                        <select class="form-control select2" name="filtervendor">
                            <option></option>
                            @foreach(get_list_vendor($code_url) as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select-item" style="margin-left:10px;">
                        <button class="btn btn-primary" type="submit">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </ul>
</div> --}}