@extends('layouts.main')

@section('content')

<table class="table">
                <thead>
                    <tr>
                    <th width = "20%" scope="col">id</th>
                    <th width = "20%" scope="col">Бренд</th>
                    <th width = "20%" scope="col">Модель</th>
                    <th width = "20%" scope="col">Цвет</th>
                    <th width = "20%" scope="col">Гос.номер</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $contents)
                    @foreach($contents as $content)
                        @if($content->in_the_parking === 1)
                            <tr>
                            <th scope="row">{{$content->id}}</th>
                            <td>{{$content->brand}}</td>
                            <td>{{$content->model}}</td>
                            <td>{{$content->color}}</td>
                            <td>{{$content->state_number_RF}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                </tbody>
        </table>
            <div id="seldemo">
                <select class="per" id="selphp">
                    @foreach($persons as $person)
                        <option value="{{  $person->id }}">{{  $person->name }}</option>
                    @endforeach
                </select>
                
            </div>

            <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    var i;
                    $("select").on("change", function(){
                        i = $(this).val();
                        $("#seldemo").append('<select id="selphp">@foreach($data as $contents)@foreach($contents as $content)@if($content->person_id == '+ i +')<option value="{{  $content->id }}">{{  $content->brand }}</option>@endif @endforeach @endforeach</select>');
                    });
                });
            </script>
@endsection