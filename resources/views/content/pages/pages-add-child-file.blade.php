@extends('layouts/contentNavbarLayout')

@section('title', 'إضافة ملف للطفل')


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
          <h5 class="mb-0">إضافة ملف للطفل</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('store-child') }}" enctype="multipart/form-data" >
            @csrf
            @method('POST')
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" name="child">إسم الطفل</label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error('name_child') is-invalid @enderror" name="name_child"  />
                @error('name_child')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">صورة الطفل</label>
              <div class="col-sm-10">
                  <input type="file" class="form-control" name="image_path" accept="image/*" onchange="previewImage(event)" />
                  <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;" />
              </div>
          </div>
          
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">تاريخ الميلاد</label>
              <div class="col-sm-10">
                <input type="date" class="form-control @error('date_birth') is-invalid @enderror" name="date_birth"/>
                @error('date_birth')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">جنسية الطفل</label>
              <div class="col-sm-10">
                  <div class="form-check form-check-inline">
                      <input type="radio" value="citizen" class="form-check-input" name="child_status" id="citizenRadio" checked>
                      <label class="form-check-label mr-3" for="citizenRadio">مواطن</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input type="radio" value="foreign" class="form-check-input" name="child_status" id="foreignRadio" >
                      <label class="form-check-label" for="foreignRadio">الطفل أجنبي</label>
                  </div>
              </div>
          </div>
          
          
          <!-- Display for citizen -->
          <div id="citizenFields">
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-email">الرقم الوطني</label>
                  <div class="col-sm-10">
                      <div class="input-group input-group-merge " dir="ltr">
                          <span class="input-group-text" id="basic-default-email2">🇱🇾</span>
                          <input type="text" class="form-control text-right @error('national_number') is-invalid @enderror" name="national_number"/>
                          @error('national_number')
                          <div class="invalid-feedback text-right" dir="rtl">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-text"> يجب أن يكون من 12 رقم
                      </div>
                  </div>
              </div>
          </div>
          
          <!-- Display for foreign -->
          <div id="foreignFields" style="display: none;">
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">رقم الهوية</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" name="foreign_identity_number">
                  </div>
              </div>
          </div>


          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">رقم القيد</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ssn" id="ssn">
                <div id="parentName"></div>
            </div>
        </div>
        
          
            
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-phone">يجب تحديد هذا الخيار</label>
              <div class="col-sm-5">
                <span >ولد حديثاً</span>
                <input type="radio" value="has_birth" class="form-check-input @error('birth_status') is-invalid @enderror" name="birth_status" />
                @error('birth_status')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-5">
                <span >غير موجود</span>
                <input type="radio" value="not_birth" class="form-check-input @error('birth_status') is-invalid @enderror" name="birth_status"/>
              </div>
            </div>
            
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">أخر تطعيمة</label>
              <div class="col-sm-10">
                <input type="text"  class="form-control @error('last_vaccination') is-invalid @enderror" name="last_vaccination"  />
                @error('last_vaccination')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          

              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="next_vaccination">التطعيمة التالية</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control @error('next_vaccination') is-invalid @enderror" name="next_vaccination" id="next_vaccination" value="{{ old('next_vaccination') }}" />
                      @error('next_vaccination')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
              <div class="row justify-content-end">
                  <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">حفظ الملف</button>
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
