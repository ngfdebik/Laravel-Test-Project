@extends('layouts.main')

@section('content')
        <table class="table">
                <thead>
                    <tr>
                    <th width = "25%" scope="col">id</th>
                    <th width = "25%" scope="col">Имя</th>
                    <th width = "25%" scope="col">Автомобиль</th>
                    <th width = "25%" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $content)
                        <tr>
                        <th scope="row">{{$content->id}}</th>
                        <td>{{$content->name}}</td>
                        <td>{{$content->brand}}</td>
                        <td style="display: flex; flex-direction: row">
                            <form action="{{ route('user.edit', $content->id) }}" target="_blank">
                                @csrf
                                <button name="edit" type="submit" class="btn btn-light">редактировать</button>
                            </form>
                            <form action="{{ route('user.delete', $content->auto_id) }}" method="post" target="_blank" style="margin: auto">
                                @csrf
                                @method('delete')
                                <button name="delete" type="submit" class="btn-close" aria-label="Close"></button>
                            </form>
                        </td>
                        </tr>
                @endforeach
                </tbody>
        </table>
        {{ $data->onEachSide(3)->links() }}
@endsection