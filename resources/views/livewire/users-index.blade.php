<div>
    <h2 class="fw-bold mb-3">All Users</h2>
    <div class="mt-3 d-flex justify-content-end">
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email Id</th>
            <th>Phone No.</th>
            <th>Gender</th>
            <th>Hobbies</th>
            <th>Profile Image</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_no }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ implode(', ', json_decode($user->hobbies, true)) }}</td>
                <td><div>
                        <img src="{{ $user->image_url }}" style="max-width: 150px; object-fit: cover">
                    </div>
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <button wire:click="deleteUser({{ $user->id }})" class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
