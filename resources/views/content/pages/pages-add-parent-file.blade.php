@extends('layouts/contentNavbarLayout')

@section('title', 'إضافة ملف للطفل')


@section('page-script')
{{-- <script src="{{asset('assets/js/add-child.js')}}"></script> --}}
@endsection

@section('content')
<div class="row" dir="rtl">


  <!-- form start -->
  
  <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">إضافة ملف ولي الأمر</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('store-parent') }}"  >
            @csrf
            @method('POST')
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" name="name">إسم الأب</label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  />
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" name="address">العنوان</label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"  />
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

          
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">تاريخ الميلاد</label>
              <div class="col-sm-10">
                <input type="date" class="form-control @error('birth_date_parent') is-invalid @enderror" name="birth_date_parent"/>
                @error('birth_date_parent')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
                {{-- National Number Parent HERE: --}}
              <label class="col-sm-2 col-form-label" for="basic-default-email">الرقم الوطني</label>
              <div class="col-sm-10">
                <div class="input-group input-group-merge " dir="ltr">
                  <span class="input-group-text" id="basic-default-email2">🇱🇾</span>
                  <input type="text" class="form-control text-right @error('national_number_parent') is-invalid @enderror" name="national_number_parent"/>
                  @error('national_number_parent')
                  <div class="invalid-feedback text-right" dir="rtl">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-text"> يجب أن يكون من 12 رقم 

                  
                </div>
           
              </div>
            </div>
            <div class="row mb-3">
                {{-- SSN HERE: --}}
              <label class="col-sm-2 col-form-label" for="basic-default-email">رقم ورقة العائلة</label>
              <div class="col-sm-10">
                <div class="input-group input-group-merge " dir="ltr">
                  <span class="input-group-text" id="basic-default-email2">🇱🇾</span>
                  <input type="text" class="form-control text-right @error('ssn') is-invalid @enderror" name="ssn"/>
                  @error('ssn')
                  <div class="invalid-feedback text-right" dir="rtl">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-text"> يجب أن يكون من 5 رقم 

                  
                </div>
           
              </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">رقم الهاتف</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"/>
                  @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">البريد الإلكتروني</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"/>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">إسم المستخدم</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"/>
                  @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">كلمة المرور</label>
                <div class="col-sm-10">
                  <input type="text"  class="form-control @error('password') is-invalid @enderror" name="password"  />
                  @error('password')
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
