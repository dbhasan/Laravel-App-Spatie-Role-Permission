@extends('backend/layouts')
@section('content')
    <main id="main" class="main pt-0">
        <div class="card">
            <div class="d-flex justify-content-between bg-success-subtle px-4 pt-3">
                <div class="pagetitle">
                    <h1>Edit and Update Role</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>
                </div>
                <div class="text-end pt-2">
                    <a href="{{ route('role.index') }}" class="btn btn-primary"><i class="fa-regular fa-eye"></i>
                        View
                        Role</a>
                </div>
            </div>
            <form method="post" action="{{ route('role.update', $role->id) }}" enctype="multipart/form-data"
                class="row g-3 p-3">
                @csrf
                @method('PUT')

                <div class="col-md-12 pb-3">
                    <div class=""><strong class="">{{ $role->name }}</strong></div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="15%">Module</th>
                            <th>Right</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $sl = 1; @endphp

                        @foreach ($permissions as $moduleName => $modulePermissions)
                            <tr>
                                <td>{{ $sl++ }}</td>

                                <td>{{ $moduleName }}</td>

                                <td>
                                    <div class="d-flex flex-wrap">

                                        @foreach ($modulePermissions as $permission)
                                            <div class="form-check me-3 mb-2">
                                                <input class="form-check-input" type="checkbox" id="p{{ $permission->id }}"
                                                    name="permission[]" value="{{ $permission->name }}"
                                                    @if (in_array($permission->id, $rolePermissions)) checked @endif>

                                                <label class="form-check-label" for="p{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>

    </main>
@endsection
