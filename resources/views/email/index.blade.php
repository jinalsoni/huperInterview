@extends('layouts.master')
@section('content')
<div class="row">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('admin.email.add') }}">Add Email</a>
    </div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<table class="table table-bordered email-tbl mt-10">
    <thead>
        <tr>
            <th>Recipient</th>
            <th>Subject</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($emails as $key => $email)
        <tr>
            <td>{{ $email['recipient'] }}</td>
            <td>{{ $email['subject'] }}</td>
            <td>{{ $email['content'] }}</td>
            <td>
                <button onclick="removedata({{ $email['id'] }})" class="deleteRecord btn btn-danger" data-id="{{ $email['id'] }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('script')
<script>
    $('.email-tbl').DataTable({
        'ordering': false,
    });

    function removedata(id) {
        $('body').on("click", ".deleteRecord", function() {
            var Id = id;
            confirm("Are You sure want to delete ?!");
            $.ajax({
                type: "POST",
                url: "{{ route('admin.email.delete') }}",
                data: {
                    id: Id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success == true) {
                        window.location = "/admin/emails";
                        alert("Your Data Successfully Deleted");
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    }
</script>
@endsection