@extends('layouts.main')

@section('content')
        <form action="{{ route('person.store') }}" method="post" target="_blank" enctype="multipart/form-data">@csrf
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
                                <input type="text" class="form-control" name="brand[]" id="brand" placeholder="Марка" aria-label="Марка">
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="model[]" id="model" placeholder="Модель" aria-label="Модель">
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="color[]" id="color" placeholder="Цвет" aria-label="Цвет">
                        </div>
                        <div class="col">
                                <input type="text" class="form-control" name="state_number_RF[]" id="state_number_RF" placeholder="Гос Номер" aria-label="Гос Номер">
                        </div>
                        <div class="form-check" style="margin-left: 12px; margin-top: 10px;">
                                <input class="form-check-input" value="1" type="checkbox" name="in_the_parking[]" id="in_the_parking">
                                <label class="form-check-label" for="in_the_parking">
                                        На стоянке
                                </label>
                        </div>
                        <div class="col">
                                <input type="hidden" value="1" class="form-control" name="id[]" id="id" placeholder="id" aria-label="id">
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
                                $("#linksTable").append('<div class="field" name="dynamic[]"><div class="row"><div class="col"><input type="text" class="form-control" name="brand[]" id="brand" placeholder="Марка" aria-label="Марка"></div><div class="col"><input type="text" class="form-control" name="model[]" id="model" placeholder="Модель" aria-label="Модель"></div><div class="col"><input type="text" class="form-control" name="color[]" id="color" placeholder="Цвет" aria-label="Цвет"></div><div class="col"><input type="text" class="form-control" name="state_number_RF[]" id="state_number_RF" placeholder="Гос Номер" aria-label="Гос Номер"></div><div class="form-check" style="margin-left: 12px; margin-top: 10px;"><input class="form-check-input" value="' + i + '" type="checkbox" name="in_the_parking[]" id="id"><label class="form-check-label" for="in_the_parking">На стоянке</label></div><div class="col"><input type="hidden" value="' + i + '" class="form-control" name="id[]" id="id" placeholder="id" aria-label="id"></div></div></div>');

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