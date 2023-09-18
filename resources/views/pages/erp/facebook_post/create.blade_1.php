@extends('layout.erp.app')

@section('page')
    <style>
        input[type=submit] {
            width: 100%;
            background-color: #034fff;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #2D426F;
        }

        #headline {
            text-align: center;
            font-size: 2.5rem;
            color: #64C5B1;
            font-weight: bold;
        }

        textarea {
            resize: none;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 7px;
            padding: 10px;
        }

        textarea:focus {
            outline: 0;
        }

        select {
            width: 220px;
            height: 30px;
            font-weight: bold;
            color: #034fff;
            font: helvetica;
        }
    </style>

    <div class="main_upper">
        <div class="container-fluid p-0 ">
            <div class="row">
                <div class="col-12">

                    <h1 id="headline">Facebook Post</h1>

                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf

                        <div class="form-group">
                            @php
                                $facebookPages = session('facebookPages');
                            @endphp
                            <select name="page_id">
                                @foreach ($facebookPages as $page)
                                    <option value="{{ $page->page_id }}"> {{ $page->page_name }}
                                    </option>
                                @endforeach
                            </select>
                            <br> <br>
                            <label for="message" class="msg">Write Your Message:</label>
                            <br>
                            <textarea name="message" placeholder="Enter your message" id="message" cols="30" rows="10"></textarea>
                            {{-- <input type="text" name="message" id="message" class="form-control" required> --}}
                        </div>

                        <input type="submit" class="button button1"></input>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
