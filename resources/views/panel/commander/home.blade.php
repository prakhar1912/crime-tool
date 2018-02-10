@extends('panel.commander.master')

@section('main-content')
	<div class="content-header">
		<h1>Add New Case</h1>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12" id="app">
				<form class="form-horizontal" method="POST" action="/home/case">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="col-md-4 control-label">Type</label>

                        <div class="col-md-6">
                            <select class="form-control" name="type">
                                @foreach($crimes as $crime)
                                <option value="{{ $crime->id }}">{{ $crime->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">Description</label>

                        <div class="col-md-6">

                            <textarea id="description" class="form-control" name="description" value="{{ old('description') }}" required></textarea>

                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <label for="status" class="col-md-4 control-label">Status</label>

                        <div class="col-md-6">
                            <select class="form-control" name="status">
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>

                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
@endsection