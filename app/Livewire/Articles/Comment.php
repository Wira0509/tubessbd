<?php

    namespace App\Livewire\Articles;

    use App\Models\Itinerary;
    use Auth;
    use Illuminate\Support\Facades\Artisan;
    use Livewire\Component;
    use App\Models\Comment as ModelsComment;
    use Livewire\WithEvents;

    class Comment extends Component
    {   
        public $body, $itinerary, $body2;
        public $comment_id, $edit_comment_id;

        public function mount($id)
        {
            $this->itinerary = Itinerary::find($id);
        }
        public function render()
        {
            return view('livewire.articles.comment', [
                'comments' => ModelsComment::with('user', 'childrens')
                    ->where('itineraries_id', $this->itinerary->id)
                    ->whereNull('comment_id')->get(),
                'total_comments' => ModelsComment::where('itineraries_id', $this->itinerary->id)->count(),
            ]);
        }  

        public function reply()
        {
            $this->validate(['body2' => 'required']);
            $comment = ModelsComment::find($this->comment_id);
            $comment = ModelsComment::create([
                'user_id' => Auth::user()->id,
                'itineraries_id' => $this->itinerary->id,
                'body' => $this->body2,
                'comment_id' => $comment->comment_id ? $comment->comment_id : $comment->id
            ]);

            if($comment){
                $this->dispatch('comment_store', $comment->id);
                $this->body2 = NULL;
                $this->comment_id = NULL;
            }else{
                session()->flash('danger','komentar gagal dibuat');
                return redirect()->route('itinerary.show', $this->itinerary->slug);
            }
        }

        public function store()
        {
            $this->validate(['body' => 'required']);
            $comment = ModelsComment::create([
                'user_id' => Auth::user()->id,
                'itineraries_id' => $this->itinerary->id,
                'body' => $this->body
            ]);

            if($comment){
                $this->dispatch('comment.store', $comment->id);
                $this->body = NULL;
            }else{
                session()->flash('danger','komentar gagal dibuat');
                return redirect()->route('itinerary.show', $this->itinerary->slug);
            }
        }

        public function selectEdit($id)
        {
            $comment = ModelsComment::find($id);
            $this->edit_comment_id = $comment->id;
            $this->body2 = $comment->body;
        }

        public function change()
        {
            $this->validate(['body2' => 'required']);
            $comment = ModelsComment::where('id', $this->edit_comment_id)->update([
                'body' => $this->body2
            ]);

            if($comment){
                $this->dispatch('comment.store', $this->edit_comment_id);
                $this->body = NULL; 
                $this->edit_comment_id = NULL;
            }else{
                session()->flash('danger','komentar gagal diubah');
                return redirect()->route('itinerary.show', $this->itinerary->slug);
            }
        }

        public function delete($id)
        {
            $comment = ModelsComment::where('id', $id)->delete();

            if($comment){
                return NULL;
            }else{
                session()->flash('danger','komentar gagal dihapus');
                return redirect()->route('itinerary.show', $this->itinerary->slug);
            }
        }

        public function selectReply($id)
        {
            $this->comment_id = $id;
            $this->edit_comment_id = NULL;
            $this->body2 = NULL;
        }

    }
