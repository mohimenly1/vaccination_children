@extends('layouts/contentNavbarLayout')

@section('title', 'تعديل بيانات المركز الصحي')


@section('page-script')
{{-- <script src="{{asset('assets/js/add-vaccination-child.js')}}"></script> --}}
@endsection

@section('content')
<div class="row" dir="rtl">


    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">تعديل بيانات المركز الصحي</h5>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('update-health-center', $user->id) }}">
                  @csrf
                  @method('POST')
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" name="child">إسم المركز الصحي</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" />
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">إسم المستخدم</label>
                  <div class="col-sm-10">
                    <input type="text"  class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" />
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">البريد الإلكتروني</label>
                  <div class="col-sm-10">
                    <input type="text"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" />
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  </div>
                </div>
    
                  <div class="row justify-content-end">
                      <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">تعديل البيانات</button>
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
