<div class="col-lg-7 col-md-4 col-sm-8 col-xs-8 col-ts-12 middle-content container-vertical-wapper ">
    <div class="search-form layout2 box-has-content">
        <div class="search-block">
            <div class="search-choice">
                <select data-placeholder="Cari" class="chosen-select">
                    {{--@foreach ($category as $cat)
                    <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                    @endforeach--}}
                </select>
            </div>
            <div class="search-inner">
                <form class="form-inline pull-right" action="{{ url()->current() }}">
                    <input type="text" class="search-info" placeholder="Cari..." name="keyword">
                </form>
            </div>
            <a class="search-button"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
    </div>
</div>