@extends('layouts.main')

@section('content')
        <form action="{{ route('user.store') }}" method="post" target="_blank" enctype="multipart/form-data">@csrf
                <h1>Client</h1>
                <div class="row">
                        <div class="col">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Имя" aria-label="Имя">
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="gender" id="gender" placeholder="Пол" aria-label="Пол">
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Телефон" aria-label="Телефон">
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="address"  id="address" placeholder="Адресс" aria-label="Адресс">
                        </div>
                </div>
                <h1>Auto</h1>
                <table >
                <tr>
                <div id="linksTable">
                <div class="row">
                        <div class="col">
                                <input type="text" class="form-control" name="1_brand" id="brand" placeholder="Марка" aria-label="Марка">
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="1_model" id="model" placeholder="Модель" aria-label="Модель">
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="1_color" id="color" placeholder="Цвет" aria-label="Цвет">
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="1_stateNumberRF" id="stateNumberRF" placeholder="Гос Номер" aria-label="Гос Номер">
                        </div>
                        <div class="form-check" style="margin-left: 12px; margin-top: 10px;">
                                <input class="form-check-input" value="1" type="checkbox" name="1_inTheParking" id="inTheParking">
                                <label class="form-check-label" for="inTheParking">
                                        На стоянке
                                </label>
                        </div>
                </div>
                </div>
                </tr>
                </table>
                <button type="button" name="add" id="add" class="btn btn-primary">New</button>
                <button type="button" name="remove" id="remove" class="btn btn-danger">Remove</button>

                        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>    
                        <script type="text/javascript">
                        $(document).ready(function(){

                        var i = 2;

                        $('#add').click(function() {
                                $("#linksTable").append('<div class="field" name="dynamic"><div class="row"><div class="col"><input type="text" class="form-control" name="'+ i +'_brand" id="brand" placeholder="Марка" aria-label="Марка"></div><div class="col"><input type="text" class="form-control" name="'+ i +'_model" id="model" placeholder="Модель" aria-label="Модель"></div><div class="col"><input type="text" class="form-control" name="'+ i +'_color" id="color" placeholder="Цвет" aria-label="Цвет"></div><div class="col"><input type="text" class="form-control" name="'+ i +'_stateNumberRF"id="stateNumberRF" placeholder="Гос Номер" aria-label="Гос Номер"></div><div class="form-check" style="margin-left: 12px; margin-top: 10px;"><input class="form-check-input" value="' + i + '" type="checkbox" name="'+ i +'_inTheParking" id="id"><label class="form-check-label" for="inTheParking">На стоянке</label></div></div></div>');

                                i++;

                        });

                        $('#remove').click(function() {

                        if(i > 1) {

                                $('.field:last').remove();

                                i--;

                        }

                        });
                        });

                        </script>
                </div>
                <button type="submit" class="btn btn-light">Create</button>
        </form>
@endsection