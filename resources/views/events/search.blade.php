@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Manage Events') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="my-2 d-flex">
                                <form action="{{ route('events.search') }}" method="get" class="d-flex">
                                    <input type="text" name="keyword" id="keyword" placeholder="Keyword" class="form-control">
                                    <button type="submit" class="btn btn-primary mx-2" title="Search Event">
                                        <i class="fas fa-search"></i>
                                    </button> 
                                </form>
                                <a href="{{route('events.create')}}" class="btn btn-success ml-auto" title="Add Event">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <table class="table table-responsive-sm table-striped-columns table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Time Start</th>
                                        <th>Time End</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</td>
                                        <td>{{ Carbon\Carbon::parse($event->time_start)->format('H:i a') }}</td>
                                        <td>{{ Carbon\Carbon::parse($event->time_end)->format('H:i a') }}</td>
                                        <td>{{ $event->description }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="" class="btn btn-sm btn-warning mx-1">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="{{ route('events.destroy', ['event' => $event]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mx-1">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No record</td>
                                    </tr>  
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $events->withQueryString()->links() }}
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('scripts')
    @if ($message = Session::get('success'))
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

            toastr.success('{{ $message }}')
        </script>
    @endif
@endsection