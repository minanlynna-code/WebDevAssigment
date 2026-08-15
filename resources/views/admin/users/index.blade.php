@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')

<div class="admin-page">

    <div class="admin-page-header">

        <div>
            <h1>Manage Users</h1>
            <p>Manage customer and administrator accounts.</p>
        </div>

        <a
            href="{{ route('admin.users.create') }}"
            class="admin-btn">
            + Add User
        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Role</th>

                    <th>Status</th>

                    <th width="300">Actions</th>

                </tr>

            </thead>


            <tbody>

                @forelse($users as $user)

                    <tr>

                        {{-- ID --}}
                        <td>
                            {{ $user->id }}
                        </td>


                        {{-- Name --}}
                        <td>
                            {{ $user->name }}
                        </td>


                        {{-- Email --}}
                        <td>
                            {{ $user->email }}
                        </td>


                        {{-- Phone --}}
                        <td>
                            {{ $user->phone ?? '-' }}
                        </td>


                        {{-- Role --}}
                        <td>

                            @if($user->role === 'admin')

                                <span class="badge bg-danger">
                                    Admin
                                </span>

                            @else

                                <span class="badge bg-primary">
                                    Customer
                                </span>

                            @endif

                        </td>


                        {{-- Status --}}
                        <td>

                            @if($user->is_active)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Disabled
                                </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td>

                            @if($user->id !== auth()->id())

                                {{-- Edit --}}
                                <a
                                    href="{{ route('admin.users.edit', $user) }}"
                                    class="btn btn-primary btn-sm">
                                    Edit
                                </a>


                                {{-- Enable / Disable --}}
                                <form
                                    action="{{ route('admin.users.status', $user) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    @if($user->is_active)

                                        <button
                                            type="submit"
                                            class="btn btn-warning btn-sm"
                                            onclick="return confirm('Disable this user?')">
                                            Disable
                                        </button>

                                    @else

                                        <button
                                            type="submit"
                                            class="btn btn-success btn-sm"
                                            onclick="return confirm('Enable this user?')">
                                            Enable
                                        </button>

                                    @endif

                                </form>


                                {{-- Delete --}}
                                <form
                                    action="{{ route('admin.users.destroy', $user) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this user permanently?')">
                                        Delete
                                    </button>

                                </form>

                            @else

                                <span class="text-muted">
                                    Current Account
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center">

                            No users found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection