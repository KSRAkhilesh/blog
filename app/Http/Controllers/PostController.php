<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Session;
use App\Category;
use App\Tag;
use Purifier;
use Image;
use Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('posts.index')->withPosts($posts);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.createpost')->withCategories($categories)->withTags($tags);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|min:3|max:255', 
            'body'=>'required',
            'slug' =>'required|alpha_dash|min:4|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'featured_image' => 'sometimes|image'
            ]);
        $post = new Post;
        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->category_id = $request->category_id;
        $post->slug = $request->slug;
         if ($request->hasFile('featured_image')) {
             $image = $request->file('featured_image');
             $filename = time() . '.' . $image->getClientOriginalExtension();
             $location = public_path('images/' . $filename);
            Image::make($image)->resize(400,200)->save($location);
            $post->image =  $filename;
         }
        $post->save();
        if (isset($request->tags)) {
            $post->tags()->sync($request->tags,false);
        }else{
         $post->tags()->sync(array(),true);
     }
     Session::flash('success','The Blog Post is Successfully Saved !');
     return redirect()->route('posts.show',$post->id);
 }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $tags2 = array();
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category ) {
            $cats[$category->id] = $category->name;
        }
        foreach ($tags as $tag ) {
            $tags2[$tag->id] = $tag->name;
        }
        $post = Post::find($id);
        return view('posts.edit')->withPost($post)->withCats($cats)->withTags($tags2);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $post = Post::find($id);
         $this->validate($request,[
            'title'=>'required|min:3|max:255', 
            'body'=>'required',
            'slug'=>"required|alpha_dash|min:4|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'featured_image' => 'sometimes|image'
            ]);
         //saving the file we get to update
         if ($request->hasFile('featured_image')) {
             $image = $request->file('featured_image');
             $filename = time() . '.' . $image->getClientOriginalExtension();
             $location = public_path('images/' . $filename);
            Image::make($image)->resize(300,300)->save($location);
            //take old file name
            $oldFilename = $post->image;
            //update it to the file we got to update it may be old or a  new one replacing old one
            $post->image =  $filename; //now it gets current time
            Storage::delete($oldFilename);
         }
    $post->title = $request->title;
    $post->body = Purifier::clean($request->body);
    $post->slug = $request->slug;
    $post->category_id = $request->category_id;
    $post->save();
    if (isset($request->tags)) {
       $post->tags()->sync($request->tags,true);
   }else{
     $post->tags()->sync(array(),true);
 }
 Session::flash('success','The Blog Post is Successfully Updated !');
 return redirect()->route('posts.show',$post->id);
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        Storage::delete($post->image);
        $post->delete();
         Session::flash('success','The Blog Post is Successfully Deleted !');
        return redirect()->route('posts.index');
    }
}
