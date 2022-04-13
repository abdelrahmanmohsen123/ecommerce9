@extends('layouts.admin')

@section('title', ' تعديل علامه تجاريه ')


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
            تعديل علامه تجاريه
        </h1>
    </div>
    @include('includes.validationErrors')



    <div class="col-12">
        <form method="post" action="{{ route('brands.update',['brand'=>$brand->id]) }}" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="form-group">
                <label for=""> اسم علامه التجاريه باللغه الانجليزيه</label>
                <input type="text" name="name[en]" value="{{ $brand->getTranslation('name','en') }}" class="form-control" id=""  >
            </div>
            <div class="form-group">
                <label for=""> اسم علامه التجاريه باللغه العربيه</label>
                <input type="text" name="name[ar]" value="{{ $brand->getTranslation('name','ar') }}" class="form-control" id=""  >
            </div>


            <div class="form-group">
                <label for="">الحاله</label>
                <select class="custom-select" name="status" id="">
                    @foreach ($statuses as $status =>$value)
                        <option @if($brand->status === $value) {{ 'selected' }} @endif value="{{$value}}" >{{$status}}</option>

                    @endforeach
                </select>
            </div>



              <div class="row">
                  <div class="col-3">
                    <input type="file" hidden name="image" class="custom-file-input" id="inputGroupFile01" onchange="previewImage(event)">

                    <label  for="inputGroupFile01"> <img id="output" src="{{asset($brand->getFirstMediaUrl('brands'))}}" class="w-100" alt="{{$brand->name}}"  class="w-100 my-4" alt="{{$brand->name}}" style="cursor: pointer"></label>
                  </div>
              </div>
              <div class="form-group">

                <input id="resize" name="resize" value="true" @if (old('resize') === 'true') checked @endif type="checkbox" >
                <label for="resize">تغير ابعاد الصوره</label>
                <div class="row d-none" id="resizebox">
                    <div class="col-2">
                        <input type="number" name="width" value="{{ old('width') }}" class="form-control" id=""   placeholder="ادخل  العرض">
                    </div>
                    <div class="col-2">
                        <input type="number" name="height" value="{{ old('height') }}" class="form-control" id="" placeholder="ادخل الطول " >
                    </div>
                </div>
            </div>
            <button type="submit" name="edit" class=" btn btn-outline-primary" >تعديل</button>

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

