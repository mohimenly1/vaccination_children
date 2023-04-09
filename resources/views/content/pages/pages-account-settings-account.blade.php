@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">الإعدادات /</span> الملف الشخصي
</h4>

<div class="row" dir="rtl">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> الحساب</a></li>
      {{-- <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-notifications')}}"><i class="bx bx-bell me-1"></i> الإشعارات</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="bx bx-link-alt me-1"></i> Connections</a></li> --}}
    </ul>
    <div class="card mb-4">
      <h5 class="card-header">تفاصيل الملف الشخصي</h5>
      <!-- Account -->
      <form id="formAccountSettings" method="POST" action="{{ route('ok') }}" enctype="multipart/form-data">
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
            @if(Auth::user()->image)
            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />

            @else
                <img src="{{asset('assets/img/avatars/avatar.png')}}" alt="default-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            @endif
            <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">رفع صورة جديدة</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input  type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" name="image"/>
                </label>
                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">إعادة الوضع كما كان</span>
                </button>
                <p class="text-muted mb-0">المسموح به JPG, GIF or PNG. Max size of 800K</p>
            </div>
        </div>
    </div>
    
      <hr class="my-0">
      <div class="card-body">
       
          @csrf
          @method('POST')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">الإسم</label>
              <input class="form-control" type="text" id="name" name="firstName" value="{{ Auth::user()->name }}" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">الإيميل</label>
              <input class="form-control" type="text" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="john.doe@example.com" />
              </div>
              </div>
              <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">حفظ</button>
              <button type="reset" class="btn btn-outline-secondary">إعادة الوضع كما كان</button>
              </div>
              </form>
              {{-- @if(session('myVariable'))
              <p>My Variable: {{ session('myVariable') }}</p>
          @endif --}}
          
              
      </div>
      <!-- /Account -->
    </div>

  </div>
</div>
@endsection
