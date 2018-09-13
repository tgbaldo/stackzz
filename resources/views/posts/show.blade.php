@extends('layouts.app')

@section('content')

    <section class="content container">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">

          	<div class="box-header with-border">
          		<h3 class="box-title">{{$post->title}}</h3>
        			<div class="box-tools pull-right">
        				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        				</div>
        			</div>

            <div class="box-body">
              <div class="row">
                <div class="col-md-12">{!!$post->content!!}</div>
              </div>
            	<div class="row" style="margin-top: 20px">
            		<div class="col-md-12">
            			@foreach($post->tags as $t)
            			<span class="badge bg-grey">{{$t->name}}</span>
            			@endforeach
            		</div>
            	</div>
            	<div class="row" style="margin-top: 20px">
            		<div class="col-md-12">
            			<p>
            				<i>{{$post->user->name}}</i>
            				<br />
            				<small><i>{{date('d/m/Y H:i', strtotime($post->created_at))}}</i></small>
            			</p>
            		</div>
            	</div>   
              <div class="row">
                <div class="col-md-2 pull-right">
                    @if(Auth::id() == $post->user->id)
                      <a href="{{route('posts.edit', ['slug' => $post->slug])}}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-edit"></i> Editar</a>
                    @endif
                </div>
              </div>         	
            </div>
          </div>
        </div>
      </div>

      @if(count($post->comments) > 0)
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Comentários</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  @foreach($post->comments as $c)
                    <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-left">{{$c->user->name}}</span>
                      <span class="direct-chat-timestamp pull-right">{{date('d/m/Y H:i', strtotime($c->created_at))}}</span>
                    </div>
                    <img class="direct-chat-img" src="{{Auth::user()->avatar}}" alt="Message User Image">
                    <div class="direct-chat-text">
                      {!! $c->content !!}
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>             
            </div>
          </div>
        </div>
      </div>
      @endif

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Fazer um comentário</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
              </div>

            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <form id="form-comments" class="form" method="post" action="{{route('comments.store')}}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="form-group">
                      <textarea class="form-control editor" name="content"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Enviar comentário</button>
                    </div>
                  </form>
                </div>
              </div>             
            </div>
          </div>
        </div>
      </div>

    </section>

@endsection