@extends('layouts/contentNavbarLayout')

@section('title', 'اضافة معلومات التطعيمة')


@section('page-script')
{{-- <script src="{{asset('assets/js/add-vaccination-child.js')}}"></script> --}}
@endsection

@section('content')
<div class="row" dir="rtl">


    <!-- form start -->
    
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">اضافة معلومات عن التطعيمه</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('submit-form-notification') }}" >
              @csrf
              @method('POST')
            
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">إسم التطعيمة</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control @error('vaccination_name') is-invalid @enderror" name="vaccination_name" value="{{ old('vaccination_name') }}"/>
                      @error('vaccination_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
            
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">ايام العمل على التطعيمة</label>
                  <div class="col-sm-10">
                      <input type="date" class="form-control @error('work_day_vaccination') is-invalid @enderror" name="work_day_vaccination" value="{{ old('work_day_vaccination') }}" />
                      @error('work_day_vaccination')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
            
              <div class="row justify-content-end">
                  <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">أرسل الإشعار</button>
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
