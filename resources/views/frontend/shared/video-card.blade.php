
            <div class="card" style="width: 20rem">
                <a href="{{route('frontend.video',['id'=>$video->id])}})" title="{{$video->name}}">
                <img class="card-img-top" src="{{url('uploads/'.$video->image) }}" alt="Card image cap" style="max-height: 160px">
                </a>
                   <div class="card-body">
                    <p class="card-text">
                      <a href="" title="{{$video->name}}">{{$video->name}} </a>  
                    <small>{{$video->created_at}}</small>
                   </div>
               

            </div>
 
