@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Novo post
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding" style="margin-top: 20px">
             	<form class="form col-md-12" method="post" action="{{route('posts.store')}}">

                    csrf()

             		<div class="row">
             			<div class="col-md-12">
             				<div class="form-group">
		             			<label>Título</label>
		             			<input type="text" name="title" class="form-control">
		             		</div>
             			</div>
             		</div>
             		<div class="row">
             			<div class="col-md-12">
             				<div class="form-group">
		             			<label>Conteúdo</label>
		             			<textarea class="form-control ckeditor" name="content"></textarea>
		             		</div>
             			</div>
             		</div>
             		<div class="row">
             			<div class="col-md-6">
             				<div class="form-group">
	             			<label>Tags</label>
	             			<select class="form-control select2" multiple="multiple" name="tags[]">
	             			@foreach($tags as $id => $name)
	             			<option value="{{$id}}">{{$name}}</option>
	             			@endforeach
	             			</select>
	             		</div>
             			</div>
             		</div>
             		<div class="row">
             			<div class="col-md-6">
             				<div class="form-group">
		             			<label>Categoria</label>
		             			<select class="form-control select2" name="category">
		             				<option value="question">Pergunta</option>
		             				<option value="contrib">Contribuições</option>
		             			</select>
		             		</div>
             			</div>
             		</div>
             		<div class="row">
		     			<div class="col-md-2">
		     				<div class="form-group">
		             			<button type="submit" class="btn btn-success btn-block">Salvar</button>
		             		</div>
		     			</div>
		     			<div class="col-md-2">
		     				<div class="form-group">
		             			<a href="{{route('posts')}}" class="btn btn-default btn-block">Cancelar</a>
		             		</div>
		     			</div>
		     		</div>
             	</form>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection