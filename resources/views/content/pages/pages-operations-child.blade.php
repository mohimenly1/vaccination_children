@extends('layouts/contentNavbarLayout')

@section('title', 'العمليات لملف الطفل')


@section('page-script')
<script src="{{asset('assets/js/delete-child.js')}}"></script>
@endsection

@section('content')
<div class="row" dir="rtl">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">الإجراءات /</span> ملف الطفل
  </h4>

  <div class="card">
    <h5 class="card-header"></h5>
    <div class="table-responsive text-nowrap">
      <form action="{{ route('child.search') }}" method="GET">
        @csrf
        <div class="mb-3">
          <input type="text" class="form-control" name="query" placeholder="يمكنك التحقق من وجود طفل عن طريق الاسم او الرقم الوطني">
        </div>
        <button type="submit" class="btn btn-primary mb-3">بحث</button>
      </form>
      <table class="table">
        <thead>
          <tr>
            <th>إسم الطفل</th>
            <th>الرقم الوطني 🇱🇾</th>
            <th>تاريخ الميلاد</th>
            <th>الإجراءات</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($children as $child)
          <tr>
            <td>{{ $child->name_child }}</td>
            <td>{{ $child->national_number }}</td>
            <td>{{ $child->date_birth }}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu text-right" style="text-align:right">
                  <a class="dropdown-item" href="{{ route('operations-child.edit', $child->id) }}"><i class="bx bx-edit-alt me-1"></i> تعديل</a>
                  <a class="dropdown-item"  onclick="confirmDeleteChild({{ $child->id }});"><i class="bx bx-trash me-1"></i> حذف</a>
                  <a class="dropdown-item" href="javascript:void(0);" onclick='addVaccinationChild({{$child->id}})'><i class="bx bxs-baby-carriage me-1"></i> اضافة تطعيمة لهذا الطفل</a>
                  <a class="dropdown-item" href="javascript:void(0);" onclick='printChild({{$child->id}})' id="print-btn" data-id="{{ $child->id }}"><i class="bx bxs-printer me-1"></i> طباعة ملف صحي للطفل</a>


                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="mt-4 pagination">
    {{ $children->links() }}
  </div>
</div>


<div class="modal fade" id="confirm-delete-child" tabindex="-1" aria-labelledby="confirm-delete-child-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirm-delete-child-label">تأكيد الحذف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        هل أنت متأكد أنك تريد حذف هذا الطفل؟
        <input type="hidden" id="child-id" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-danger" id="delete-child-btn">حذف</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="add-vaccination-child" tabindex="-1" aria-labelledby="add-vaccination-child-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" dir="rtl">
      <div class="modal-header">
        <h5 class="modal-title" id="add-vaccination-child-label">إضافة تطعيمة لهذا الطفل</h5>
        <button type="button" class="btn-close form-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" dir="rtl">
        <form id="add-vaccination-form" method="POST" action="{{route('vaccination-add-child')}}" >

          @csrf
          @method('POST')
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-email">الرقم الوطني</label>
              <div class="col-sm-10" id="nid-child-container">
                  <div class="input-group input-group-merge " dir="ltr">
                      <span class="input-group-text" id="basic-default-email2">🇱🇾</span>
                      <input type="text" class="form-control text-right @error('NidChild') is-invalid @enderror" name="NidChild"/>
                      @error('NidChild')
                      <div class="invalid-feedback text-right" dir="rtl">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-text"> يجب أن يكون من 12 رقم </div>
             
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label">تاريخ التطعيم</label>
              <div class="col-sm-10">
                  <input type="date" class="form-control @error('VaccinationDate') is-invalid @enderror" name="VaccinationDate" />
                  @error('VaccinationDate')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">إسم التطعيمة</label>
                    <div class="col-sm-10">
                      <select class="form-control @error('VaccinationName') is-invalid @enderror" name="VaccinationName">
                        <option value="" disabled selected>اختر التطعيمة</option>

                   
                        @foreach($vaccination_namess as $amount_vaccination)
                          <option value="{{ $amount_vaccination->vaccination_name_id }}">{{ $amount_vaccination->vaccination_name }}</option>
                        @endforeach
                      </select>
                    
                      @error('VaccinationName')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    
                  </div>
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">إسم الممرضة</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control @error('NurseName') is-invalid @enderror" name="NurseName"/>
                          @error('NurseName')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>

                  <input name="HealthCenterId" value="{{(Auth::user()->id)}}"  hidden/>
                  
                  <div class="modal-footer justify-content-center" dir="rtl">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" id="add-vaccination-btn-child">إضافة التطعيمة</button>

                  </div>
      </form>  
      </div>

    </div>
  </div>
</div>


<style>
.success-message {
  background-color: green;
  color: white;
  padding: 10px;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  text-align: center;
  transition: opacity 0.5s ease-in-out;
  opacity: 1;
  z-index: 9999; /* Set a high z-index value */
}

.success-message.hidden {
  opacity: 0;
}

.form-btn-close{
  margin-right: -12.75rem !important;
}

</style>


@endsection

