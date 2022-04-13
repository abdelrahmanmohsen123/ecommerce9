@extends('layouts.admin')

@section('title', ' انشاء موديل ')
@push('css')

@endpush
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark">
            انشاء موديل
        </h1>
    </div>
    @include('includes.validationErrors')


    <div class="col-12">
        <form method="post" action="{{ route('models.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for=""> اسم موديل باللغه العربيه</label>
                <input type="text" name="name[ar]" value="{{ old('name.ar') }}" class="form-control" id=""  >
            </div>
            <div class="form-group">
                <label for=""> اسم موديل باللغه الانجليزيه</label>
                <input type="text" name="name[en]" value="{{ old('name.en') }}" class="form-control" id=""  >
            </div>
            <!-- <div class="form-group">
                <label for="datepicker">تاريخ الموديل</label>
                <input type="text" name="year" value="{{ old('year') }}" class="form-control" id="datepicker">
            </div> -->
            <div class="form-group my-4">
                <label for="datepicker">تاريخ الموديل</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">year</div>
                    </div>
                    <input type="text" name="year" placeholder="2022" value="{{ old('year') }}" class="form-control" id="datepicker">
            </div>
            <div class="form-group">
                <label for="">العلامه التجاريه</label>
                <select class="custom-select" name="brand_id" id="">
                    <option value="" disabled selected>اختر</option>
                    @foreach ($brands as $brand)
                        <option @if(old('brand_id') === $brand->id) {{'selected'}} @endif value="{{$brand->id}}" >{{$brand->getTranslation('name','ar')}} - {{$brand->getTranslation('name','en')}}</option>

                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="">الحاله</label>
                <select class="custom-select" name="status" id="">
                    @foreach ($statuses as $status =>$value)
                        <option @if(old('status') === $value) {{ 'selected' }} @endif value="{{$value}}" >{{$status}}</option>

                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-3">
                  <input type="file" hidden name="image" class="custom-file-input" id="inputGroupFile01" onchange="previewImage(event)">

                  <label  for="inputGroupFile01"> <img id="output" src="{{asset('default.jpg')}}"  class="w-100 my-4"  style="cursor: pointer"></label>
                </div>
            </div>
            <div class="form-group">

                <input id="resize" name="resize" value="true" @if (old('resize') === 'true') checked @endif type="checkbox" >
                <label for="resize">تغير ابعاد الصوره</label>
                <div id="resizebox" class="row d-none">
                    <div class="col-2">
                        <input type="number" name="width" value="{{ old('width') }}" class="form-control" id=""   placeholder="ادخل  العرض">
                    </div>
                    <div class="col-2">
                        <input type="number" name="height" value="{{ old('height') }}" class="form-control" id="" placeholder="ادخل الطول " >
                    </div>
                </div>
            </div>
              @include('includes.create-submit-button')


        </form>

    </div>

@endsection
@push('js')
    <script>
        $('#resize').on('change',function(){
            $('#resizebox').toggleClass('d-none')
        });



        var previewImage = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        };
    </script>

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#datepicker" ).datepicker({

            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            onClose: function(dateText, inst) {
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 1));
            }
        });

        $("#datepicker").focus(function() {
            $(".ui-datepicker-month").hide();
            $(".ui-datepicker-calendar").hide();
        });


    } );
    </script>
@endpush