@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Test')



{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')

<div class="clearfix"></div>


<div class="container padd-30">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">

        </div>
    </div>
</div>


<script type="text/javascript">
    var _this = this
    $(document).ready(function(){

        $.ajax({
            url: '/api/getProducts',
            method: 'GET',
            dataType:'JSON'
        })
        .done(function(response) {

            var data = response.data;
            data = data.slice(0, 10)

            var sortFieldName = 'genericBrandId';

            data = _this.arrayOfObjectsSort(data, sortFieldName)

            console.log(data)
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

    })

    function arrayOfObjectsSort(arrayData, sortFieldName){
        arrayData.sort((a, b) => {
            if (a[sortFieldName] < b[sortFieldName]) return -1
            return a[sortFieldName] > b[sortFieldName] ? 1 : 0
        })

        return arrayData;
    }
    
</script>
@endsection
