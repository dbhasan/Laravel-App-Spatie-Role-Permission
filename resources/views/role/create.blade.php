@extends('backend/layouts')
@section('content')
    <main id="main" class="main pt-0">
        <div class="card">
            <div class="d-flex justify-content-between bg-success-subtle px-4 pt-3">
                <div class="pagetitle">
                    <h1>New Role Create</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="text-end pt-2">
                    <a href="{{ route('role.index') }}" class="btn btn-primary"><i class="fa-regular fa-eye"></i>
                        View
                        Role</a>
                </div>
            </div>
            <form method="post" action="{{ route('role.store') }}" enctype="multipart/form-data" class="row g-3 p-3">
                @csrf

                <div class="col-md-6 pb-3">
                    <label for="name" class="form-label">Role Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>

    </main>
@endsection
