@extends('layout.erp.app')

@section('page')
    <style>
        input[type=submit] {
            width: 100%;
            background-color: #1D9BF0;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #114161;
        }

        #headline {
            text-align: center;
            font-size: 2.5rem;
            color: #1D9BF0;
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
    </style>

    <div class="main_upper">
        <div class="container-fluid p-0 ">
            <div class="row">
                <div class="col-12">


                    <h1 id="headline">Tweet</h1> <br>

                    <form action="{{ route('tweet.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="tweet" class="msg">Write Your Message:</label>
                            <br>
                            <textarea name="content" id="fname" cols="30" rows="10"></textarea>
                            {{-- <input type="text" name="message" id="message" class="form-control" required> --}}
                        </div>

                        {{-- <div class="form-group">
                            <label for="page_id">Facebook Page ID</label>
                             <input type="text" name="page_id" id="page_id" class="form-control" required>
                            </div> --}}

                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}

                        <input type="submit" class="button button1" value="Post Tweet"></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
