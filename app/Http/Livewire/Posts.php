<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public $title, $content, $postId;
    public $updatedMode = false;
    protected $paginationTheme = 'bootstrap';

    public function render()
    { 
        return view('livewire.posts', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }

    private function resetInputFields(){
        $this->title = '';
        $this->content = '';
    }

    public function store()
    {
        $validatedForm = $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Post::create($validatedForm);

        
        session()->flash('message', 'Post Created Successfully.');

        $this->resetInputFields();

        $this->emit('postStore');
        $this->emit('message');

    }

    public function edit($id)
    {
        $this->updatedMode = true;
        
        $post = Post::findOrFail($id);

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function cancel()
    {
        $this->updatedMode =false;
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        !empty($this->postId) ? $this->postId : abort(404);

        $post = Post::findOrFail($this->postId);

        $post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->updateMode = false;
        session()->flash('message', 'Posts Updated Successfully.');
        $this->resetInputFields();
        $this->emit('message');
    }


    public function delete($id)
    {
        if($id){
            Post::where('id',$id)->delete();
            session()->flash('message', 'Post Deleted Successfully.');
        }
    }
}
