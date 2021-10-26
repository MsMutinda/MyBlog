<div class="modal fade" id="profileEdit" role="dialog">
    <div class="modal-dialog">
        <div class='modal-content px-3' id="editModal">
            <div class='modal-header'>
                <h4 class='ml-2 pl-1 pt-3 mt-1'><strong> Edit profile</strong></h4>
                <!-- dismiss button -->
                <button type="button" class="close bg-danger p-2 pt-2 mt-2" data-dismiss="modal">&times;</button>
            </div>
        
            <div class='modal-body'>
                <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
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
                        <br>

                        <div class='modal-footer'>
                            <button class="w-full shadow bg-warning hover:bg-blue-400 focus:shadow-outline focus:outline-none text-dark font-bold py-2 px-4 rounded" type="submit">
                                Update Profile
                            </button>
                        </div>
                    </div>
                </form>        
            </div>
        </div>
    </div>
</div>    