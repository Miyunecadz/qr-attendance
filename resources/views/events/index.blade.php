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
                            <div class="my-2 d-flex">
                                <form action="" type="get" class="d-flex">
                                    <input type="search" name="keyword" id="keyword" placeholder="Keyword" class="form-control">
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
                                            <a href="{{ route('events.show', ['event' => $event]) }}" class="btn btn-sm btn-primary mx-1" title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('events.edit', ['event' => $event]) }}" class="btn btn-sm btn-warning mx-1">
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