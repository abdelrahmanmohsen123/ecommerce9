@extends('layouts.admin')

@section('title', ' انشاء مدينه ')


@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark">
            انشاء مدينه
        </h1>
    </div>
    @include('includes.validationErrors')


    <div class="col-12">
        <form method="post" action="{{ route('cities.store') }}">
            @csrf
            <div class="form-group">
                <label for="">اسم  مدينه</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id=""  placeholder="ادخل  مدينه">
            </div>


            <div class="form-group">
                <label for="">الحاله</label>
                <select class="custom-select" name="status" id="">
                    <option value="" disabled selected>اختر</option>
                    @foreach ($statuses as $status =>$value)
                        <option @if(old('status') === $value) {{ 'selected' }} @endif value="{{$value}}" >{{$status}}</option>

                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">تحميل</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01">
                  <label class="custom-file-label" for="inputGroupFile01">اختر لوجو</label>
                </div>
              </div>
              @include('includes.create-submit-button')


        </form>

    </div>

@endsection
