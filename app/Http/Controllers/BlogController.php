<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use App\Blog;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class BlogController extends Controller
{
    
    public function blogManagement()
    {
        return view('blog.blogManagement');
    }


    public function getBlogs()
    {
        $blogs = DB::table('blog')->get();

        $response = ["status" => "Success", "data"=> $blogs];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function getBlogsWithPaginate( Request $request, $language, $paginateNumber)
    {
        $blogs = collect([]);
        $paginationData = collect([]);
        if (isset($request->search) and $request->search != null) {
            $search = strtolower($request->search);
            $blogs = DB::table('blog')
                    ->where('title','LIKE',"%{$search}%")
                    ->orWhere('titleCN','LIKE',"%{$search}%")
                    ->orWhere('titleRU','LIKE',"%{$search}%")
                    ->orWhere('post','LIKE',"%{$search}%")
                    ->orWhere('postCN','LIKE',"%{$search}%")
                    ->orWhere('postRU','LIKE',"%{$search}%")
                    ->orderBy('blogId', 'DESC')
                    ->paginate($paginateNumber);
        }
        else{
            $blogs = DB::table('blog')
                    ->orderBy('blogId', 'DESC')
                    ->paginate($paginateNumber);
        }

        if(!$blogs->isEmpty())
        {
            $row_set2['current_page']=$blogs->currentPage();
            $row_set2['last_page']=$blogs->lastPage();
            $row_set2['perPage']=$blogs->perPage();
            $row_set2['total']=$blogs->total();

            foreach($blogs as $blog)
            {
                if ($language=='en') {
                    $new_row['title']= $blog->title;
                    $new_row['post']= $blog->post;
                } 
                else if($language=='cn') {
                    $new_row['title']= $blog->titleCN;
                    $new_row['post']= $blog->postCN;
                }
                else if($language=='ru') {
                    $new_row['title']= $blog->titleRU;
                    $new_row['post']= $blog->postRU;
                }
                $new_row['blogId']= $blog->blogId;
                $new_row['photoPath']= $blog->photoPath;
                $row_set[] = $new_row; //build an array
            }

            
            $blogs = $row_set;
            $paginationData = $row_set2;
        }
        else
        {
            $blogs = [];
            $paginationData = [];
        }

        // dd($blogs);

        

        $response = ["status" => "Success", "data"=> ['blogs' => $blogs, 'paginationData' => $paginationData]];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    public function getBlog($blogId)
    {
        $blog = DB::table('blog')->where('blogId', $blogId)->first();
        $response = ["status" => "Success", "data"=> $blog];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    public function addBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:199',
            'post' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        
        

        // $request->request->add(['bloggerId' => 7]);

        $inputs = $request->except([ 'token', '_method', 'photoPath']);
        $blog = Blog::create($inputs);

        $blogId = $blog->blogId;


        if ( $request->has('photoPath') && $request->photoPath !=null &&  strlen($request->photoPath)>100) {
            $png_url = "blog-".$blogId.'_'.rand(999,9999999).".png";
            $data = substr($request->photoPath, strpos($request->photoPath, ',') + 1);
            $data = base64_decode($data);
            Storage::disk('blogUploads')->put($png_url, $data);
            Blog::find($blogId)->update(['photoPath' => '/uploads/blog/'.$png_url]);
        }


        $response = ["status" => "Success", "data" => "Blog successfully saved!"];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }

    public function editBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'post' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        Blog::where('blogId', $request->blogId)->update($request->except(['token', 'photoPath']));


        if ( $request->has('photoPath') && $request->photoPath !=null &&  strlen($request->photoPath)>100) {
            $png_url = "blog-".$request->blogId.'_'.rand(999,9999999).".png";
            $data = substr($request->photoPath, strpos($request->photoPath, ',') + 1);
            $data = base64_decode($data);
            Storage::disk('blogUploads')->put($png_url, $data);
            Blog::find($request->blogId)->update(['photoPath' => '/uploads/blog/'.$png_url]);
        }

        if ( !isset($request->photoPath) || $request->photoPath == null)
        {
            Blog::find($request->blogId)->update(['photoPath' => '']);
        }



        $response = ["status" => "Success", "data" => "Successfully Updated!"];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }


    public function deleteBlog($blogId)
    {
        DB::table('blog')->where('blogId', $blogId)->delete();

        $response = ["status" => "Success", "data" => "Blog Successfully Deleted!"];
        return response(json_encode($response), 200, ["Content-Type" => "application/json"]);
    }



    public function blog_f($language)
    {
        include(app_path().'/includes/commonsqlqueriesforfrontend.php');
        
        if (Auth::check()) 
        {
            $notificationData = (DB::table('notifications')->where('receiverId', Auth::user()->id)->whereNull('read_at')->get())->unique('message');
            $userData = DB::table('users')->where('id', Auth::user()->id)->first();
           
            return view('blog.blog', compact( 'categoryData', 'compareData', 'wishlistData', 'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'notificationData', 'userData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }
        else{
            return view('blog.blog', compact( 'categoryData',  'menu_categories_f_Data', 'diseasecategoryData', 'countryData', 'genericbrandpicData','reviewData', 'reviewsData', 'genericstrengthCompactData', 'footerportion1Data', 'footerportion1socialsData', 'footerportion2pagesData', 'footerportion3categoriesData', 'footerportion4Data', 'footerportion4socialsData','footer_slider_best_selling_product', 'footer_slider_new_selling_product', 'topoffooter4thportion_category_products_data', 'bottomfooter_data', 'topoffooter3rdportion_category_products_data'));
        }

    }




    
}
