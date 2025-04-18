<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Department;
 use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

/* Use Image; */

class Departaments extends Component
{
    use WithFileUploads;
    public $photo, $name, $content;

    public function render()
    {
        return view('livewire.departaments');
    }

    public function save()
    {
        $this->validate([
            'photo' => 'image|max:10024',
            'name' => 'max:20',
            'content' => 'min:3|max:12',
        ]);
        /* $this->photo->store('photos');*/
/*
         $imagehash=$this->photo->hashName();
        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->photo)->resize(300,200);
        $image->save('photos/'.$imagehash); */

        $manager = new ImageManager(new Driver());
        $name_gen =hexdec((uniqid())).'.'.$this->photo->getClientOriginalExtension();
        $img = $manager->read($this->photo);
        $img=$img->resize(600,600);
        /* $img->toJpeg(80)->save(base_path('public/photos/'.$name_gen)); */
        $img->toJpeg(80)->save(base_path('public/photos/'.$name_gen));
        $save_url ='photos/'.$name_gen;




        /* dd($image); */

        // Otro codigo

         /*     $image=$this->photo;
           $file_name=time().'.'.$image->getClientOriginalExtension();
           $image_resize =Image::make($image->getRealPath());
           $image_resize->resize(300,300);
           $image_resize->save('photo/'.$file_name); */




        $data=new Department;
         /* $data->photo= $imagehash; */
         $data->photo= $save_url;

       /* $data->photo= $file_name; */
       /* dd($data); */
        $data->name=$this->name;
        $data->content=$this->content;
        $data->save();

        session()->flash('success', 'Inserted Successfully');
    }
}
