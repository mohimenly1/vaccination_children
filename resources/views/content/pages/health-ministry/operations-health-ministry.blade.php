@extends('layouts/contentNavbarLayout')

@section('title', 'العمليات')


@section('page-script')
<script src="{{asset('assets/js/operations-ministry.js')}}"></script>
@endsection

@section('content')
<div class="row" dir="rtl">


    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">الإجراءات /</span> المراكز الصحية
      </h4>
    
      <div class="card">
        <h5 class="card-header"></h5>
        <div class="table-responsive text-nowrap">

          <table class="table">
            <thead>
              <tr>
                <th>إسم المركز الصحي</th>
                <th>إسم المستخدم</th>
                <th>البريد الإلكتروني</th>
                <th>مفعل/غير مفعل</th>
                <th>الإجراءات</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($users as $user)
              <tr id="{{ $user->id }}">
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td> {{ $user->active ? 'مُفعل 🟢' : 'غير مُفعل 🔴' }}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu text-right" style="text-align:right">
                      <a class="dropdown-item" href="{{ route('edit-health-center', $user->id) }}"><i class="bx bx-edit-alt me-1"></i> تعديل</a>
                      <a class="dropdown-item" href="{{ route('add-location-health-center', $user->id) }}"><i class="bx  me-1"></i>🌍 إضافة موقع جغرافي</a>
                      @if ($user->active == 0)
                      <a class="dropdown-item" onclick="activateUser({{ $user->id }})"><i class="bx bxs-user-check me-1"></i>تفعيل</a>
                      @else
                      <a class="dropdown-item" onclick="deactivateUser({{ $user->id }})"><i class="bx bxs-user-x me-1"></i>إيقاف</a>
                      @endif
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
       Pagination Links
      </div>
    </div>

    

  
  </div>
@endsection
