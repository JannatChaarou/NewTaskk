@extends('layouts.app')

@section('content')
<style>
.hom-container {
    background: url('{{ asset('images/hom.jpg') }}') center/cover no-repeat;
    background-size: cover;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 100vw;
    height: 100vh;
}
</style>

<div class="hom-container">
    <h1 class="home-h">Welcome Back to NewTask</h1>
    <p class="home-p">Manage your tasks efficiently and stay organized.</p>
    <a href="{{ route('tasks.create') }}" class="home-btn">Get Started</a>
</div>
@endsection
