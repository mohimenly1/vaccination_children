@extends('layouts/contentNavbarLayout')

@section('title', 'اضافة إعلان')


@section('page-script')
<script src="{{asset('assets/js/open-modal-vaccination.js')}}"></script>
@endsection

@section('content')
<div class="row" dir="rtl">


    <!-- form start -->
    
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">اضافة إعلان عن توفر تطعيمة في مركز صحي</h5>
            <span id="folder_add_vaccination" onclick="openModal()">
              <i class='bx bxs-folder-plus' style="font-size:30px;color:rgb(136, 212, 136); cursor:pointer"></i>
            </span>
          </div>
  
          <div class="card-body">
            <form method="POST" action="{{ route('send-notify-health-center') }}">
              @csrf
              @method('POST')
                                           
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">المركز الصحي المتوفر به</label>
                  <div class="col-sm-10">
                      <select name="health_center" id="health_center" class="form-control">
                          <option value="">-- إختر المركز الصحي --</option>
                          @foreach ($health_centers as $health_center)
                              <option value="{{ $health_center->id }}">{{ $health_center->name }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
                                              
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">التطعيمة المتوفرة</label>
                  <div class="col-sm-10">
                      <select name="available_vaccination" id="available_vaccination" class="form-control">
                          <option value="">-- اختر التطعيمة --</option>
                          @foreach ($vaccinationName as $vaccination)
                              <option value="{{ $vaccination->id }}">{{ $vaccination->vaccination_name }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">الكمية المتوفرة</label>
                  <div class="col-sm-10">
                      <input type="number" class="form-control" name="vaccination_count" />
                  </div>
              </div>
                                              
              <div class="row justify-content-end">
                  <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">أرسل الإشعار</button>
                  </div>
              </div>
            </form>
            
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
            
                              
          </div>
        </div>
      </div>
    <!--/ form end -->
  
  </div>
  
  </div>





  {{-- Modal --}}

  <div class="modal fade" id="open-vaccination" tabindex="-1" aria-labelledby="open-vaccination-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" dir="rtl">
        <div class="modal-header">
          <h5 class="modal-title" id="open-vaccination-label">إضافة تطعيمة</h5>
          <button type="button" class="btn-close form-btn-close close-ok" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" dir="rtl">
          <form id="add-vaccination-form" method="POST" action="{{route('send-vacc-to-amount')}}" >
            @csrf
            @method('POST')

 
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">إسم التطعيمة</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('VaccinationName') is-invalid @enderror" name="VaccinationName"  />
                            @error('VaccinationName')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

  
                
                    
                    <div class="modal-footer justify-content-center" dir="rtl">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                      <button type="submit" class="btn btn-primary" >إضافة التطعيمة</button>
  
                    </div>
        </form>  
        </div>
  
      </div>
    </div>
  </div>

  <style>
    .close-ok{
      margin-top: -1.25rem !important;

      margin-right: -122px !important;
    }
  </style>

  {{-- End Modal --}}
@endsection
