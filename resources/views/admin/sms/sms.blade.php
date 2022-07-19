<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('SMS') }}
        </h2>
    </x-slot>

    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3 text-light">Go Back</a> <br>
    
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('sms.send') }}" method="POST">
        @csrf
        <label for=""><b>SMS For</b></label>
        <input type="" class="form-control">

        <label for="" class="mt-3"><b>Message</b></label>
        <textarea name="message" id="" rows="3" class="form-control">
        </textarea>

        <input type="submit" class="btn btn-primary text-light mt-3">
    </form>


    
</x-app-layout>
