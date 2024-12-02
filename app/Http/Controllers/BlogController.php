<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $title = "Blog List";
        $allblog = Blog::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('blog.index', compact('title', 'allblog'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                // 'posted_at' => 'required|string',
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Blog ";
                }
                if ($message) {
                    return redirect()->route('blog')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $blog = new Blog();
            $blog->title = $request->title;
            // $blog->posted_at = $request->posted_at;
            $blog->short_content = $request->short_content;
            $blog->status = $request->status;
            $blog->long_content = $request->long_content;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('blog', 'public');
                $blog->image = $filePath;
            }
            $blog->save();
            return redirect()->route('blog')->with('success', 'Blog Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Blog";
        $get_blog = Blog::where('status', '!=', 3)->where('id', $id)->first();
        $allblog = Blog::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('blog.index', compact('title', 'allblog','get_blog'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // 'posted_at' => 'required|string',
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Blog ";
            }
            if ($message) {
                return redirect()->route('blog.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $blog = Blog::findOrFail($request->hidden_id);
        $blog->title = $request->title;
        // $blog->posted_at = $request->posted_at;
        $blog->short_content = $request->short_content;
        $blog->status = $request->status;
        $blog->long_content = $request->long_content;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('blog', 'public');
            $blog->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $blog->updated_at = date('Y-m-d H:i:s');
        $blog->save();
        return redirect()->route('blog')->with('success', 'Blog Updated Successfully');
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = 3;
        $blog->update();
        return redirect()->route('blog')->with('success', 'Blog deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Blog::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_blog = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_blog;
    }
}
