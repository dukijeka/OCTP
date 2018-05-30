@extends('layouts.app')

@section('content')

    <div id="wrapper">

        <div class="container">



            <!-- Side navigation -->
            <div class="sidenav">

                Document name:
                <br>
                <strong>{{$doc->title()}}</strong>
                <br>
                <br>

                Language:
                <br>
                <strong>{{$doc->srcLanguage()->name}}</strong>
                <br>
                <br>

                Language requested:
                <br>
                <strong>{{$doc->wantedLanguageName()}}</strong>
                <br>
                <br>

                <span>Uploaded by:</span>
                <br>
                <strong>{{$doc->user->first_name}}</strong>
                <br>
                <br>

                <span>Date:</span>
                <br>
                <strong>{{$doc->date_created}}</strong>
                <br>
                <br>


                <button onclick="reportDocument()">Report</button>


            </div>



            <div class="main">

                <p><strong>{{$doc->title()}}</strong></p>

                <p>

                    @foreach ($doc->sentences as $sentence)
                        <span class="sentence" id="sentence_{{$sentence->id}}">{{$sentence->text}} </span>
                    @endforeach

                </p>

            </div>



            <div class="translations">

                <br>

                Translations:

                <br>
                <br>

                <table>

                    <tr>
                        <th style="width:auto">Original sentence</th>
                        <th style="max-width:200px">Translated sentence</th>
                        <th style="min-width:100px">Rating</th>
                        <th style="min-width:100px">My rating</th>
                    </tr>

                    @foreach ($doc->sentences() as $sentence)

                        @ $translation = \App\Translation::find(['sentence_id' => $sentence->id]);
                        @ info($translation->translation_text);

                        <tr>

                            <td>{{$sentence->text}}</td>
                            <td>{{$translation->translation_text}}</td>
                            <td>{{$translation->average_rating}}</td>
                            <td>{{$translation->ratings()->where(['user_id' => Auth::id()])}}</td>

                        </tr>

                    @endforeach

                    <tr>
                        <td>Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</td>
                        <td></td>
                        <td>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </td>
                        <td>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </td>
                    </tr>

                    <tr>
                        <td>Nam pretium turpis et arcu.</td>
                        <td></td>
                        <td>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Phasellus ullamcorper ipsum rutrum nunc.</td>
                        <td></td>
                        <td>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</td>
                        <td></td>
                        <td>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </td>
                        <td></td>
                    </tr>

                </table>

            </div>



        </div>

    </div>

@endsection
