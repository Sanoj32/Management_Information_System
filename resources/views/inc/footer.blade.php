<footer>

    <hr class="downside">
    <div class="site-footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-12">
                    {{-- <h6>About Us</h6> --}}
                    <p class="text-center"> Management Information System @ Lalitpur Engineering College. <a class="navbar-brand " style="text-align:center;" href="{{ url('/updates') }}">
                            Updates
                        </a> </p>
                </div>

                {{-- <div class="col-xs-6 col-md-3 ">
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li> <a href="https://www.facebook.com/JobSeeker-Nepal-107381447893672">Like us on Facebook </a> </li>
                        <li><a href="https://github.com/Sanoj32/Minor-Project.git">Star our Github Repo</a></li>
                        <li><a href="https://github.com/Sanoj32/Python-Scripts-Minor-Project.git">Python Scripts</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-md-3 "> --}}

                {{-- <ul class="footer-links">
                    <li class="pt-4"><a href="https://lec.edu.np/">Our LEC College </a></li>
                    <li><a href="/faqs"> Frequently Asked Questions(FAQs)</a></li>
                    <li><a href="facebook">Facebook Jobs </li>
                </ul> --}}
            </div>
        </div>
    </div>
    </div>
</footer>


<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .site-footer,
    .downside {

        line-height: inherit;
        bottom: 0;
        height: 100px;
        left: 0;
        position: relative;
        width: 100%;
        font-size: 1rem;
        color: grey;
    }

    #app {
        font-size: medium;
    }

    .nav-item {
        font-size: large;
    }

    .nav-item:hover {
        text-decoration: underline;
    }

    .donate {
        position: relative;
        margin: auto;
        height: 50px;
        width: 60px;
        padding: auto 8px;
        float: left;

    }


    .site-footer hr.small {
        margin: 20px 0px;
    }

    .site-footer h6 {
        color: grey;
        font-size: 16px;
        text-transform: uppercase;
        margin-top: 0px;
        letter-spacing: 2px;
    }

    .site-footer a:hover {
        color: #3366cc;
        text-decoration: none;
    }

    .footer-links {
        padding-left: 0;
        list-style: none;
    }

    .footer-links li {
        display: block;
    }

    .footer-links a {
        color: grey;
    }

    .footer-links a:active,
    .footer-links a:focus,
    .footer-links a:hover {
        color: #3366cc;
        text-decoration: none;
    }

    .footer-links.inline li {
        display: inline-block
    }

    .site-footer .social-icons {
        text-align: center;
    }

    .site-footer .social-icons a {
        width: 40px;
        height: 40px;
        line-height: 0px;
        margin-left: 6px;
        margin-right: 0;
        border-radius: 100%;
    }

    .footer {
        margin-top: auto;
    }

    #myBtn {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Fixed/sticky position */
        bottom: 20px;
        /* Place the button at the bottom of the page */
        right: 30px;
        /* Place the button 30px from the right */
        z-index: 99;
        /* Make sure it does not overlap */
        border: none;
        /* Remove borders */
        outline: none;
        /* Remove outline */
        background-color: black;
        /* Set a background color */
        color: white;
        /* Text color */
        cursor: pointer;
        /* Add a mouse pointer on hover */
        padding: 15px;
        /* Some padding */
        border-radius: 50%;
        /* Rounded corners */
        font-size: 18px;
        /* Increase font size */
        transition: all .5s ease;
    }

    #myBtn:hover {
        background-color: black;
        /* Add a dark-grey background on hover */
    }

    @media (max-width:991px) {
        .site-footer [class^=col-] {
            margin-bottom: 10px;

        }
    }

    @media (max-width:767px) {
        .site-footer {
            padding-bottom: 0px;

        }

        .site-footer,
        .site-footer {
            text-align: center;

        }

    }

</style>
