@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row d-flex flex-row-reverse" dir="rtl">
  <div class="col-lg-12 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">مرحباً يا {{ Auth::user()->name }}! 🎉</h5>
            <p class="mb-4">هذه مساحتك الخاصـّة، تابع تسلسل العمليات</p>
          
            @if(auth()->user()->role == 'users_health_ministry')
            <table class="table">
              <thead>
                <tr>
                  <th>اسم المركز الصحي</th>
                  <th>عدد التطعيمات</th>
                  <th>عدد الأطفال</th>
                  <th>تقرير التطعيمات</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($report as $row)
                <tr>
                  <td>{{ $row->health_center_name }}</td>
                  <td>{{ $row->vaccinations_count }}</td>
                  <td>{{ $row->children_count }}</td>
              
                  <td>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>اسم التطعيم</th>
                          <th>العدد المتوفر</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($vaccinationReport as $vaccinationRow)
                        @if ($vaccinationRow->health_id == $row->health_id)
                        <tr>
                          <td>{{ $vaccinationRow->vaccination_name }}</td>
                          <td>{{ $vaccinationRow->vaccination_count }}</td>
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                    </table>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          @endif
          
          
          
            

          </div>
        </div>
        @if(auth()->user()->role == 'users_health_ministry')
   
        @endif

        @if(auth()->user()->role == 'parent')
        <div class="text-center">
          <form method="POST" action="{{ route('parent.children') }}">
            @csrf
          <b>إستعلم على ملفات الأبناء</b>
          <br />
          <input style="width:150px;padding-bottom: 22px;margin-bottom: 10px;padding-top: 13px;" type="text"  class="form-check-input" id="ssn" name="ssn" required />
          <button type="submit" style="background-color: rgb(190 242 100);border:none;padding:0px 10px;margin-top:10px">البحث</button>
        </form>
        </div>
        @endif
      </div>
    </div>
  </div>

  
</div>


<style>
  .box-child-count{
    height: 245px;
  }
</style>

@endsection
