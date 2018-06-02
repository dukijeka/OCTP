@extends('layouts.app')

@section('title')
    My translations
@endsection

@section('content')
    <table class="table striped">
        <tr>
            <th>
                Document
            </th>
            <th>
                Original
            </th>
            <th>
                Translation
            </th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($translations as $translation)
            <tr>
                <td>
                    {{ $translation->sentence->document->title }}
                </td>
                <td>
                    <span id="{{"sentence".$translation->id}}">
                        {{ $translation->sentence->text }}
                    </span>
                </td>
                <td>
                    <span id="{{"translation".$translation->id}}">
                        {{ $translation->translation_text }}
                    </span>
                </td>
                <td>
                    <form action="" method="post">
                        @csrf
                        @method("patch")
                        <button type="button" data-id="{{$translation->id}}" class="editBtn btn btn-primary">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('translation.destroy', $translation->id) }}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('script')
<script>
    var $executed = false;
    $(document).ready(function() {
        $('.editBtn').on('click', function(event) {
            if (!$executed) {
                $.noConflict();
                $executed = true;
            }
            var id = jQuery(event.target).data('id');
            var sentence = document.getElementById('sentence' + id).innerText;
            var oldTranslation = document.getElementById('translation' + id).innerText;
            $.confirm({
                title: 'Edit translation',
                content: '' + 
                '<form action="" class="editForm">' +
                '<div class="form-group">' +
                '<label>Sentence: ' + sentence + ' </label>' +
                '<input type="hidden" value="{{csrf_token()}}" id="_token" name="_token"/>' +
                '<input type="text" value="' + oldTranslation + '" class="translation form-control" required />' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: "Submit",
                        btnClass: "btn-primary",
                        action: function() {
                            var newTranslation = this.$content.find('.translation').val();
                            var token = $("#_token").val();
                            jQuery.ajax({
                                type: "POST",
                                url: "{{ route('translation.update') }}",
                                dataType: 'json',
                                data: {
                                    'id': id,
                                    'newTranslation' : newTranslation,
                                    '_token': token
                                },
                                success: function(data) {
                                    if (data.hasOwnProperty('success')) {
                                        location.reload();
                                    }
                                },
                            });
                        }
                    },
                    cancel: function(){}
                },
            });
        });
    });
</script>
@endsection