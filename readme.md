### This project from tutorial from Traversy media found here [link](https://www.youtube.com/watch?v=EU7PRmCpx-0&list=PLillGF-RfqbYhQsN5WMXy6VsDMKGadrJ-)

#### Mine contribution is only that when you don't add cover image in post where cover image is present, is that image is deleted and thumbnail is set to default "noimage.jpg". This is in PostsController from 196 to 226 row in code.

```
$check = $request->file('cover_image');

$stara_slika = $post->cover_image;

if($check){

    if($stara_slika==="noimage.jpg"){
        $post->cover_image = $fileNameToStore;
    }
    else{
        Storage::delete('public/cover_images/' . $post->cover_image);
        $post->cover_image = $fileNameToStore;
    }

}
else{

    if($stara_slika==="noimage.jpg"){
        $post->cover_image = $stara_slika;
    }
    else{
        Storage::delete('public/cover_images/' . $post->cover_image);
        $post->cover_image = "noimage.jpg";
    }

}

$post->save();
//Ovde se redirektuje po uspesnom postovanju.
return redirect('/posts')->with('success', 'Post Updated');
```
