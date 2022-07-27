<?php

namespace App\Http\Controllers\API;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;

    public function index()
    {
        //
        $blogs = Blog::select(
                'id', 
                'id_category', 
                'tags', 
                'published_on', 
                'slug', 
                'meta_keyword', 
                'meta_description', 
                'status', 
                'image')
            ->orderBy("id", "Desc")
            ->get();

        return $blogs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id_category = $request->id_category;
        $tags = $request->tags;
        $published_on = $request->published_on;
        $slug = str_replace(" ", "-", $tags);
        $meta_keyword = $request->meta_keyword;
        $meta_description = $request->meta_description;
        $status = $request->status;

        $request_data = array(
            'id_category' => $id_category,
            'tags' => $tags,
            'published_on' => $published_on,
            'slug' => $slug,
            'meta_keyword' => $meta_keyword,
            'meta_description' => $meta_description,
            'status' => $status
        );
        
        if($request->hasFile('image')) {
            
            $file      = $request->file('image');
            $filenameOri  = $file->getClientOriginalName();
            $image   = 'images/blog/' . date('His') . '-' . $filenameOri;
            $filename   = date('His') . '-' . $filenameOri;
            $file->move(public_path('images/blog/'), $image);

            $blog = Blog::create([
                $request_data,
                "image" => $filename
            ]);
        } else {
            $blog = Blog::create($request_data);
        }

        return $blog;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $blog = Blog::where('slug', $slug)
            ->select(
                'id', 
                'id_category', 
                'tags', 
                'published_on', 
                'slug', 
                'meta_keyword', 
                'meta_description', 
                'status', 
                'image')
            ->orderBy("id", "Desc")
            ->get();

        if($blog->count() > 0) {
            $view = $blog;
        }else {
            $view = response()->json(['error' => 'maaf content tidak ditemukan'], 404);
        }

        return $view;
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
        //
        $id_category = $request->id_category;
        $tags = $request->tags;
        $published_on = $request->published_on;
        $meta_keyword = $request->meta_keyword;
        $meta_description = $request->meta_description;
        $status = $request->status;
        
        if($request->hasFile('image')) {
            
            $file      = $request->file('image');
            $filenameOri  = $file->getClientOriginalName();
            $image   = 'images/blog/' . date('His') . '-' . $filenameOri;
            $filename   = date('His') . '-' . $filenameOri;
            $file->move(public_path('images/blog/'), $image);

            $data = Blog::find($id);

            $data->id_category = $id_category;
            $data->tags = $tags;
            $data->published_on = $published_on;
            $data->slug = str_replace(" ", "-", $tags);
            $data->meta_keyword = $meta_keyword;
            $data->meta_description = $meta_description;
            $data->status = $status;
            $data->image = $filename;

            $data->save();

            $checkImage =  public_path().'/images/blog/'.$request->image_value;

            if(file_exists($checkImage)) {

                @unlink($checkImage);

            }
        } else {
            $data = Blog::find($id);

            $data->id_category = $id_category;
            $data->tags = $tags;
            $data->published_on = $published_on;
            $data->slug = str_replace(" ", "-", $tags);
            $data->meta_keyword = $meta_keyword;
            $data->meta_description = $meta_description;
            $data->status = $status;

            $data->save();
        }

        if($data){
            $view = $data;
        }else{
            $view = response()->json(['error' => 'tidak boleh mengedit tutorial ini'], 403);
        }

        return $view;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $blog = Blog::find($id);
        $blog->delete();

        if($blog == true) {
            $message = response()->json([
                'success' => true,
                'message' => 'berhasil menghapus'], 200);
        }else{
            $message = response()->json(['error' => 'tidak boleh menghapus tutorial ini'], 403);
        }

        return $message;
    }
}
