<div>
    <div class="container mt-4">
        <h1 class="text-center">Food Management</h1>

        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session()->has('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @elseif (session()->has('danger'))
            <div class="alert alert-danger">{{ session('danger') }}</div>
        @endif

        <button class="btn btn-primary mb-3" wire:click="$set('openCreateModal', true)">Add Food</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($foods as $food)
                    <tr>
                        <td>{{ $food->id }}</td>
                        <td>{{ $food->category_id }}</td>
                        <td>{{ $food->name }}</td>
                        <td>
                            @if ($food->image)
                                <img src="{{ asset('storage/' . $food->image) }}" alt="Food Image" width="50" height="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $food->price }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" wire:click="edit({{ $food->id }})">Edit</button>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $food->id }})"
                                onclick="return confirm('Are you sure you want to delete this food?')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    @if ($openCreateModal)
        <div class="modal fade show d-block" style="background: rgba(0, 0, 0, 0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Food</h5>
                        <button type="button" class="btn-close" wire:click="$set('openCreateModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="create">
                            <div>
                                <label for="category_id">Category</label>
                                <select id="category_id" wire:model="category_id">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" wire:model="name" class="form-control">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" wire:model="image" class="form-control">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" id="price" wire:model="price" class="form-control">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Modal -->
    @if ($openEditModal)
        <div class="modal fade show d-block" style="background: rgba(0, 0, 0, 0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Food</h5>
                        <button type="button" class="btn-close" wire:click="$set('openEditModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="update">
                            <div class="mb-3">
                                <label for="category_id_edit" class="form-label">Category ID</label>
                                <input type="number" id="category_id_edit" wire:model="category_id" class="form-control">
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name_edit" class="form-label">Name</label>
                                <input type="text" id="name_edit" wire:model="name" class="form-control">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image_edit" class="form-label">Image</label>
                                <input type="file" id="image_edit" wire:model="image" class="form-control">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price_edit" class="form-label">Price</label>
                                <input type="number" id="price_edit" wire:model="price" class="form-control">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
