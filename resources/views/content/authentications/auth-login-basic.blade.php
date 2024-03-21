@extends('layouts/blankLayout')

@section('title', 'تسجيل الدخول')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl bg-auth">
  <div class="authentication-wrapper authentication-basic container-p-y text-end" dir="auto">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <img style="width:100px;height:100px;" src="/assets/img/icons/logo/injection.gif" />
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">مرحباً  👋! </h4>
          <p class="mb-4">من فضلك سجل دخولك للبدء بجولتك</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST" dir="auto">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني او إسم المستخدم</label>
                <input type="text" class="form-control" id="email" name="email-username" placeholder="بإمكانك الدخول بالبريدالإلكتروني او بإسم مُعرّفك" autofocus dir="auto">
                @error('email-username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">كلمة المرور</label>
                    <a href="{{url('auth/forgot-password-basic')}}">
                        <small>نسيت كلمة المرور ؟</small>
                    </a>
                </div>
                <div class="input-group input-group-merge" dir="ltr">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" dir="auto" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me">
                    <label class="form-check-label" for="remember-me">
                        تذكرني
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">تسجيل الدخول</button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
        
          
    
          {{-- <p class="text-center">
            <span>جديد على منصتنا؟</span>
            <a href="{{url('auth/register-basic')}}" dir="rtl">أنشئ حسابًا</a>
          </p> --}}

        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
</div>

<style>
  .bg-auth{
    background-color: #00224D;
  }
</style>
@endsection
