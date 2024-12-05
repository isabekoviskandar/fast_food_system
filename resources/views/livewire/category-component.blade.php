<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
            
                <button wire:click="$set('openCreateModal', true)" class="btn btn-primary mb-3">Create Category</button>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sort</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->sort }}</td>
                                <td>
                                    <button wire:click="delete({{ $category->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                                <td>
                                    <button wire:click="edit({{ $category->id }})" class="btn btn-primary btn-sm">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    @if($openCreateModal)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Category</h5>
                        <button type="button" class="btn-close" wire:click="$set('openCreateModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" wire:model="name" placeholder="Category Name" class="form-control mb-2">
                        <input type="number" wire:model="sort" placeholder="Sort Order" class="form-control mb-2">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('openCreateModal', false)">Cancel</button>
                        <button class="btn btn-primary" wire:click="create">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Modal -->
    @if($openEditModal)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="btn-close" wire:click="$set('openEditModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" wire:model="name" placeholder="Category Name" class="form-control mb-2">
                        <input type="number" wire:model="sort" placeholder="Sort Order" class="form-control mb-2">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('openEditModal', false)">Cancel</button>
                        <button class="btn btn-primary" wire:click="update">Update</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
