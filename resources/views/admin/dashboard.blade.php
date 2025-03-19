@extends('layouts.app')
@section('content')
<h1>Selamat Datang, Admin!</h1>
    <p>Ini adalah halaman dashboard admin.</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection