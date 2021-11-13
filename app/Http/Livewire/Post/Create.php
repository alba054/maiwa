<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\File;
use Intervention\Image\ImageManager;
use Livewire\WithFileUploads;

class Create extends Component
{
	use WithFileUploads;
    public $state = [], $count, $images, $foto;

	protected $rules = [
        'images' => 'required|image',
        'foto' => 'required|image',
    ];
    protected $messages = [
        'images.required' => 'this field is required.',
    ];
    public function render()
    {
        return view('livewire.post.create',[
			'tags' => Tag::orderBy('name')->get(),
		]);
    }

    public function submit()
    {
		
		$this->validate();

		// dd($this->state['images']);
        // Validator::make(
		// 	$this->state,
		// 	[
		// 		'title' => 'required',
		// 		'tags' => 'required',
		// 		'images' => 'required|max:2048',
		// 		'detail' => 'required|min:20',
                
		// 	],
		// 	[
		// 		'title.required' => 'The Title field is required.',
		// 		'tags.required' => 'The Tags field is required.',
		// 		'images.required' => 'The Tags field is required.',
				
		// 	])->validate();


			$this->state['tags'] = implode(",", $this->state['tags']);
			$this->state['slug'] = Str::slug($this->state['title']);

			// dd($this->state);
			$this->state['images'] = $this->handleImageIntervention($this->state['images']);

			$save = Post::create($this->state);
			$save ? $this->isSuccess("Created") : $this->isError("Failed");
			return redirect()->route('post.index');
    }

	public function handleImageIntervention($res_foto)
    {
        $res_foto->store('public/photos');
        $imageName = $res_foto->hashName();
        $data['foto'] = $imageName;

        $manager = new ImageManager();
        $image = $manager->make('storage/photos/'.$imageName)->resize(300,300);
        $image->save('storage/photos_thumb/'.$imageName);

        return $imageName;
    }

	public function isSuccess($msg)
    {
        $this->alert('success', $msg, [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  '', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  false, 
            'showConfirmButton' =>  false, 
      ]);
    }
    public function isError($msg)
    {
        $this->alert('error', $msg, [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  '', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  false, 
            'showConfirmButton' =>  false, 
      ]);
    }
}
