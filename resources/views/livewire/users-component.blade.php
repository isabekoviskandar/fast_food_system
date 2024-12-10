<div>
  <div class="container mt-5">
      <!-- Success message -->
      @if (session()->has('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
      @endif

      <!-- Buttons to create new user -->
      <div class="row mb-4">
          <div class="col-12">
              <button wire:click="create" class="btn btn-primary">Create User</button>
          </div>
      </div>

      <!-- Create or Update Form (visible when showCreateForm is true) -->
      @if($showCreateForm)
      <div class="row mb-4">
          <div class="col-12">
              @if($isUpdateMode)
                  <h3>Update User</h3>
              @else
                  <h3>Create User</h3>
              @endif
              <form wire:submit.prevent="{{ $isUpdateMode ? 'update' : 'store' }}">
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" wire:model="name" class="form-control" id="name" required>
                  </div>
                  <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" wire:model="phone" class="form-control" id="phone" required>
                  </div>
                  <div class="form-group">
                      <label for="role">Role</label>
                      <input type="text" wire:model="role" class="form-control" id="role" required>
                  </div>
                  <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" wire:model="image" class="form-control" id="image">
                      @if ($image)
                          <div class="mt-2">
                              <img src="{{ $image->temporaryUrl() }}" width="100" alt="Preview">
                          </div>
                      @endif
                  </div>
                  <!-- Password Input Field -->
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" wire:model="password" class="form-control" id="password" required>
                  </div>
                  <button type="submit" class="btn btn-success">
                      {{ $isUpdateMode ? 'Update' : 'Create' }}
                  </button>
              </form>
          </div>
      </div>
      @endif

      @if(!$showCreateForm)
      <div class="row">
          <div class="col-12">
              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Name</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Role</th>
                          <th scope="col">Image</th>
                          <th scope="col">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                      <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->phone }}</td>
                          <td>{{ $user->role }}</td>
                          <td>
                              @if ($user->image)
                                  <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" width="50">
                              @else
                                  No Image
                              @endif
                          </td>
                          <td>
                              <button wire:click="edit({{ $user->id }})" class="btn btn-warning btn-sm">Edit</button>
                              <button wire:click="delete({{ $user->id }})" class="btn btn-danger btn-sm">Delete</button>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
      @endif
  </div>
</div>
