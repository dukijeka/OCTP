@extends('layouts.app')

@section('content')

    <div id="wrapper">

        <div class="container">



            <!-- Side navigation -->
            <div class="sidenav">

                Document name:
                <br>
                <strong>Lorem ipsum</strong>
                <br>
                <br>

                Language:
                <br>
                <strong>{{$doc->srcLanguage()->name}}</strong>
                <br>
                <br>

                Language requested:
                <br>
                <strong>{{$doc->languages()[0]->name}}</strong>
                <br>
                <br>

                <span>Uploaded by:</span>
                <br>
                <strong>{{$doc->user()->first_name}}</strong>
                <br>
                <br>

                <span>Date:</span>
                <br>
                <strong>30 Mar 2018</strong>
                <br>
                <br>


                <!--
              <a href="#">About</a>
              <a href="#">Services</a>
              <a href="#">Clients</a>
              <a href="#">Contact</a>
                  -->


                <button onclick="reportDocument()">Report</button>


            </div>



            <div class="main">

                <p><strong>Lorem ipsum</strong></p>

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <span class="mediumtranslation"> Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</span> Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>

                <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.</p>

                <p>Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. <span class="goodtranslation"> Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero.</span> Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia.</p>

                <p> <span class="badtranslation"> Nam pretium turpis et arcu.</span> Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. <span class="goodtranslation"> Phasellus ullamcorper ipsum rutrum nunc.</span> Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>



                <!-- Needed because other elements inside ProfilePage have floats -->
                <!--
                <div style="clear:both"></div>
                -->

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
