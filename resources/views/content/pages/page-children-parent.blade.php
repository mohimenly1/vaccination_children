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
            <th>صورة الطفل</th>
            <th>إسم الأب</th>
            <th>البريد الإلكتروني للأب</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($children as $child)
        <tr>
            <td>{{ $child->name_child }}</td>
            <td>{{ $child->national_number ? $child->national_number : 'أجنبي' }}</td>

            <td>{{ $child->date_birth }}</td>
            <td>{{ $child->last_vaccination }}</td>
            <td>{{ $child->next_vaccination }}</td>
            <td>
                <img style="width:100px;height:100px;" src="{{ asset('storage/child_images/' . basename($child->image_path)) }}" />
            </td>
            <td>{{ $child->parent->name }}</td>
            <td>{{ $child->parent->email }}</td>
            <!-- Add more columns for parent information as needed -->
        </tr>
    @endforeach
    </tbody>
</table>

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

