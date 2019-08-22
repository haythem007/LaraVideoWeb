<?php

namespace App\Http\Controllers;
use App\Http\Requests\FrondEnd\Comments\Store;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Comments;
use App\Models\Message;
use App\Models\Page;
use App\Models\User;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
             'commentUpdate' , 'commentStore'  , 'profileUpdate'
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $videos = Video::orderBy('id' , 'desc');
        if(request()->has('search') && request()->get('search') != ''){
            $videos = $videos->where('name' , 'like' , "%".request()->get('search')."%");
        }
        $videos = $videos->paginate(30);
        return view('home' , compact('videos'));
    }

    public function category($id)
    {
        $cat = Category::FindOrFail($id);
        $videos = Video::where('cat_id',$id)->orderBy('id','desc')->paginate(30);
        return view('frontend.category.index',compact('videos','cat'));
    }

    public function skills($id)
    {
        $skill = Skill::FindOrFail($id);
        $videos = Video::whereHas('skills',function($query) use ($id){
            $query->where('skill_id',$id);
        })->orderBy('id','desc')->paginate(30);
        return view('frontend.skill.index',compact('videos','skill'));
    }

    public function tags($id)
    {
        $tag = Tag::FindOrFail($id);
        $videos = Video::whereHas('tags',function($query) use ($id){
            $query->where('tag_id',$id);
        })->orderBy('id','desc')->paginate(30);
        return view('frontend.tag.index',compact('videos','tag'));
    }

    public function video($id)
    {
        $video = Video::with('skills','tags','cat','user','comments.user')->FindOrFail($id);
       
        return view('frontend.video.index',compact('video'));
    }

    public function commentUpdate($id , Store $request){
        $comment = Comments::findOrFail($id);
        if(($comment->user_id == auth()->user()->id) || auth()->user()->group == 'admin'){
            $comment->update(['comment' => $request->comment]);
            alert()->success('Your Comment Has Been Updated' , 'Done');
        }
        alert()->error('we did not found this comment' , 'Done');
        return redirect()->route('frontend.video' , ['id' => $comment->video_id , '#commnets']);
    }

    public function commentStore($id , Store $request){
        $video = Video::findOrFail($id);
        Comments::create([
            'user_id' => auth()->user()->id,
            'video_id' => $video->id,
            'comment' => $request->comment
        ]);
        alert()->success('Your Comment Has Been Added' , 'Done');

        return redirect()->route('frontend.video' , ['id' => $video->id , '#commnets']);
    }


    public function messageStore(\App\Http\Requests\FrondEnd\Messages\Store $request){
        Message::create($request->all());
        alert()->success('You message have been saved , we will call you n 24 hour' , 'Done');

        return redirect()->route('frontend.landing');
    }

    public function welcome(){

        $videos = Video::orderBy('id','desc')->paginate(9);
        $videos_count = Video::count();
        $comments_count = Comments::count();
        $tags_count = Tag::count();
        return view('welcome',compact('videos','videos_count','comments_count','tags_count'));
    }


    public function page($id , $slug = null){
        $page = Page::findOrFail($id);
        return view('frontend.page.index' , compact('page'));
    }

    public function profile($id , $slug = null){
        $user = User::findOrFail($id);
        return view('frontend.profile.index' , compact('user'));
    }

    public function profileUpdate(\App\Http\Requests\FrondEnd\Users\Store $request){
        $user = User::findOrFail(auth()->user()->id);
        $array = [];
        if($request->email != $user->email){
            $email = User::where('email' , $request->email)->first();
            if($email == null){
                $array['email'] =  $request->email;
            }
        }
        if($request->name != $user->name){
            $array['name'] =  $request->name;
        }
        if($request->password != ''){
            $array['password'] =  Hash::make($request->password);
        }
        if(!empty($array)){
            $user->update($array);
        }
        alert()->success('Your Profile Has Been Updated' , 'Done');

        return redirect()->route('front.profile' , ['id' => $user->id , 'slug' =>slug($user->name)]);
    }


}
