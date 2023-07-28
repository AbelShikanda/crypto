@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                    

                    <div class="modal">
                        <div class="modal__dialog"><br><br><br><br><br>
                            <div class="modal__content chat">
                                <div class="modal__sidebar"><br><br><br>
                                    <div class="chat__users">
                                        <ul class="users">
                                            <li class="users__item users__item_group">
                                                <div class="users__avatar avatar">
                                                    <a href="#" class="avatar__wrap">
                                                        M
                                                    </a>
                                                </div>
                                                <span class="users__note">{{ Auth::user()->name }}</span>
                                            </li>
                                            @foreach ($users as $user)
                                            <li class="users__item">
                                                <div class="users__avatar avatar avatar_online">
                                                    <a href="#" class="avatar__wrap">
                                                        <img class="avatar__img" src="http://placehold.it/35x35"
                                                            width="35" height="35" alt="avatar image">
                                                    </a>
                                                </div>
                                                    <span class="users__note"> {{ $user->name }}</span>
                                                    <div class="users__counter">
                                                        <span class="counter">3</span>
                                                    </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal__main">
                                    <form action="{{ route('contacts.store') }}" method="POST">
                                        @csrf
                                        <div class="chatbox">
                                            <div class="chatbox__row">
                                            </div><br><br><br>
                                            <div class="chatbox__row chatbox__row_fullheight">
                                                <div class="chatbox__content">
                                                    @if ($message)
                                                        @foreach ($message as $messages)
                                                            <div class="message">
                                                                <div class="message__head">
                                                                    <span class="message__note">Princess Murphy</span>
                                                                    <span
                                                                        class="message__note">{{ $messages->created_at }}</span>
                                                                </div>
                                                                <div class="message__base">
                                                                    <div class="message__textbox">
                                                                        <span class="message__text">{{ $messages->message }}
                                                                            <br>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="chatbox__row">
                                                <div class="enter">
                                                    {{-- <div class="enter__textarea">
                                                        <textarea name="enterMessage" id="enterMessage" cols="30" rows="2" placeholder="Say message..."></textarea>
                                                    </div> --}}
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="message" rows="3" placeholder="Message" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="enter__submit">
                                                        <button class="button button_id_submit" type="submit">
                                                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (session()->has('errors'))
                        <div class="alert alert-danger">
                            {{ session()->get('errors') }}
                        </div>
                    @endif


                                        </div>
                                    </form><br><br>
                                    <div class="chatbox__row chatbox__row_fullheight">
                                        <div class="chatbox__content">
                                            @foreach ($message as $messages)
                                                @csrf
                                                <div class="message__base">
                                                    <div class="message__textbox">
                                                        <span class="message__text">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Enter Key"
                                                                    name="encrypted_message"
                                                                    value="{{ $messages->message }}" hidden>
                                                            </div>
                                                            <br>
                                                            <form action="{{ route('decrypt') }}" method="post">
                                                                @csrf
                                                                <div class="form-popup" id="myForm">
                                                                    <label for="key"><b>Key</b></label>
                                                                    <input type="text" placeholder="Enter Key"
                                                                        name="key" required>

                                                                    <button type="submit" class="btn">Decrypt</button>
                                                                    <button type="button" class="btn cancel"
                                                                        onclick="closeForm()">close</button>
                                                                </div>
                                                            </form>
                                                            <button class="button button_id_submit open-button"
                                                                type="button" onclick="openForm()">
                                                                <i class="fa fa-unlock" aria-hidden="true"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div><br><br>
                                                @if (isset($decryptedMessage))
                                                <div class="message__base">
                                                    <div class="message__textbox">
                                                        <span class="message__text">{{ $decryptedMessage }}
                                                            <br>
                                                        </span>
                                                    </div>
                                                </div> 
                                                @endif
                                                <br><br>
                                            @endforeach
                                        </div>
                                    </div><br><br>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
        </script>
    @endsection
