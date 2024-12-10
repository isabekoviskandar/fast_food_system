<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary mb-3" wire:click="create">Create</button>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Is Active</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bolims as $bolim)
                        <tr>
                            <td>{{ $bolim->id }}</td>
                            <td>{{ $bolim->name }}</td>
                            <td>{{ $bolim->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <button wire:click="delete({{ $bolim->id }})" class="btn btn-danger">Delete</button>
                            </td>
                            <td>
                                <button wire:click="edit({{ $bolim->id }})" class="btn btn-warning">Update</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create / Update Bolim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $bolimId ? 'update' : 'store' }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" wire:model="name" class="form-control">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active</label>
                            <select id="is_active" wire:model="is_active" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.addEventListener('open-create-modal', () => {
            const createModal = new bootstrap.Modal(document.getElementById('createModal'));
            createModal.show();
        });

        window.addEventListener('close-create-modal', () => {
            const createModal = new bootstrap.Modal(document.getElementById('createModal'));
            createModal.hide();
        });
    });
</script>
