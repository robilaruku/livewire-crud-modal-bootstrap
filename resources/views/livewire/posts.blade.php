<div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Open Form
    </button>
    @if (session()->has('message'))
    <div class="alert alert-success" style="margin-top:30px;">x
       {{ session('message') }}
    </div>
    @endif
    <table class="table table-bordered mt-5">
       <thead>
          <tr>
             <th>No.</th>
             <th>Name</th>
             <th>Email</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          @foreach($posts as $key => $value)
          <tr>
             <td>{{ $posts->firstItem() + $key }}</td>
             <td>{{ $value->title }}</td>
             <td>{{ $value->content }}</td>
             <td>
                <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $value->id }})" class="btn btn-primary btn-sm">Edit</button>
                <button wire:click="delete({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button>
             </td>
          </tr>
          @endforeach
       </tbody>
    </table>
    {{ $posts->links() }}
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true close-btn">×</span>
                </button>
             </div>
             <div class="modal-body">
                <form>
                   <div class="form-group">
                      <label for="exampleFormControlInput1">Title</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" wire:model="title">
                      @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                   </div>
                   <div class="form-group">
                      <label for="exampleFormControlInput2">Content</label>
                      <textarea wire:model="content" id="" rows="5" class="form-control" placeholder="Enter Content"></textarea>
                      @error('content') <span class="text-danger error">{{ $message }}</span>@enderror
                   </div>
                </form>
             </div>
             <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save changes</button>
             </div>
          </div>
       </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
          <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
             </div>
             <div class="modal-body">
                <form>
                   <div class="form-group">
                      <input type="hidden" wire:model="user_id">
                      <label for="exampleFormControlInput1">Title</label>
                      <input type="text" class="form-control" wire:model="title" id="exampleFormControlInput1" placeholder="Enter Title">
                      @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                   </div>
                   <div class="form-group">
                      <label for="exampleFormControlInput2">Content</label>
                      <textarea wire:model="content" id="" rows="5" class="form-control" placeholder="Enter Content"></textarea>
                      @error('content') <span class="text-danger">{{ $message }}</span>@enderror
                   </div>
                </form>
             </div>
             <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
             </div>
          </div>
       </div>
    </div>
 </div>