@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Manage Students') }}</h1>
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
                                    <input type="search" name="keyword" id="keyword" placeholder="Keyword" class="form-control"value="{{ request()->keyword }}">
                                    <button type="submit" class="btn btn-primary mx-2" title="Search Event">
                                        <i class="fas fa-search"></i>
                                    </button> 
                                </form>
                                    
                                <a href="{{route('students.create')}}" class="btn btn-success ml-auto" title="Add Event">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>

                            <table class="table table-responsive-sm table-striped-columns table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Number</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Section</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $student->id_number }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->department }}</td>
                                        <td>{{ $student->section }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td class="d-flex justify-content-center h-100">
                                            {{-- <a href="{{ route('students.show', ['student' => $student]) }}" class="btn btn-sm btn-primary mx-1" title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a> --}}
                                            <a href="{{ route('students.edit', ['student' => $student]) }}" class="btn btn-sm btn-warning mx-1">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="{{ route('students.destroy', ['student' => $student]) }}" method="post">
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
            {{ $students->withQueryString()->links() }}
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection