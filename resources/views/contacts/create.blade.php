@extends('layouts.master')

@section('title', 'Ajax Contact Form')

@section('content')

    <div class="container mt-5">
        <legend>Contact Create</legend>
        <form id="contact" method="post" action="javascript:void(0)">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                <span></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                <span></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                <span></span>
            </div>
            <div class="form-group">
                <select name="religion" id="religion" class="form-control">
                    @foreach ($religions as $religion)
                        <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                    @endforeach
                </select>
                <span></span>
            </div>
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </form>
    </div>

@endsection

@section('jQuery')

    {{-- <script>
        $(document).ready(function(){
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
                        url: '{{ url("/contacts") }}',
                        type: "POST",
                        data: $("#contact").serialize(),
                        success: function(data){
                            if(data.url)
                            {
                                window.location.href = data.url;
                            }
                            if(data.errors)
                            {

                                if(data.errors['name'])
                                {
                                    var parent = $('#name').parent();
                                    var errors = data.errors['name'];
                                    $(parent).children("span").html(errors).addClass('text-danger');
                                }
                                if(data.errors['email'])
                                {
                                    var parent = $("#email").parent();
                                    var errors = data.errors['email'];
                                    $(parent).children("span").html(errors).addClass('text-danger');
                                }
                            }
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

        $("#submit").on('click', function(e){
            e.preventDefault();
                $.ajax({
                url: '{{ url("/contacts") }}',
                type: "POST",
                data: $("#contact").serialize(),
                success: function(data){
                    if(data.url)
                    {
                        window.location.href = data.url;
                    }
                    if(data.errors)
                    {

                        if(data.errors['name'])
                        {
                            var parent = $('#name').parent();
                            var errors = data.errors['name'];
                            $(parent).children("span").html(errors).addClass('text-danger');
                        }
                        else
                        {
                            var parent = $("#name").parent();
                            // $(parent).childern("span").remove();
                            messageRemove(parent);
                        }
                        if(data.errors['phone'])
                        {
                            var parent = $('#phone').parent();
                            var errors = data.errors['phone'];
                            $(parent).children("span").html(errors).addClass('text-danger');
                        }
                        else
                        {
                            var parent = $("#phone").parent();
                            // $(parent).children("span").remove();
                            messageRemove(parent);
                        }
                        if(data.errors['email'])
                        {
                            var parent = $("#email").parent();
                            var errors = data.errors['email'];
                            $(parent).children("span").html(errors).addClass('text-danger');
                        }
                        else
                        {
                            var parent = $("#email").parent();
                            // $(parent).children("span").remove();
                            messageRemove(parent);
                        }
                        if(data.errors['religion'])
                        {
                            var parent = $('#religion').parent();
                            var errors = data.errors['religion'];
                            $(parent).children("span").html(errors).addClass('text-danger');
                        }
                        else
                        {
                            var parent = $("#religion").parent();
                            // $(parent).children('span').remove();
                            messageRemove(parent);
                        }

                        function messageRemove(parent)
                        {
                            $(parent).children('span').remove();
                        }
                    }
                }
            });     
        });   
        
    </script>

@endsection
