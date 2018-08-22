@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!--<h1>
        Mailbox
        <small>13 new messages</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>
	-->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{route('posts.create')}}" class="btn btn-primary btn-block margin-bottom">Postar</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Tags</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
              @foreach($tags as $t)
                <li>
                	<a href="#">{{$t->name}}<span class="label label-primary pull-right">{{$t->posts}}</span></a>
              	</li>
              @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><!--Posts--></h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Busca">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @foreach($posts as $p)
                  <tr onclick="window.location.href='{{route('posts.show', ['slug' => $p->slug])}}'" style="cursor: pointer;">
                    <td class="mailbox-name">
                		<strong class="text-light-blue">{{$p->title}}</strong>
                		<br>
                		<small class="text-light-blue">{{date('d/m/Y H:i', strtotime($p->createdAt))}} - {{$p->user_id}}</small>
                    </td>
                    <td class="mailbox-subject">
                    @foreach($p->tags as $t)
                    	<span class="badge bg-grey">{{$t->name}}</span>
                    @endforeach
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">

            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection