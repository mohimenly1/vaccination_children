@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

@endphp


<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">

  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            @include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])
          </span>
          <span class="app-brand-text demo menu-text fw-bolder">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
<!-- Notification -->
<div class="dropdown position-relative">
  <a class="menu-icon tf-icons bx bxs-bell-ring" id="notification-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill notification-badge">{{ auth()->user()->unreadNotifications->count() }}<span class="visually-hidden">unread messages</span></span>
  </a>


  <ul style="height: 200px; overflow-y: auto;" class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notification-dropdown-toggle text-center">
    @if (auth()->user()->unreadNotifications->count() > 0)
        @foreach(auth()->user()->unreadNotifications as $notification)
            <li><a class="dropdown-item notification-link fw-bold text-center" href="#" data-notification-id="{{ $notification->id }}">
                {{ isset($notification->data['vaccination_name']) ? $notification->data['vaccination_name'] : '' }} - 
                {{ isset($notification->data['work_day_vaccination']) ? $notification->data['work_day_vaccination'] : '' }} - 
                {{ isset($notification->data['health_center']) ? $notification->data['health_center'] : '' }} - 
                {{ isset($notification->data['avaliable_vaccination']) ? $notification->data['avaliable_vaccination'] : '' }} -
                {{ isset($notification->data['vaccination_count']) ? $notification->data['vaccination_count'] : '' }} -
                {{ isset($notification->data['vaccination_name_info']) ? $notification->data['vaccination_name_info'] : '' }} -
                {{ isset($notification->data['benefit_vaccination_info']) ? $notification->data['benefit_vaccination_info'] : '' }} -
                {{ isset($notification->data['complications_vaccination_info']) ? $notification->data['complications_vaccination_info'] : '' }}
            </a></li>
        @endforeach
    @else
        <li class="fw-bold text-center">😞لا يوجد إشعارات جديدة</li>
    @endif
    @foreach(auth()->user()->readNotifications as $notification)
        <li><a class="dropdown-item notification-link text-muted text-center" href="#" data-notification-id="{{ $notification->id }}">
            {{ isset($notification->data['vaccination_name']) ? $notification->data['vaccination_name'] : '' }} - 
            {{ isset($notification->data['work_day_vaccination']) ? $notification->data['work_day_vaccination'] : '' }} - 
            {{ isset($notification->data['health_center']) ? $notification->data['health_center'] : '' }} - 
            {{ isset($notification->data['avaliable_vaccination']) ? $notification->data['avaliable_vaccination'] : '' }} -
            {{ isset($notification->data['vaccination_count'])  ? $notification->data['vaccination_count'] : '' }} -
            {{ isset($notification->data['vaccination_name_info']) ? $notification->data['vaccination_name_info'] : '' }} -
            {{ isset($notification->data['benefit_vaccination_info']) ? $notification->data['benefit_vaccination_info'] : '' }} -
            {{ isset($notification->data['complications_vaccination_info']) ? $notification->data['complications_vaccination_info'] : '' }}
        </a></li>
    @endforeach
</ul>

  

  
</div>
<!-- /Notification -->

<div class="flex-row align-items-center ms-auto">
  @if(Auth::check() && Auth::user()->role == 'users_health_center')
    <div class="dropdown">
      <div class="heart-icon-container" id="vaccinationNamesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i style="font-size: 40px; color:rgb(113, 211, 113)" class="menu-icon tf-icons bx bxs-check-shield pulsate"></i>
        <div class="note">
          <div class="note-content">
            <button class="close-button">×</button>
            <p>إطلع على تحديثات التطعيم الخاصّة بك</p>
          </div>
        </div>
      </div>
      <ul style="text-align: right" class="dropdown-menu" aria-labelledby="vaccinationNamesDropdown">
        @foreach($vaccination_data as $vaccination)
        <li><a class="dropdown-item text-right" href="#">{{ $vaccination->vaccination_name }} ({{ $vaccination->vaccination_count }})</a></li>
        @endforeach
      </ul>
    </div>
  @endif
</div>



        <style>

.heart-icon-container {
  position: relative;
  animation-name: pulse;
  animation-duration: 1s;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.2);
  }
  100% {
    transform: scale(1);
  }
}

.note {
  display: none;
  position: absolute;
  top: -20px;
  right: 50%;
  transform: translateX(5%);
  padding: 10px;
  background-color: #fff;
  box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.15);
  border-radius: 5px;
  z-index: 1;
  width: 200px;
  text-align: center;
}


.note::before {
  content: "";
  position: absolute;
  top: 100%;
  right: 10px;
  border-style: solid;
  border-width: 10px 10px 0 10px;
  border-color: #fff transparent transparent transparent;
}

.note.show {
  display: block;
  animation-name: fade-in;
  animation-duration: 0.5s;
}

@keyframes fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.note .note-content {
  position: relative;
}

.note p {
  margin: 0;
  font-size: 14px;
}

.close-button {
  position: absolute;
top: -14px;
right: -7px;
border: none;
background-color: transparent;
  cursor: pointer;
}


        </style>

        <script>
const heartIcon = document.querySelector('.heart-icon-container');
const note = heartIcon.querySelector('.note');
const closeButton = note.querySelector('.close-button');

function showNote() {
  note.classList.add('show');
}

function hideNote() {
  note.classList.remove('show');
}

closeButton.addEventListener('click', hideNote);

setTimeout(() => {
  showNote();
}, 1000);


        </script>





        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <!-- Place this tag where you want the button to render. -->
     
          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                @if(Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt class="w-px-30 h-auto rounded">
                @else
                <img src="{{ asset('assets/img/avatars/avatar.png') }}" alt class="w-px-30 h-auto rounded-circle">
                @endif
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        @if(Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt class="w-px-40 h-auto rounded-circle">
                        @else
                        <img src="{{ asset('assets/img/avatars/avatar.png') }}" alt class="w-px-40 h-auto rounded-circle">
                        @endif
                      </div>
                    </div>
                    <div class="flex-grow-1" onclick="window.location.href='{{ route('pages-account-settings-account') }}';">
                      <span class="fw-semibold d-block">
                        @if (Auth::check())
                        {{Auth::user()->name}}
                        @endif
                      </span>
                      <small class="text-muted">Admin</small>
                    </div>
                    
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a 
                href="{{ route('pages-account-settings-account') }}"
                class="dropdown-item" href="javascript:void(0);">
                  <i class="bx bx-user me-2"></i>
                  <span class="align-middle">الملف الشخصي</span>
                </a>
              </li>
    
              {{-- <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 bx bx-credit-card me-2 pe-1"></i>
                    <span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                  </span>
                </a>
              </li> --}}
              <li>
                <div class="dropdown-divider"></div>
              </li>
              @auth
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">
                    <i class='bx bx-power-off me-2'></i>
                    <span class="align-middle">{{ __('تسجيل الخروج') }}</span>
                  </button>
                </form>
              </li>
              @endauth
              
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
