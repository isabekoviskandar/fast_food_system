<div>
  <div class="container mt-5">
      <div class="mb-4">
          <button wire:click="$set('isCreateMode', true)" class="btn btn-success">Create Hodim</button>
      </div>

      @if($isCreateMode)
      <div class="row mb-4">
          <div class="col-12">
              <form wire:submit.prevent="createHodim">
                <div class="form-group">
                  <label for="bolim_id">Bolim ID</label>
                  <select wire:model="bolim_id" class="form-control" id="bolim_id" required>
                      <option value="">Select Bolim</option>
                      @foreach ($bolims as $bolim)
                          <option value="{{ $bolim->id }}">{{ $bolim->name }}</option>
                      @endforeach
                  </select>
                </div>
                  <div class="form-group">
                      <label for="oylik_type">Oylik Type</label>
                      <input type="text" wire:model="oylik_type" class="form-control" id="oylik_type" required>
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
                      <input type="date" wire:model="start_time" class="form-control" id="start_time" required>
                  </div>
                  <div class="form-group">
                      <label for="end_time">End Time</label>
                      <input type="date" wire:model="end_time" class="form-control" id="end_time" required>
                  </div>
                  <div class="form-group">
                      <label for="time">Time</label>
                      <input type="number" wire:model="time" class="form-control" id="time" required>
                  </div>

                  <button type="submit" class="btn btn-primary">Create</button>
                  <button type="button" wire:click="$set('isCreateMode', false)" class="btn btn-secondary">Cancel</button>
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
                          <th scope="col">Bolim_id</th>
                          <th scope="col">Oylik_type</th>
                          <th scope="col">Oylik_miqdori</th>
                          <th scope="col">Bonus</th>
                          <th scope="col">Oylik_time</th>
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
                          <td>{{ $hodim->bolim_id }}</td>
                          <td>{{ $hodim->oylik_type }}</td>
                          <td>{{ $hodim->oylik_miqdori }}</td>
                          <td>{{ $hodim->bonus }}</td>
                          <td>{{ $hodim->oylik_time }}</td>
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
