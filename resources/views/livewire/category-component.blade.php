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
            
                <div class="mb-4">
                    <input type="text" wire:model="name" placeholder="Category Name" class="form-control mb-2">
                    <input type="number" wire:model="sort" placeholder="Sort Order" class="form-control mb-2">
                    <button wire:click="create" class="btn btn-primary">Create Category</button>
                </div>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sort</th>
                            <th>Delete</th>
                            <th>Update</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
