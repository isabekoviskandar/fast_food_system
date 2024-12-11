<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <button class="btn btn-primary mb-3" wire:click="resetFields">Create Jurnal</button>
            {{-- @dd($hodims[0]) --}}
            @if ($isFormVisible)
                @if ($isEditing)
                    <form wire:submit.prevent="update">
                @else
                    <form wire:submit.prevent="create">
                @endif
                    <div class="mb-3">
                        <label for="hodim_id">Employment</label>
                        <select id="hodim_id" class="form-control" wire:model="hodim_id">
                            <option value="">Select Employment</option>
                            @foreach ($hodims as $hodim)
                                <option value="{{ $hodim->section }}"></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_id">User</label>
                        <select id="user_id" class="form-control" wire:model="user_id">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date">Date</label>
                        <input type="date" id="date" class="form-control" wire:model="date">
                    </div>
                    <div class="mb-3">
                        <label for="start_time">Start Time</label>
                        <input type="time" id="start_time" class="form-control" wire:model="start_time">
                    </div>
                    <div class="mb-3">
                        <label for="end_time">End Time</label>
                        <input type="time" id="end_time" class="form-control" wire:model="end_time">
                    </div>
                    <button class="btn btn-success" type="submit">
                        {{ $isEditing ? 'Update' : 'Create' }}
                    </button>
                    <button class="btn btn-secondary" type="button" wire:click="closeForm">Cancel</button>
                </form>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Employment</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd(123) --}}
                    @foreach ($jurnals as $jurnal)
                        <tr>
                            {{-- @dd($jurnals) --}}
                            <td>{{ $jurnal->hodim_id }}</td>
                            <td>{{ $jurnal->user->name }}</td>
                            <td>{{ $jurnal->date }}</td>
                            <td>{{ $jurnal->start_time }}</td>
                            <td>{{ $jurnal->end_time }}</td>
                            <td>{{ intdiv($jurnal->time, 60) }} hours {{ $jurnal->time % 60 }} minutes</td>

                            <td>
                                <button class="btn btn-info" wire:click="edit({{ $jurnal->id }})">Edit</button>
                                <button class="btn btn-danger" wire:click="delete({{ $jurnal->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $jurnals->links() }} --}}
        </div>
    </div>
</div>
