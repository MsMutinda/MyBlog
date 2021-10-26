@extends('layouts.main')

@section('content')

<div class='mt-5 p-2 mb-4'>
    <h3 class='ml-4 pl-4 mt-1 pb-2'> <strong> Edit profile</strong></h3>

    <section class='card px-3 py-3 mx-5 pl-4' style="width: 22rem;">
        <div class='container-fluid'>
            <div class="mt-8 bg-white rounded  md:w-2/3">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="w-full sm:w-auto order-last sm:order-first">
                        <div class="mb-4">
                            <div class="">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    First Name 
                                </label>
                            </div>
                            <div class="">
                                <input name="fname" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="{{ auth()->user()->fname }}">
                                @error('fname')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Last Name 
                                </label>
                            </div>
                            <div class="">
                                <input name="lname" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="{{ auth()->user()->lname }}">
                                @error('lname')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Email
                                </label>
                            </div>
                            <div class="">
                                <input name="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="email" placeholder="{{ auth()->user()->email }}">
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Phone 
                                </label>
                            </div>
                            <div class="">
                                <input name="phone" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="{{ auth()->user()->phone }}">
                                @error('phone')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="">
                                <label> Gender </label>
                                <div class="col-md-11">
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" value="{{ old('gender') }}" required autocomplete="gender" style='position: relative; right: 14px; border: 1px solid #000;'>
                                        <option value="" selected disabled>Choose</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <!-- <option value="Other">Other</option> -->
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                         
                        </div>

                        <div class="mb-4">
                            <div class="">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                    Hobbies 
                                </label>
                            </div>
                            <div class="">
                                <input name="hobbies" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="{{ auth()->user()->hobbies }}">
                                @error('hobbies')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="md:flex md:items-center"><br>
                            <div class="md:w-1/3">
                                <button class="w-full shadow bg-warning hover:bg-blue-400 focus:shadow-outline focus:outline-none text-dark font-bold py-1 px-2 rounded" type="submit">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </div>        
                    <br>
                </form>        
            </div>

        </div>
    </section>
    
</div>

@endsection