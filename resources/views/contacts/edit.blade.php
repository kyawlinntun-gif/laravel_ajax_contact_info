@extends('layouts.master')

@section('title', 'Ajax Contact Form')

@section('content')

    <div class="container mt-5">

        <h3>Contact Edit</h3>
        
        @if ($contact)

            <form id="contact" method="post" action="javascript:void(0)">
                @csrf
                <input type="hidden" name="id" value="{{ $contact->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $contact->name }}">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $contact->phone }}">
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $contact->email }}">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="religion">Religion</label>
                    <input type="text" class="form-control" id="religion" name="religion" value="{{ $contact->religion }}">
                    <span></span>
                </div>
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </form>
            
        @endif

    </div>

@endsection

@section('jQuery')

    {{-- <script>
        $(document).ready(function(){
            var id = $('input[name="id"]').val();
            $("#contact").validate({
                rules: {
                    name: {
                        required: true,
                        // maxlength: 50
                    },
                    phone: {
                        required: true,
                        // digits:true,
                        // minlength: 10,
                        // maxlength: 12,
                    },
                    email: {
                        required: true,
                        // maxlength: 50,
                        email: true
                    },
                    religion: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please enter name",
                        // maxlength: "Your last name maxlength should be 50 charactes long."
                    },
                    phone: {
                        required: "Please enter contact number",
                        // minlength: "The contact number should be 10 digits",
                        // digits:"Please enter only numbers",
                        // maxlength: "The contact number should be 12 digits"
                    },
                    email: {
                        required: "Please enter valid email",
                        email: "Please enter valid email",
                        // maxlength: "The email name should less than or equal to 50 characters"
                    },
                    religion: {
                        required: "Please select the religion."
                    }
                },
                submitHandler: function(form){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ url("/contacts") }}' + '/' + id,
                        type: "POST",
                        data: $("#contact").serialize(),
                        success: function(data){
                            // console.log(data);
                            window.location.href=data.url;
                        }
                    });
                }
            });
        });
    </script> --}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

            $("#submit").on('click', function(e){
                e.preventDefault();
                var id = $('input[name="id"]').val();
                $.ajax({
                    url: '{{ url("/contacts") }}' + '/' + id,
                    type: "POST",
                    data: $("#contact").serialize(),
                    success: function(data){
                        // console.log(data);
                        // window.location.href=data.url;
                        if(data.url)
                        {
                            window.location.href = data.url;
                        }
                        if(data.errors)
                        {
                            console.log(data.errors);
                        }
                    }
                });
            });

        });

    </script>
@endsection
