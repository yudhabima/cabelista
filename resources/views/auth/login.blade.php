@extends('layouts.layouts')

@section('content')
    <section style="margin-top: 150px">  <!-- Increased margin-top -->
        <div class="container py-5 col-xxl-8">
            <h2 class="fw-bold mb-3">Halaman Login Cabelista</h2>

            <form action="/login" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="">Masukkan Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                
                <div class="form-group mb-3">  <!-- Corrected 'formgroup' to 'form-group' -->
                    <label for="">Masukkan Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </section>
@endsection
