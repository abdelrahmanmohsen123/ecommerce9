@extends('layouts.admin')

@section('title', ' انشاء علامه تجاريه ')


@section('content')
    <div class="col-sm-6">
        <h4 class="mb-0"> @yield('title')</h4>
    </div>
    <nav class="col-sm-6" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0 pr-0 float-right text-right  ">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الصفحه رئيسيه</a></li>
        <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">العلامات التجاريه</a></li>
        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
        </ol>
    </nav>
    <div class="col-12">
        <h1 class="h1 text-center text-dark">
            انشاء علامه تجاريه
        </h1>
    </div>
    @include('includes.validationErrors')


    <div class="col-12">
        <form method="post" action="{{ route('brands.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for=""> اسم علامه التجاريه باللغه الانجليزيه</label>
                <input type="text" name="name[en]" value="{{ old('name[en]') }}" class="form-control" id=""  >
            </div>
            <div class="form-group">
                <label for=""> اسم علامه التجاريه باللغه العربيه</label>
                <input type="text" name="name[ar]" value="{{ old('name[ar]') }}" class="form-control" id=""  >
            </div>


            <div class="form-group">
                <label for="">الحاله</label>
                <select class="custom-select" name="status" id="">
                    <option value="" disabled selected>اختر</option>
                    @foreach ($statuses as $status =>$value)
                        <option @selected(old('status') === $value)  value="{{$value}}" >{{$status}}</option>

                    @endforeach
                </select>
            </div>

            {{-- <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">تحميل</span>
                </div>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="inputGroupFile01">
                  <label class="custom-file-label" for="inputGroupFile01">اختر لوجو</label>
                </div>
              </div> --}}
              <div class="row">
                <div class="col-3">
                  <input type="file" hidden name="image" class="custom-file-input" id="inputGroupFile01" onchange="previewImage(event)">

                  <label  for="inputGroupFile01"> <img id="output" src="{{asset('default.jpg')}}"  class="w-100 my-4"  style="cursor: pointer"></label>
                </div>
            </div>
            <div class="form-group">

                <input id="resize" name="resize" value="true" @if (old('resize') === 'true') checked @endif type="checkbox" >
                <label for="resize">تغير بعد لصوره</label>
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
@endpush
