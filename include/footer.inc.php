<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
<style>
    #footer {
        background-color: rgb(0, 0, 0, 0.2);
    }

    /* css for social media icons */

    .rounded-social-buttons {
        text-align: center;
    }

    .rounded-social-buttons .social-button {
        display: inline-block;
        position: relative;
        cursor: pointer;
        width: 2.5rem;
        height: 2.5rem;
        border: 0.125rem solid transparent;
        padding: 0;
        text-decoration: none;
        text-align: center;
        color: #fefefe;
        font-size: 1.2rem;
        font-weight: normal;
        line-height: 2em;
        border-radius: 1.6875rem;
        transition: all 0.5s ease;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
    }

    .rounded-social-buttons .social-button:hover,
    .rounded-social-buttons .social-button:focus {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }

    .rounded-social-buttons .fa-twitter,
    .rounded-social-buttons .fa-facebook-f,
    .rounded-social-buttons .fa-linkedin,
    .rounded-social-buttons .fa-instagram,
    .rounded-social-buttons .fa-github,
    .rounded-social-buttons .fa-whatsapp {
        font-size: 20px;
    }

    .rounded-social-buttons .social-button.facebook:hover,
    .rounded-social-buttons .social-button.facebook:focus {
        color: #3b5998;
        background: #fefefe;
        border-color: #3b5998;
    }

    .rounded-social-buttons .social-button.github {
        background: black;
    }

    .rounded-social-buttons .social-button.github:hover,
    .rounded-social-buttons .social-button.github:focus {
        color: black;
        background: #ffff;
        border-color: black;
    }

    /* On screens that are 992px or less, set the background color to blue */
    @media screen and (max-width: 992px) {
       
    }
</style>
<div class="container-fluid mt-5 pt-3 pb-2 text-white" id="footer">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-2 text-center">
           
        </div>
        <div class="col-lg-4 mt-2">
            <p class="text-center">Copyright &copy; Kidney Exchange 2021</p>
        </div>
        <div class="col-lg-3">
            <div class="rounded-social-buttons mt-2">

                <a class="social-button github" href="https://www.github.com" target="_blank"><i
                        class="fab fa-github"></i></a>

            </div>
        </div>
    </div>
</div>
<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous"></script>
</body>

</html>