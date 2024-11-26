@extends('adminnav')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Veda Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            font-family: 'Garamond', serif;
            background-image: url('background.jpg');
            background-size: cover;
            color: #333;
        }
        .content-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s;
        }
        .content-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .content-card h2 {
            margin-bottom: 20px;
        }
        .content-card p {
            margin-bottom: 20px;
        }
        .btn-read {
            background-color: #f39c12;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .rating {
            margin-bottom: 20px;
        }
        .rating span {
            font-size: 24px;
            color: #f39c12;
        }
        .modal-content {
            border: none;
            border-radius: 0;
        }
        .modal-body {
            padding: 0;
        }
        #pdfContainer {
            width: 100%;
            height: 90vh;
            overflow: auto;
            position: relative;
        }
        .pdf-page {
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #f39c12;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .content-card {
                padding: 15px;
            }
            .content-card img {
                width: 100%;
                height: auto;
            }
        }
        @media (max-width: 576px) {
            .content-card {
                padding: 10px;
            }
            .content-card img {
                width: 100%;
                height: auto;
            }
            .content-card h2 {
                font-size: 1.5rem;
            }
            .content-card p {
                font-size: 0.9rem;
            }
            .pdf-container embed {
                height: 70vh;
            }
        }
    </style>
</head>
<body>
    <br><br><br><br><br><br><br><br>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="content-card animate__animated animate__fadeInUp">
            
                   
                    <img src="images/mahakavyas/bhagwatgita.jpg" alt="Rig Veda" style="width:56%;margin-left:22%;">
                    <p>
                        The Rig Veda is an ancient Indian collection of Vedic Sanskrit hymns. It is one of the four canonical sacred texts (śruti) of Hinduism known as the Vedas.
                    </p>
                     <div class="rating">
                        <span>★★★★☆</span>
                    </div>
                    <button class="btn-read" data-toggle="modal" data-target="#pdfModal">Read</button>
                    <button class="btn-read" data-toggle="modal" data-target="#pdfModal">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Modal -->
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="close-btn" data-dismiss="modal" aria-label="Close">Close</button>
                    <div id="pdfContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.4.456/pdf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var url = 'images/pdf/bhagwat-gita.pdf'; // Add the path to your PDF

        $('#pdfModal').on('shown.bs.modal', function () {
            var pdfContainer = document.getElementById('pdfContainer');
            pdfContainer.innerHTML = ''; // Clear previous content

            pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
                for (var i = 1; i <= pdfDoc.numPages; i++) {
                    pdfDoc.getPage(i).then(function(page) {
                        var scale = 1.5;
                        var viewport = page.getViewport({ scale: scale });
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        canvas.className = 'pdf-page';

                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        page.render(renderContext).promise.then(function() {
                            pdfContainer.appendChild(canvas);
                        });
                    });
                }
            });
        });

        $('#pdfModal').on('hidden.bs.modal', function () {
            $('#pdfContainer').html(''); // Clear content when modal is closed
        });
    </script>
</body>
</html>

@endsection
