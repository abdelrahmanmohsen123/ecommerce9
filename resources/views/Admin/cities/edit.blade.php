@extends('layouts.admin')

@section('title', ' تعديل مدينه ')


@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark">
            تعديل مدينه
        </h1>
    </div>
    @include('includes.validationErrors')



    <div class="col-12">
        <form method="post" action="{{ route('cities.update',['id'=>$city->id]) }}">
            @method('put')
            @csrf

            <div class="form-group">
                <label for=""> اسم مدينه</label>
                <input type="text" name="name" value="{{ $city->name }}" class="form-control" id=""  placeholder="ادخل مدينه">
            </div>


            <div class="form-group">
                <label for="">الحاله</label>
                <select class="custom-select" name="status" id="">
                    @foreach ($statuses as $status =>$value)
                        <option @if($city->status === $value) {{ 'selected' }} @endif value="{{$value}}" >{{$status}}</option>

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
            <button type="submit" name="edit" class=" btn btn-outline-primary">تعديل</button>

        </form>

    </div>

@endsection
