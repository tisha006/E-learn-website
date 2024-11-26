@extends('Nav')
@section('nav')
<!DOCTYPE html>
<html>
<head>
    <title>Vedas_Description</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"> -->
    <style>
        body {
            font-family: 'Garamond', serif;
            background-image: url('background.jpg');
            background-size: cover;
            color: #333;
        }
        .profile-logo-container {
            margin-top: 20px;
            margin-left:10px;
        }
        .profile-logo {
            width: 55px;
            height: auto;
            border-radius: 50%;
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
            cursor: pointer;
        }
        .rating span {
            font-size: 24px;
            color: gray;
            transition: color 0.2s;
        }
        .rating span.selected {
            color: orange;
        }
        .modal-content {
            border: none;
            border-radius: 0;
        }
        .modal-body {
            padding: 0;
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
        .review-text {
            color: orange;
        }
        .form-control, .btn-primary {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #f39c12;
            border: none;
        }
        .submission-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            display: none;
        }
        .submission-message.show {
            display: block;
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
        }
        /* Style for iframe */
        .pdf-viewer {
            display: none;
            width: 100%;
            height: 80vh;
            border: none;
            margin-top: 20px;
        }
        .pdf-viewer.show {
            display: block;
        }
        .close-pdf {
            background-color: #f39c12;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        li {
            list-style-type: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="content-card animate_animated animate_fadeInUp">
                    <h2>Rig Veda</h2>
                    <img src="images/vedas/rig-ved.jpg" style="width:56%;margin-left:22%;">
                    <p>
                    The Rig Veda is an ancient Indian collection of Vedic Sanskrit hymns. It is one of the four canonical sacred texts (śruti) of Hinduism known as the Vedas.                    </p>
                    </p>
                    <div class="rating" data-toggle="modal" data-target="#reviewsModal">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <button class="btn-read" id="openPdf">Read</button>
                    <!-- PDF Viewer -->
                    <iframe id="pdfViewer" class="pdf-viewer"></iframe>
                    <button class="close-pdf" id="closePdf">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('openPdf').addEventListener('click', function() {
            const iframe = document.getElementById('pdfViewer');
            iframe.src = 'images/imges2/pdf/RigVeda.pdf'; // Path to your PDF
            iframe.classList.add('show'); // Show the iframe
        });

        document.getElementById('closePdf').addEventListener('click', function() {
            const iframe = document.getElementById('pdfViewer');
            iframe.src = ''; // Clear the iframe src to stop the PDF from loading
            iframe.classList.remove('show'); // Hide the iframe
        });
    </script>
    @endsection
</body>
</html>