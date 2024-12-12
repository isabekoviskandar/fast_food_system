<div>
  <div class="container mt-5">
      <div class="mb-4">
          <button wire:click="$set('isCreateMode', true)" class="btn btn-success">Create Hodim</button>
      </div>
      @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('errors'))
        <div class="alert alert-danger">
            <ul>
                @foreach(session('errors') as $field => $errors)
                    @foreach($errors as $error)
                        <li>{{ $field }}: {{ $error }}</li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    @endif
      @if($isCreateMode)
      <div class="row mb-4">
          <div class="col-12">
              <form wire:submit.prevent="store">
                <div class="form-group">
                  <label for="bolim_id">Section</label>
                  <select wire:model="bolim_id" class="form-control" id="bolim_id" required>
                      <option value="">Select Bolim</option>
                      @foreach ($bolims as $bolim)
                          <option value="{{ $bolim->id }}">{{ $bolim->name }}</option>
                      @endforeach
                  </select>
                  <select wire:model="user_id" class="form-control mt-3" id="user_id" required>
                    <option value="">Select User</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                    <label for="oylik_type">Oylik Type</label>
                    <select wire:model="oylik_type" class="form-control" id="oylik_type" required>
                        <option value="">Select Oylik Type</option>
                        <option value="oylik">Oylik</option>
                        <option value="kpi">KPI</option>
                    </select>
                </div>
                  <div class="form-group">
                      <label for="oylik_miqdori">Oylik Miqdori</label>
                      <input type="number" wire:model="oylik_miqdori" class="form-control" id="oylik_miqdori" required>
                  </div>
                  <div class="form-group">
                      <label for="bonus">Bonus</label>
                      <input type="number" wire:model="bonus" class="form-control" id="bonus" required>
                  </div>
                  <div class="form-group">
                      <label for="oylik_time">Oylik Time</label>
                      <input type="text" wire:model="oylik_time" class="form-control" id="oylik_time" required>
                  </div>
                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="datetime-local" wire:model="start_time" class="form-control" id="start_time" required>
                    </div>
                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="datetime-local" wire:model="end_time" class="form-control" id="end_time" required>
                </div>
                  {{-- <div class="form-group">
                      <label for="time">Time</label>
                      <input type="number" wire:model="time" class="form-control" id="time" required>
                  </div> --}}

                  <button type="submit" class="btn btn-primary">Employee Create</button>
                  <button type="button" wire:click="$set('isCreateMode', false)" class="btn btn-secondary">Cancel</button>
              </form>
          </div>
      </div>
      @elseif($isEditMode)
      <!-- Edit Form -->
      <div class="row mb-4">
          <div class="col-12">
              <form wire:submit.prevent="update">
                <div class="form-group">
                  <label for="bolim_id">Section</label>
                  <select wire:model="bolim_id" class="form-control" id="bolim_id" required>
                      <option value="">Select Bolim</option>
                      @foreach ($bolims as $bolim)
                          <option value="{{ $bolim->id }}">{{ $bolim->name }}</option>
                      @endforeach
                  </select>
                  <select wire:model="user_id" class="form-control mt-3" id="user_id" required>
                    <option value="">Select User</option>
                    @foreach ($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                    <label for="oylik_type">Oylik Type</label>
                    <select wire:model="oylik_type" class="form-control" id="oylik_type" required>
                        <option value="">Select Oylik Type</option>
                        <option value="oylik">Oylik</option>
                        <option value="kpi">KPI</option>
                    </select>
                </div>
                
                  <div class="form-group">
                      <label for="oylik_miqdori">Oylik Miqdori</label>
                      <input type="number" wire:model="oylik_miqdori" class="form-control" id="oylik_miqdori" required>
                  </div>
                  <div class="form-group">
                      <label for="bonus">Bonus</label>
                      <input type="number" wire:model="bonus" class="form-control" id="bonus" required>
                  </div>
                  <div class="form-group">
                      <label for="oylik_time">Oylik Time</label>
                      <input type="text" wire:model="oylik_time" class="form-control" id="oylik_time" required>
                  </div>
                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="datetime-local" wire:model="start_time" class="form-control" id="start_time" required>
                    </div>
                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="datetime-local" wire:model="end_time" class="form-control" id="end_time" required>
                </div>
                  <div class="form-group">
                      <label for="time">Time</label>
                      <input type="number" wire:model="time" class="form-control" id="time" required>
                  </div>

                  <button type="submit" class="btn btn-primary">Update Hodim</button>
                  <button type="button" wire:click="cancelEdit" class="btn btn-secondary">Cancel</button>
              </form>
          </div>
      </div>
      @else
      <div class="row">
          <div class="col-12">
              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Section</th>
                          <th scope="col">Salary type</th>
                          <th scope="col">Salary</th>
                          <th scope="col">Bonus</th>
                          <th scope="col">Salary</th>
                          <th scope="col">Start_time</th>
                          <th scope="col">End_time</th>
                          <th scope="col">Time</th>
                          <th scope="col">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($hodims as $hodim)
                      <tr>
                          <td>{{ $hodim->id }}</td>
                          <td>{{ $hodim->bolim->name }}</td>
                          <td>{{ $hodim->oylik_type }}</td>
                          <td>{{ $hodim->oylik_miqdori }}</td>
                          <td>{{ $hodim->bonus }}</td>
                          <td>{{ $hodim->oylik_time }} </td>
                          <td>{{ $hodim->start_time }}</td>
                          <td>{{ $hodim->end_time }}</td>
                          <td>{{ $hodim->time }}</td>
                          <td>
                              <button wire:click="editHodim({{ $hodim->id }})" class="btn btn-warning btn-sm">Edit</button>
                              <button wire:click="deleteHodim({{ $hodim->id }})" class="btn btn-danger btn-sm">Delete</button>
                          </td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="10" class="text-center">No data available.</td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
          </div>
      </div>
      @endif
  </div>
</div>
