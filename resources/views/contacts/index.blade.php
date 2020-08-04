@extends('layouts.master')

@section('title', 'Ajax Contact Form')

@section('content')

    <div class="contacts-index">
        <div class="container mt-5">
            @if (Cookie::get('success'))
                <div class="alert alert-info">
                    {{ Cookie::get('success') }} <span class="delete_cookie float-right">&#10006;</span>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif
            <h3>Contact Lists</h3>
            @role('creator')
                <button id="contact_create" class="btn btn-primary my-2">Contact Create</button>
            @endrole

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Religions</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
    
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('jQuery')

    <script>
        $(document).ready(function () { 
            var url = "{{ url('/contacts') }}";
            $.ajax({
                type: "GET",
                url: "{{ route('contacts.all') }}",
                success: function(data){
                    for (let i = 0; i < data['contact'].length; i++) {
                        var id = data['contact'][i]['id'];
                        var editUrl = url + '/' + id + '/edit';
                        var deleteUrl = url + '/delete/'+ id;
                        var name = data['contact'][i]['name'];
                        var phone = data['contact'][i]['phone'];
                        var email = data['contact'][i]['email'];
                        var religion = data['contact'][i]['religion'];
                        $('tbody').append('<tr><th scope="row">' + id + '</th><td>' + name + '</td><td>' + phone + '</td><td>' + email + '</td><td>' + religion + '</td><td>@can("create contacts")<a class="text-dark" href="' + editUrl + '">[Edit]</a><a class="text-dark" href="'+ deleteUrl +'">[Del]</a>@endcan</td></tr>')
                    }
                }
            });
            $("#contact_create").on('click', function(e){
                e.preventDefault();
                var createUrl = url + '/create';
                window.location.href = createUrl;
            });
            $(".delete_cookie").on('click', function(e){
                e.preventDefault();
                var parent = $(this).parent();
                $(parent).remove();
            });
            // $(".contacts-index .delete").on('click', function(){
            //     console.log('hello');
            // });
        });
    </script>
    
@endsection
