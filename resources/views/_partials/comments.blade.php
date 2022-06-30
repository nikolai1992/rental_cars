@foreach($comments as $comment)
    <div class="comment">
        <div class="comment__top">
            <div class="comment__name">{{$comment->user->role->alias=="admin" ? "RENTAL CARS" :  $comment->user->name}}</div>
            <div class="comment__top-right-side">
                <div class="date-block comment__date">{{Carbon\Carbon::parse($comment->created_at)->format('d.m.Y')}}</div>
            </div>
        </div>
        <div class="comment__text">{{$comment->text}}</div>
        <div class="comment__bottom">
            @if(auth()->user())
                <button class="comment__reply" data-write-a-comment data-do-not-hide data-hide=".comments__top" data-review_id="{{$comment->id}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "reply")}}</button>

                @if(auth()->user()->role->alias=="admin")
                    <a class="edit-review-btn" data-comment_id="{{$comment->id}}" href="{{route('review.edit', $comment->id)}}">{{App\Models\Translation::getTranslWord($words, $sel_lang, "edit")}}</a>
                    {{Form::open(['route'=>['review.destroy',$comment->id], 'method'=>'delete'])}}
                    <button onclick="return confirm('Вы уверены, что хотите удалить данный элемент?')" type="submit" class="delete"  title="{{App\Models\Translation::getTranslWord($words, $sel_lang, "delete")}}">
                        {{App\Models\Translation::getTranslWord($words, $sel_lang, "delete")}}
                    </button>
                    {{Form::close()}}
                @endif

            @endif
        </div>
    </div>
    @if($comment->comments->count())
        <div class="comments">
            @include('_partials.comments', array("comments"=>$comment->comments))
        </div>
    @endif
@endforeach