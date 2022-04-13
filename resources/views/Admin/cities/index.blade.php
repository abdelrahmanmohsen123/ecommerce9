@extends('layouts.admin')

@section('title', ' المدن')


@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark">
            المدن
        </h1>
    </div>

    <div class="col-12">
        <a href="{{ route('cities.create') }}" class="btn btn-primary rounded btn-sm"> انشاء  مدينه</a>
    </div>

    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
              <thead>
                <tr class="text-dark">
                  <th>الرقم</th>
                  <th>اسم المدينه</th>
                  <th>الحاله</th>
                  <th>تاريخ الانشاء</th>
                  <th>تاريخ التعديل</th>
                  <th>العمليات</th>

                </tr>
              </thead>
              <tbody>
                  @forelse ($cities as $city)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$city->name}}</td>
                    <td><label class="badge badge-{{$city->status == 1 ? 'success':'warning' }}">{{$city->status == 1 ? " مفعل":" غير مفعل" }}</label></td>
                    <td>{{$city->created_at}}</td>
                    <td>{{$city->updated_at}}</td>
                    <td>
                        <a href="{{route('cities.edit',['id'=>$city->id])}}" class="btn btn-outline-warning btn-sm">تعديل </a>

                        <form action="{{ route('cities.destroy',['id'=>$city->id]) }}" class="d-inline" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>

                        </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan='6' class="alert alert-warning font-weight-bold text-center">لايوجد مدن حاليا</td>

                  </tr>

                  @endforelse



              </tbody>
            </table>
          </div>
    </div>

@endsection
