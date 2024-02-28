@extends('layouts/contentNavbarLayout')

@section('title', 'إضافة معلومات عامّة')


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
            <h5 class="mb-0">إضافة معلومات عامّة عن فوائد ومضاعفات التطعيمة</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{route('send-notify-info-health-center')}}">
                @csrf
                @method('POST')
                        
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">إسم التطعيمة</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="vaccination_name_info" />
                    </div>
                </div>
                        
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">فوائد التطعيمة</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="benefit_vaccination_info" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">مضاعفات التطعيمة</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="complications_vaccination_info" />
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
