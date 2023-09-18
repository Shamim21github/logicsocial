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

        /* Update only the select styles for multiple selections */
        select[multiple] {
            width: 220px;
            height: 60px;
            font-weight: bold;
            color: #034fff;
            font-family: helvetica;
        }

        /* Change the color of selected options */
        select[multiple] option:checked {
            background-color: #034fff;
            color: white;
        }

        /* Custom styles for selected pages container */
        .selected-pages {
            width: 300px;
            border-radius: 7px;
            margin: 0;
        }
    </style>

    <div class="main_upper">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <h1 id="headline">Facebook Post</h1>

                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div class="select-container">
                                <div class="d-flex">
                                    @php
                                        $facebookPages = session('facebookPages');
                                    @endphp
                                    <div style="padding-top:40px;">
                                        <label>Select From Below:</label>
                                        <br>
                                        <select name="page_ids[]" id="page_ids" multiple class="select-box mr-5">
                                            {{-- @foreach ($facebookPages as $page) //if user add facebook page then this code execute --}}
                                            @foreach ($facebookPages ?? [] as $page)
                                                <option value="{{ $page->page_id }}">{{ $page->page_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="padding-top:40px;">
                                        <label for="selected-pages">Selected Pages:</label>
                                        <div class="selected-pages" id="selectedPagesContainer">

                                        </div>
                                    </div>
                                </div>
                            </div> <br>

                            <label for="message" class="msg">Write Your Message:</label>
                            <textarea name="message" placeholder="Enter your message" id="message" cols="30" rows="12"></textarea>

                            <div class="custom-file" id="selectedImageContainer">
                                <input type="file" name="image" class="custom-file-input" id="image"
                                    onchange="updateImageLabel(this)">
                                <label class="custom-file-label" id="imageLabel" for="image">Choose image</label>
                            </div>


                            <input type="submit" class="button button1">
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('page_ids');
            const selectedPagesContainer = document.getElementById('selectedPagesContainer');

            selectElement.addEventListener('change', function() {
                const selectedOptions = Array.from(selectElement.selectedOptions);
                const selectedPageNames = selectedOptions.map(option => option.text).join(', ');

                selectedPagesContainer.innerHTML = `<p>${selectedPageNames}</p>`;
            });
        });

        function updateImageLabel(input) {
            const label = document.querySelector('#imageLabel');
            if (input.files.length > 0) {
                label.textContent = input.files[0].name;
            } else {
                label.textContent = 'Choose image';
            }
        }
    </script>
@endsection
