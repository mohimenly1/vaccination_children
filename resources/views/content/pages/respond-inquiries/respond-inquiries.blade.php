@extends('layouts/contentNavbarLayout')

@section('title', 'الرد على الإستفسارات')

@section('page-script')
  <script src="{{ asset('assets/js/respond-inquiries.js') }}"></script>
@endsection

@section('content')
  <div class="row" dir="rtl">
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">الإستفسارات</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>رقم الاستفسار</th>
                            <th>نوع الاستفسار</th>
                            <th>نص الاستفسار</th>
                            <th>حالة الاستفسار</th>
                            <th>الرد</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inquiries as $inquiry)
                            <tr id="inquiry-{{ $inquiry->id }}">
                                <td>{{ $inquiry->id }}</td>
                                <td>{{ $inquiry->FeedBackType }}</td>
                                <td>{{ $inquiry->FeedBackText }}</td>
                                <td>{{ $inquiry->FeedBackState }}</td>
                                <td>
                                    @if ($inquiry->FeedBackState === 'تم الرد')
                                        {{ $inquiry->FeedBackReply }}
                                    @else
                                        <form action="{{ route('respond-inquiries.update', $inquiry->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="FeedBackReply">الرد</label>
                                                <textarea class="form-control  @error('FeedBackReply') is-invalid @enderror" id="FeedBackReply" name="FeedBackReply" rows="3" ></textarea>
                                                @error('FeedBackReply')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                              @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">إرسال الرد</button>
                                        </form>
                                        @if (session('success') && session('inquiry_id') === $inquiry->id)
                                            @if (session('feedback_reply') && session('inquiry_id') === $inquiry->id)
                                                <div class="mt-3"><strong>الرد:</strong> {{ session('feedback_reply') }}</div>
                                            @endif
                                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                            <div class="mt-3"><strong>الرد:</strong> {{ session('FeedBackReply') }}</div>
                                            <div class="mt-3"><strong>الرد:</strong> {{ $inquiry->FeedBackReply }}</div> <!-- Display the updated reply -->
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $inquiries->links() }}
            </div>
        </div>
      </div>        
      </div>
    </div>
  </div>
@endsection
