@extends('layouts/contentNavbarLayout')

@section('title', 'إضافة مركز صحي')


@section('page-script')
<script src="{{asset('assets/js/add-vaccination-child.js')}}"></script>
@endsection

@section('content')
<div class="row" dir="rtl">


  <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">إضافة مركز صحي جديد 🩺</h5>
        </div>
        <div class="card-body">
          <form method="POST"  action="{{ route('health-center-store') }}">
            @csrf
            @method('POST')
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" name="name">إسم المركز الصحي</label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  />
                @error('name')
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
                      <button type="submit" class="btn btn-primary">أضف مركز صحي</button>
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
