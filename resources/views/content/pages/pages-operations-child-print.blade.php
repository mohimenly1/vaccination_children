@extends('layouts/contentNavbarLayout')

@section('title', 'طباعة ملف الصحي للطفل')


@section('page-script')
<script src="{{asset('assets/js/print-child.js')}}"></script>
@endsection

@section('content')
<div class="row" dir="rtl">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">الإجراءات /</span> ملف الطفل
  </h4>


  <table class="child-info">
    <thead>
        <tr>
            <th>إسم الطفل</th>
            <th>الرقم الوطني 🇱🇾</th>
            <th>تاريخ الميلاد</th>
            <th>آخر تطعيمة تم تلقيحها</th>
            <th>التطعيمة التالية المقرر تلقيحها</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $child->name_child }}</td>
            <td>{{ $child->national_number }}</td>
            <td>{{ $child->date_birth }}</td>
            <td>{{ $child->last_vaccination }}</td>
            <td>{{ $child->next_vaccination }}</td>
        </tr>
    </tbody>
</table>

<h3>تفاصيل ملف التطعيم</h3>

<table class="vaccination-info">
    <thead>
        <tr>
            <th>اسم التطعيمة</th>
            <th>تاريخ التطعيمة</th>
            <th>اسم الممرضة المسؤولة عن التطعيم</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vaccinations as $vaccination)
        <tr>
            <td>{{ $vaccination->VaccinationName }}</td>
            <td>{{ $vaccination->VaccinationDate }}</td>
            <td>{{ $vaccination->NurseName }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="input-group">
    <button onclick="printTables()" class="btn btn-primary">طباعة الملف</button>
</div>
</div>





<style>

		h3{
			font-weight: bold;
			text-align: center;
			margin: 20px 0;
		}

		table{
			width: 100%;
			border-collapse: collapse;
			margin: 20px 0;
		}

		table th,
		table td{
			padding: 10px;
			text-align: right;
			border: 1px solid #ddd;
		}

		table th{
			background-color: #f2f2f2;
			font-weight: normal;
		}

		.text-center{
			text-align: center;
		}

</style>


@endsection

