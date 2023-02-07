@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('New Faculty') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card">

                        <form action="{{ route('faculties.index') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="employee_id">Employee ID Number</label>
                                    <input type="text" name="employee_id"
                                           class="form-control @error('employee_id') is-invalid @enderror"
                                           placeholder="{{ __('Student ID Number') }}" value="{{ old('employee_id') }}" required>
                                    @error('employee_id')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="{{ __('John Doe') }}" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="department">Department</label>
                                    <input type="text" name="department"
                                           class="form-control @error('department') is-invalid @enderror"
                                           placeholder="{{ __('Ex: CCSIT') }}" value="{{ old('department') }}" required>
                                    @error('department')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="position">Position</label>
                                    <input type="text" name="position"
                                           class="form-control @error('position') is-invalid @enderror"
                                           placeholder="{{ __('Student Year Level') }}" value="{{ old('position') }}" required>
                                    @error('position')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="number" name="contact_number"
                                           class="form-control @error('contact_number') is-invalid @enderror"
                                           placeholder="{{ __('9*********') }}" value="{{ old('contact_number') }}" required>
                                    @error('contact_number')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="{{ __('johndoe@example.com') }}" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection