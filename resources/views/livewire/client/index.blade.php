<div>
    <h2 class="fw-bold mb-3">All Clients</h2>
    <div class="mt-3 d-flex justify-content-end">
        <a href="{{ route('client.create') }}" class="btn btn-primary mb-3">Create Client</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email Id</th>
            <th>Phone No.</th>
            <th>Primary Goal</th>
            <th>Company Name</th>
            <th>Team Size</th>
            <th>Feedback</th>
            <th>Discovery Method</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone_no }}</td>
                <td>{{ $client->primary_goal }}</td>
                <td>{{ $client->company_name }}</td>
                <td>{{ $client->team_size }}</td>
                <td>{{ $client->feedback }}</td>
                <td>{{ $client->discovery_method }}</td>
                <td>
                    <a href="{{ route('client.edit', $client->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <button wire:click="deleteClient({{ $client->id }})" class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
