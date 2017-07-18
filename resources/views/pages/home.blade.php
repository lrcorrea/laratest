@extends('layouts.default')
@section('content')
    <h1>Home</h1>

    <select name="test" id="test" class="select">
        @for ($i = 0; $i < 5; $i++)
            <option value="{{ $i }}">Valor {{ $i }}</option>
        @endfor
    </select>

    <select name="test2" placeholder="preço" id="test2" class="select">
        @for ($i = 0; $i < 3; $i++)
            <option value="{{ $i }}">Preço {{ $i }}</option>
        @endfor
    </select>

    <select name="select3" placeholder="grupo1" class="select">
        <optgroup label="Grupo 1">
            <option value="1">grupo 1</option>
            <option value="2">grupo 2</option>
            <option value="3">grupo 3</option>
        </optgroup>

        <optgroup label="Grupo 2">
            <option value="4">grupo 1</option>
            <option value="5">grupo 2</option>
            <option value="6">grupo 3</option>
        </optgroup>
    </select>
@stop