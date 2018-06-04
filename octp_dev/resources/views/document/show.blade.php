@extends('layouts.app')

@section('title')
{{$doc->title()}}
@endsection

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/viewdocument.css') }}" rel="stylesheet">
@endpush

@section('content')



    <div id="wrapper">

        <div class="container">


            <div>

                {{--<table class="table table-striped">

                    <tr>
                        <th>Document name:</th>
                        <th>Language:</th>
                        <th>Language requested:</th>
                        <th>Uploaded by:</th>
                        <th>Date:</th>

                    </tr>

                    <tr>

                        <td>{{$doc->title()}}</td>
                        <td>{{$doc->srcLanguage()->name}}</td>
                        <td>{{$doc->wantedLanguageName()}}</td>
                        <td>{{$doc->user->fullName()}}</td>
                        <td>{{$doc->date_created}}</td>

                    </tr>

                </table> --}}

                <table>

                    <tr>
                        <th>Document name:</th>
                        <td>{{$doc->title()}}</td>
                    </tr>
                    <tr>
                        <th>Language:</th>
                        <td>{{$doc->srcLanguage()->name}}</td>
                    </tr>
                    <tr>
                        <th>Language requested:</th>
                        <td>{{$doc->wantedLanguageName()}}</td>
                    </tr>
                    <tr>
                        <th>Uploaded by:</th>
                        <td>{{$doc->user->fullName()}}</td>
                    </tr>
                    <tr>
                        <th>Date:</th>
                        <td>{{$doc->date_created}}</td>
                    </tr>

                </table>

                <br/>

                @if(Auth::check() && 
                    ! \App\Helpers\Helper::hasUserReportedDocument(Auth::user(), $doc) &&
                    Auth::user() != $doc->user)
                    <button id="reportDocument" data-id= "{{ $doc->id }}" data-token={{ csrf_token() }}>Report</button>
                @endif

                @if(Auth::check() && ( Auth::id() == $doc->user->id || Auth::user()->isAdminOrModerator() ) )
                    <form action="{{ route('document.destroy', $doc->id) }}" method="post">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">Delete</button>
                    </form>
                @endif



            </div>



            <div>

                <br>
                <br>

                <p><strong>{{$doc->title()}}</strong></p>

                <p>

                    @foreach ($doc->sentences as $sentence)

                        @php
                            $translationWithMostRatings = $sentence->getTranslationWithTheMostRatings();
                        @endphp


                        @if ($translationWithMostRatings == null or $translationWithMostRatings->ratings->count() < 2)
                            <span class="sentence text-muted" id="sentence_{{$sentence->id}}">{{$sentence->text}} </span>
                        @elseif($translationWithMostRatings['average_rating'] > 4)
                            <span class="sentence text-success" id="sentence_{{$sentence->id}}">{{$sentence->text}} </span>
                        @elseif($translationWithMostRatings['average_rating'] < 2)
                            <span class="sentence text-danger" id="sentence_{{$sentence->id}}">{{$sentence->text}} </span>
                        @else
                            <span class="sentence text-warning" id="sentence_{{$sentence->id}}">{{$sentence->text}} </span>
                        @endif

                    @endforeach

                </p>

            </div>



            <div class="translations">

                <br>

                <strong>Translations:</strong>

                <br>
                <br>

                <table class="table table-striped">

                    <tr>
                        <th>Original sentence</th>
                        <th>Translated sentence</th>
                        <th style="min-width:100px">User</th>
                        <th style="min-width:100px">Rating</th>
                        <th style="min-width:100px">My rating</th>
                    </tr>

                    @foreach ($doc->sentences as $sentence)

                        @php
                            //$allTranslations = \App\Translation::where('sentence_id', $sentence->id);
                            $allTranslations = $sentence->translations;
                        @endphp

                        @foreach ($allTranslations as $translation)

                            <tr>

                                <td>{{$sentence->text}}</td>

                                <td>{{$translation->translation_text}}</td>

                                <td>{{$translation->user->fullName()}}</td>
                                <td>
                                    @php
                                        $averageRating = (int) $translation->average_rating;
                                        RatingHelper::displayRatingStars($averageRating, $translation->id);
                                    @endphp
                                </td>

                                <td>
                                    @php
                                    $myRating = $translation->ratings()->where('user_id', Auth::id())->first();
                                    if($myRating != null) {
                                        RatingHelper::displayMyRatingStars($myRating->rating_value, $translation->id);
                                    }
                                    @endphp
                                </td>

                            </tr>

                        @endforeach
                    @endforeach

                </table>

            </div>



        </div>

    </div>

@endsection

@section('script')
    <script>
        var $executed = false;
        $(document).ready(function(){

            $('#reportDocument').click(function() {
                var explanation = prompt('Enter reason why are you reporting this document:');
                var token = $('#reportDocument').data('token');
                var docId = $('#reportDocument').data('id');
                if(explanation != null) {
                    // redirect
                    // TODO: escape 'explanation'
                    //location.href = "/report/store/?docId={{$doc->id}}&explanation=" + explanation;
                    $.ajax({
                        url: "{{ route("report.store") }}",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            'id': docId,
                            'explanation': explanation,
                            '_token': token,
                        },
                        success: function(data) {
                            if (data.hasOwnProperty('success')) {
                                location.reload();
                            }
                        }
                    })
                }
            });

            $('.sentence').click(function(event) {
                if (!$executed) {
                    $.noConflict(); //ne radi bez ovoga (sme da se izvrsi samo jednom inace ne zna sta je $)
                    $executed = true;
                }

                var sentenceID = event.target.id.replace("sentence_", "");
                var originalSentence = document.getElementById(event.target.id).innerText;
                $.confirm({
                    title: 'Translate',
                    content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Sentence to translate: ' + originalSentence + '</label>' +
                    '<input type="hidden" value="{{ csrf_token() }}" id="_token" name="_token" />' +
                    '<input type="text" placeholder="Enter your translation here" class="translation form-control" required />' +
                    '</div>' +
                    '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Submit',
                            btnClass: 'btn-blue',
                            action: function () {
                                var translatedSentenceText = this.$content.find('.translation').val();

                                var token = $('#_token').val();

                                jQuery.ajax({
                                        type: "POST",
                                        url: '{{ route('translation.store') }}',
                                        dataType: 'json',
                                        data: { "sentenceId": sentenceID, "_token": token, "text": translatedSentenceText },
                                        success: function(reply){
                                            if (reply['result'] == "Success") {
                                                location.reload();
                                            } else {
                                                alert("Failed to add translation! :(");
                                            }
                                        },
                                        error: function (request, status, error) {
                                            //alert(request.responseText);
                                            //alert(status);
                                            //alert(error);
                                            alert("Failed to add translation! :(");
                                        }
                                    }
                                );
                                //$.alert('Your translation is: ' + translatedSentenceText);

                                //alert('ajax request is sent');
                            }
                        },
                        cancel: function () {
                            //close
                        },
                    },
                    onContentReady: function () {
                        // bind to events
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            // if the user submits the form by pressing enter in the field.
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    },
                    draggable: true,

                });
            });


        });
        jQuery(document).ready(function() {
            jQuery(".rate").on('click', function(event) {
                var num = $(event.target).data('star');
                var translationId = $(event.target).data('id');
                var token = $('meta[name="csrf-token"]').attr('content');
                jQuery.ajax({
                    type: 'POST',
                    url: '{{ route('rating.store') }}',
                    dataType: 'json',
                    data: {
                        '_token': token,
                        'num': num,
                        'translationId': translationId
                    },
                    success: function(data) {
                        if (data.hasOwnProperty('success')) {
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection
