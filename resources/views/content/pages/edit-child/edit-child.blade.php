@extends('layouts/contentNavbarLayout')

@section('title', 'تعديل ملف الطفل')


@section('page-script')
<script src="{{asset('assets/js/add-child.js')}}"></script>
@endsection

@section('content')
<div class="row" dir="rtl">


    <!-- form start -->
    
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">تعديل ملف الطفل</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('children.update', $child->id) }}" >
                @csrf
                @method('POST')
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" name="child">إسم الطفل</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('name_child') is-invalid @enderror" name="name_child" value="{{ $child->name_child }}" />
                  @error('name_child')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">تاريخ الميلاد</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control @error('date_birth') is-invalid @enderror" name="date_birth" value="{{ $child->date_birth }}"/>
                  @error('date_birth')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-email">الرقم الوطني</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge " dir="ltr">
                    <span class="input-group-text" id="basic-default-email2">🇱🇾</span>
                    <input type="text" class="form-control text-right @error('national_number') is-invalid @enderror" name="national_number" value="{{ $child->national_number }}"/>
                    @error('national_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                  <div class="form-text"> يجب أن يكون من 12 رقم 
  
                    
                  </div>
             
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">يجب تحديد هذا الخيار</label>
                <div class="col-sm-5">
                  <span class="note">ولد حديثاً</span>
                  <input type="radio" value="has_birth" class="form-check-input @error('birth_status') is-invalid @enderror" name="birth_status" />
                  @error('birth_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-sm-5">
                  <span class="note">غير موجود</span>
                  <input type="radio" value="not_birth" class="form-check-input @error('birth_status') is-invalid @enderror" name="birth_status"/>
                </div>
              </div>
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">أخر تطعيمة</label>
                <div class="col-sm-10">
                  <input type="text"  class="form-control @error('last_vaccination') is-invalid @enderror" name="last_vaccination" value="{{ $child->last_vaccination }}" />
                  @error('last_vaccination')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
              </div>
            
  
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="next_vaccination">التطعيمة التالية</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('next_vaccination') is-invalid @enderror" name="next_vaccination" id="next_vaccination" value="{{ $child->next_vaccination }}" />
                        @error('next_vaccination')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">تعديل الملف</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    <!--/ form end -->
  
  </div>
  
  </div>


@endsection
