@extends('backend/layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Role List</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            @can('Role.create')
                <div class="text-end pt-2">
                    <a href="{{ route('role.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                        Add Role</a>
                </div>
            @endcan
        </div>
        <hr>
        <div class="custom-scrollbar-table">
            <table id="myTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Permission</th>
                        @can('Role.edit')
                            <th class="text-end">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @if (!empty($role->getPermissionNames()))
                                    @foreach ($role->getPermissionNames() as $name)
                                        <label class="badge rounded-pill text-bg-success">{{ $name }}</label>
                                    @endforeach
                                @endif
                            </td>
                            @can('Role.edit')
                                <td class="d-flex justify-content-end">
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary mx-1"><i
                                            class="bi bi-pencil-square"></i></a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
