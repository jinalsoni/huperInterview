@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Email</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.email.index') }}"> Back</a>
        </div>
    </div>
</div>
<form action="{{ route('admin.email.store') }}" id="email_form" method="POST" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Recipient</strong>
                <input type="text" name="recipient" class="form-control" placeholder="Recipient">
                @if($errors->has('recipient'))
                <div class="error">{{ $errors->first('recipient') }}</div>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Subject</strong>
                <input type="text" name="subject" class="form-control" placeholder="Subject">
                @if($errors->has('subject'))
                <div class="error">{{ $errors->first('subject') }}</div>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Content</strong>
                <input type="text" name="content" class="form-control" placeholder="Content">
                @if($errors->has('content'))
                <div class="error">{{ $errors->first('content') }}</div>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection