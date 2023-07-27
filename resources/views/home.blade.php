@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>


                    <div class="modal">
                        <div class="modal__dialog"><br><br><br><br><br>
                            <div class="modal__close">
                                <a href="#" class="modal__icon">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <span class="modal__note">Crypto</span>
                            </div>
                            <div class="modal__content chat">
                                <div class="modal__sidebar">
                                    <div class="chat__search search">
                                        <div class="search">
                                            <div class="search__icon">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </div>
                                            <input type="search" class="search__input" placeholder="Быстрый поиск">
                                            <div class="search__icon search__icon_right">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
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
                                            <li class="users__item">
                                                <div class="users__avatar avatar avatar_online">
                                                    <a href="#" class="avatar__wrap">
                                                        <img class="avatar__img" src="http://placehold.it/35x35"
                                                            width="35" height="35" alt="avatar image">
                                                    </a>
                                                </div>
                                                @foreach ($users as $user)
                                                    <span class="users__note"> {{ $user->name }}</span>
                                                    <div class="users__counter">
                                                        <span class="counter">3</span>
                                                    </div>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal__main">
                                    <form action="{{ route('contacts.store') }}" method="POST">
                                        @csrf
                                        <div class="chatbox">
                                            <div class="chatbox__row">
                                                <div class="head">
                                                    <div class="head__avatar avatar avatar_larger">
                                                        <a href="#" class="avatar__wrap">
                                                            M
                                                        </a>
                                                    </div>
                                                    <div class="head__title">MaximModus</div>
                                                </div>
                                            </div>
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
                                                                <input type="text" placeholder="Enter Key" name="encrypted_message"
                                                                    value="{{ $messages->message }}" hidden>
                                                            </div>
                                                            <br>
                                                            <div class="form-popup" id="myForm">
                                                                <label for="key"><b>Key</b></label>
                                                                <input type="password" placeholder="Enter Key"
                                                                    name="key" required>

                                                                <button type="submit" class="btn">Decrypt</button>
                                                                <button type="button" class="btn cancel"
                                                                    onclick="closeForm()">close</button>
                                                            </div>
                                                            <button class="button button_id_submit open-button"
                                                                type="button" onclick="openForm()">
                                                                <i class="fa fa-unlock" aria-hidden="true"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><br><br>
                                    
                                    @foreach ($decryptedMessage as $messages)
                                    <div class="message__base">
                                        <div class="message__textbox">
                                            <span class="message__text">{{ $messages }}
                                                <br>
                                            </span>
                                        </div>
                                    </div>@endforeach<br><br>
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
