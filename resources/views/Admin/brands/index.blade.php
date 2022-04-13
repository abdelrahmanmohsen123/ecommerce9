@extends('layouts.admin')

@section('title', ' علامات تجاريه')


@section('content')

    <div class="col-sm-6">
        <h4 class="mb-0"> @yield('title')</h4>
    </div>
    <nav class="col-sm-6" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0 pr-0 float-right text-right  ">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الصفحه رئيسيه</a></li>
        {{-- <li class="breadcrumb-item"><a href="#">Library</a></li> --}}
        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
        </ol>
    </nav>

    <div class="col-12">
        <h1 class="h1 text-center text-dark">
            علامات تجاريه
        </h1>
    </div>


    <div class="col-12">
        <a href="{{ route('brands.create') }}" class="btn btn-primary rounded btn-sm"> انشاء علامه تجاريه</a>
    </div>

    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
              <thead>
                <tr class="text-dark">
                  <th>الرقم</th>
                  <th>اسم العلامه التجاريه باللغه العربيه</th>
                  <th>اسم العلامه التجاريه باللغه الانجليزيه</th>

                  <th>الحاله</th>
                  <th>تاريخ الانشاء</th>
                  <th>تاريخ التعديل</th>
                  <th>العمليات</th>

                </tr>
              </thead>
              <tbody>
                  @forelse ($brands as $brand)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$brand->getTranslation('name','ar')}}</td>
                    <td>{{$brand->getTranslation('name','en')}}</td>

                    <td><label class="badge badge-{{$brand->status == 1 ? 'success':'warning' }}">{{$brand->status == 1 ? " مفعل":" غير مفعل" }}</label></td>
                    <td>{{$brand->created_at}}</td>
                    <td>{{$brand->updated_at}}</td>
                    <td>
                        <a href="{{route('brands.edit',['brand'=>$brand->id])}}" class="btn btn-outline-warning btn-sm">تعديل </a>

                        <form action="{{ route('brands.destroy',['brand'=>$brand->id]) }}" class="d-inline" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>

                        </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan='6' class="alert alert-warning font-weight-bold text-center">لايوجد علامات تجاريه حاليا</td>

                  </tr>

                  @endforelse



              </tbody>
            </table>
          </div>
    </div>

@endsection
