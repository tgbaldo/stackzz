@extends('layouts.app')

@section('content')

    <section class="content">
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
            				<small><i>{{date('d/m/Y', strtotime($post->createdAt))}}</i></small>
            			</p>
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
                  <div class="direct-chat-msg" style="margin-top: 30px">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name pull-left">{{$c->user->name}}</span>
                      <span class="direct-chat-timestamp pull-right">{{date('d/m/Y H:i', strtotime($c->created_at))}}</span>
                    </div>
                    <img class="direct-chat-img" src="/img/user1-128x128.jpg" alt="Message User Image">
                    <div class="direct-chat-text">
                      {{$c->content}}
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

    </section>

    <script>
	  $(function () {
	    CKEDITOR.replace('editor1')
	    $('.ckeditor').wysihtml5()
	  })
	</script>

@endsection