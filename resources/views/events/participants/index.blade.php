@extends('layouts.app')

@section('content')
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Manage Participants') }}</h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="my-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-danger mx-1" title="Remove Participants">
                                        <i class="fas fa-users-slash"></i>
                                    </button>

                                    @if(auth()->user()->isAdmin())
                                        <a href="{{route('event-participants.create', ['event' => request()->event])}}" class="btn btn-success mx-1" title="Add Participant">
                                            <i class="fas fa-user-plus"></i>
                                        </a>
                                    @endif
                                </div>

                                <table class="table table-responsive-sm table-striped-columns table-bordered table-hover" id="participants_table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID Number</th>
                                            <th>Participant Name</th>
                                            <th>Participant Type</th>
                                            <th>Department</th>
                                            <th>Logged In</th>
                                            <th>Logged Out</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($participants as $participant)
                                        <tr>
                                            <td><input type="checkbox" name="participants[]" id="participants" value="{{ $participant->id }}"></td>
                                            <td>{{ $participant->getParticipantIdNumber() }}</td>
                                            <td>{{ $participant->getParticipantName() }}</td>
                                            <td>{{ $participant->getPrettyUserType() }}</td>
                                            <td>{{ Str::upper($participant->getParticipantDepartment()) }}</td>
                                            <td>{{ $participant->time_in }}</td>
                                            <td>{{ $participant->time_out }}</td>
                                            <td>{{ $participant->getPrettyStatus() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready( function () {
        $('#participants_table').DataTable();
    } );
</script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('scripts')
    @if($message = Session::get('error'))
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr.error('{{ $message }}')
        </script>
    @enderror
@endsection