@extends('layouts.app')

@section('content')
<form method="post" action="{{ url('user/'.$user->id) }}">
        @method('PUT');
        @csrf
        <div class="imgcontainer">
            <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="avatar"  width = "10">
        </div>

        <div class="container">
            <label> <b>To make changes you must click the "Save changes" button. </b></label> <br />
            <hr />
            <label for="firstName"><b>First name</b></label>
            <input type="text" value="{{ $user->first_name }}" name="firstName" required>
            <label for="lastName"><b>Last name</b></label>
            <input type="text" value="{{ $user->last_name }}" name="lastName" required>

            <label for="vehicle"><b>Languages: </b></label> <br />
            @foreach ($languages as $language)
                <input type="checkbox" name="language[]" value="{{ $language->name }}" @if(in_array($language->name, $userLanguages)) checked @endif > 
                    {{ $language->name }} <br/>
            @endforeach

            <button type="submit" class="btn btn-success">Save changes</button>

        </div>
</form>
<form method="post" action="{{ url('user/changepass/'.$user->id) }}">
        @csrf
        <div class="container">
            <label> <b>Here you can change your passowrd </b></label> <br />
            <hr />
            <label for="pass"><b>*Old password</b></label>
            <input type="password" placeholder="Password" name="pass" required>

            <label for="newpass"><b>*New password</b></label>
            <input type="password" placeholder="New Password" name="newpass" required>

            <label for="rnewpass"><b>*Retype new password</b></label>
            <input type="password" placeholder="Retype new password" name="newpass_confirmation" required>

            <button type="submit" class="btn btn-success">Save changes</button>

        </div>
</form>
<form method="post" action="{{ url('user/changeemail/'.$user->id) }}">
    @csrf
        <div class="container">
            <label> <b>Here you can change your email </b></label> <br />
            <hr />
            <label for="email"><b>New Email</b></label>
            <input type="text" placeholder="Email" name="email" required>

            <button type="submit" class="btn btn-success">Save changes</button>

        </div>
</form>
<form method="post" action="{{ url('user/'.$user->id) }}" id="deleteForm">
    @csrf
    @method('delete')
        <div class="container">
            <label> <b>Here you can delete your account </b></label> <br />
            <hr />

        <button type="button" id="deleteButton" data-id="{{ $user->id }}" data-token={{ csrf_token() }} class="deleteBtn btn btn-danger">Delete Your Account</button>
        </div>
</form>
@endsection

@section('script')
<script>
    var $executed = false; //odvratan hack da bi radilo svaki put
    $(document).ready(function() { //sacekaj da se ucita ceo dokument
        $('.deleteBtn').on('click', function() {
            if (!$executed) {
                $.noConflict(); //ne radi bez ovoga (sme da se izvrsi samo jednom inace ne zna sta je $)
                $executed = true;
            }
            $.confirm({
                title: 'Delete your account?',
                content: 'This action cannot be reverted',
                autoClose: 'cancelAction|5000',
                buttons: {
                    deleteUser: {
                        text: 'Delete',
                        btnClass: 'btn-danger',
                        action: function() {
                            var id = $('.deleteBtn').data('id');
                            var token = $('.deleteBtn').data('token');
                            console.log("id = " + id + " token = " + token);
                            jQuery.ajax(
                                {
                                    url: "{{ route("user.destroy", $user->id)}}",
                                    type: 'DELETE',
                                    dataType: 'JSON',
                                    data: {
                                        'id': id,
                                        '_method': "DELETE",
                                        '_token': token,
                                    },
                                    success: function(data) {
                                        if (data.hasOwnProperty('success')) {
                                            location.reload();
                                        }
                                    },
                                }
                            );
                        }
                    },
                    cancelAction: {
                        text: 'Cancel',
                    }
                }
            });
        });
    });
</script>
@endsection