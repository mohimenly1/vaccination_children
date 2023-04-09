@extends('layouts/contentNavbarLayout')

@section('title', 'إضافة تطعيمه لملف الطفل')


@section('page-script')
<script src="{{asset('assets/js/add-vaccination-child.js')}}"></script>
@endsection

@section('content')
<div class="row" dir="rtl">


    <!-- form start -->
    
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">إضافة تطعيمة للطفل</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{route('vaccination-add-child')}}" >

                @csrf
                @method('POST')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-email">الرقم الوطني</label>
                    <div class="col-sm-10" id="nid-child-container">
                        <div class="input-group input-group-merge " dir="ltr">
                            <span class="input-group-text" id="basic-default-email2">🇱🇾</span>
                            <input type="text" class="form-control text-right @error('NidChild') is-invalid @enderror" name="NidChild" value="{{ old('NidChild') }}"/>
                            @error('NidChild')
                            <div class="invalid-feedback text-right" dir="rtl">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text"> يجب أن يكون من 12 رقم </div>
                   
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">تاريخ التطعيم</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('VaccinationDate') is-invalid @enderror" name="VaccinationDate" value="{{ old('VaccinationDate') }}"/>
                        @error('VaccinationDate')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        </div>

                        {{-- @foreach($vaccination_names as $amount_vaccination)
                        <p >{{ $amount_vaccination->vaccination_name }}</p>
                    
                        <p >{{ $amount_vaccination->id }}</p>
                      @endforeach
                     --}}
                    
               
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">إسم التطعيمة</label>
                          <div class="col-sm-10">
                            <select class="form-control @error('VaccinationName') is-invalid @enderror" name="VaccinationName">
                              <option value="" disabled selected>اختر التطعيمة</option>

                         
                              @foreach($vaccination_namess as $amount_vaccination)
                                <option value="{{ $amount_vaccination->vaccination_name_id }}">{{ $amount_vaccination->vaccination_name }}</option>
                              @endforeach
                            </select>
                          
                            @error('VaccinationName')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">إسم الممرضة</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('NurseName') is-invalid @enderror" name="NurseName" value="{{ old('NurseName') }}" />
                                @error('NurseName')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <input name="HealthCenterId" value="{{(Auth::user()->id)}}"  hidden/>
                        
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">اضافة التطيعمة</button>
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