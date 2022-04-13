@extends('layouts.admin')

@section('title', ' الموديلات')


@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark">
            الموديلات
        </h1>
    </div>

    <div class="col-12">
        <a href="{{ route('models.create') }}" class="btn btn-primary rounded btn-sm"> انشاء موديل</a>
    </div>

    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
              <thead>
                <tr class="text-dark">
                  <th>الرقم</th>
                  <th>  اسم الموديل باللغه العربيه</th>
                  <th> اسم الموديل باللغه الانجليزيه</th>
                  <th>السنه</th>
                  <th>العلامه التجاريه</th>
                  <th>الحاله</th>
                  <th>تاريخ الانشاء</th>
                  <th>تاريخ التعديل</th>
                  <th>العمليات</th>

                </tr>
              </thead>
              <tbody>
                  @forelse ($models as $model)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$model->getTranslation('name','ar')}}</td>
                    <td>{{$model->getTranslation('name','en')}}</td>

                    <td>{{$model->year}}</td>
                    <td>{{$model->brand->name}}</td>
                    <td><label class="badge badge-{{$model->status == 1 ? 'success':'warning' }}">{{$model->status == 1 ? " مفعل":" غير مفعل" }}</label></td>
                    <td>{{$model->created_at}}</td>
                    <td>{{$model->updated_at}}</td>
                    <td>
                        <a href="{{route('models.edit',['model'=>$model->id])}}" class="btn btn-outline-warning btn-sm">تعديل </a>

                        <form action="{{ route('models.destroy',['model'=>$model->id]) }}" class="d-inline" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>

                        </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan='8' class="alert alert-warning font-weight-bold text-center">لايوجد موديل حاليا</td>

                  </tr>

                  @endforelse



              </tbody>
            </table>
          </div>
    </div>

@endsection
