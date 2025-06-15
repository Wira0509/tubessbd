<div>
<h3>({{ $total_comments }}) Comments</h3>
  <form wire:submit.prevent="store" class="mb-4">
    <div class="mb-3">  
      <textarea wire:model.defer="body" rows="2" class="form-control @error('body') is-invalid @enderror " placeholder="Leave your comment!"></textarea>
      @error('body')  
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
            @foreach ($comments as $item)
            <!-- comment start -->
            <div class="mb-3" id="comment-{{ $item->id }}">
              <div class="d-flex align-items-start mb-3">
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" class="img-fluid rounded-circle me-2" width="35">
                <div class="font-comment">
                  <div>
                    <span>{{ $item->user->name }}</span>
                    <span class="font-date">{{ $item->created_at->translatedFormat('d F Y') }}</span>
                  </div>
                  <div class="font-default">
                    <span>{{ $item->body }}</span>
                  </div>
                  <div>
                    <button class="btn btn-sm btn-primary" wire:click="selectReply({{ $item->id }})">Balas</button>
                    @if ($item->user_id == Auth::user()->id)
                    <button class="btn btn-sm btn-warning" wire:click="selectEdit({{ $item->id }})">Edit</button>
                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                    @endif
                    
                    <button class="btn btn-sm btn-danger"><i class="bi bi-heart-fill me-2"></i>(2)</button>
                  </div>

                  @if (isset($comment_id) && $comment_id == $item->id)
                    <form wire:submit.prevent="reply" class="my-3">
                      <div class="mb-3">  
                        <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror " placeholder="Leave your comment!"></textarea>
                        @error('body2')  
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  @endif
                  @if (isset($edit_comment_id) && $edit_comment_id == $item->id)
                    <form wire:submit.prevent="change" class="my-3">
                      <div class="mb-3">  
                        <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror " placeholder="Leave your comment!"></textarea>
                        @error('body2')  
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="d-grid">
                        <button type="submit" class="btn btn-warning">Update</button>
                      </div>
                    </form>
                  @endif
                </div>
              </div>

              @if ($item->childrens)
                @foreach ($item->childrens as $item2)
                  <div class="d-flex align-items-start mb-3 ms-5">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" class="img-fluid rounded-circle me-2" width="35">
                      <div class="font-comment">
                        <div>
                          <span>{{ $item2->user->name }}</span>
                          <span class="font-date">{{ $item2->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="font-default">
                          <span>{{ $item2->body }}</span>
                        </div>
                        <div>
                          <button class="btn btn-sm btn-primary" wire:click="selectReply({{ $item2->id }})">Balas</button>
                          @if ($item2->user_id == Auth::user()->id)
                          <button class="btn btn-sm btn-warning" wire:click="selectEdit({{ $item2->id }})">Edit</button>
                          <button class="btn btn-sm btn-danger" wire:click="delete({{ $item2->id }})">Hapus</button>
                          @endif
                          
                          <button class="btn btn-sm btn-danger"><i class="bi bi-heart-fill me-2"></i>(2)</button>
                        </div>

                        @if (isset($comment_id) && $comment_id == $item2->id)
                          <form wire:submit.prevent="reply" class="my-3">
                            <div class="mb-3">  
                              <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror " placeholder="Leave your comment!"></textarea>
                              @error('body2')  
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </form>
                        @endif
                        @if (isset($edit_comment_id) && $edit_comment_id == $item2->id)
                          <form wire:submit.prevent="change" class="my-3">
                            <div class="mb-3">  
                              <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror " placeholder="Leave your comment!"></textarea>
                              @error('body2')  
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="d-grid">
                              <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                          </form>
                        @endif
                      </div>
                  </div>
                @endforeach
              @endif
              <hr>
            </div>
            <!-- comment end -->
            @endforeach
</div>
