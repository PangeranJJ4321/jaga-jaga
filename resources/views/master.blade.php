<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eventic - Ticket Sales and Event Management System Preview - Pangeran Ganteng</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    {{-- Flowbite --}}
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
    <style>
        .form-control {
            height: 50px; 
            font-size: 1.8rem; 
            padding: 0.50rem 1rem; 
        }


        .height-50px {
            height: 60px !important; 
        }

        @media (max-width: 768px) {
        .form-control {
            height: 50px;
            font-size: 1.5rem;
        }
        }
        .addt {
            background-color: white;
            box-shadow: 1px 2px rgb(201, 201, 231);
            padding: 8px;
            border-radius: 30px;
        }

        .social-icons a {
            font-size: 2rem;
        }

        .list-unstyled li a {
            text-decoration: none;
            color: white;
            font-size: 1.5rem;
        }

        .list-unstyled li a:hover {
            text-decoration: underline;
            color: #ff8008;
        }

        .textTerm {
            font-size: 1.8rem;
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary px-3 mavbar1 position-fixed w-100">
        <div class="container-fluid">
            <!-- Brand Logo -->
            <a class="navbar-brand me-auto" href="#" style="color: #ff8008; font-weight: bold; font-size: 34px;">
                Eventic
            </a>
                
            <!-- Right-aligned Navigation Links -->
            <div class="anjay">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" >Sign up</a>
                        </li>
                    @else
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                            </li>
                        @elseif (Auth::user()->role == 'organizer')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('organizer.dashboard') }}">Organizer Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" title="Lihat Prifile" href="{{ route('user.dashboard') }}">Hello, {{ Auth::user()->name }}</a>
                            </li>
                        @endif
                        <li class="nav-item ml-3">
                            <a class="nav-link" style="color: red" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); 
                                        if (confirm('Are you sure you want to logout?')) {
                                            document.getElementById('logout-form').submit();
                                        }">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>                     
                    @endguest
                </ul>
            </div>
                          
        </div>
    </nav>
    
    <header class="section-header py-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-0">
            <div class="container">
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav nav-fill w-100 anjay">
                        <li class="nav-item">
                            <a class="nav-link" href="/en/home">
                                <i class="fas fa-home fa-fw"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/en/events">
                                <i class="fas fa-calendar fa-fw"></i> Browse Events
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-stream fa-fw"></i> Explore
                            </a>
                            <ul class="dropdown-menu">
                                <a href="/en/events?category=Concert/Music" class="dropdown-item"><i class="fas fa-music fa-fw"></i> Concert / Music</a>
                                <a href="/en/events?category=Trip/Camp" class="dropdown-item"><i class="fas fa-campground fa-fw"></i> Trip / Camp</a>
                                <a href="/en/events?category=sport-fitness-1" class="dropdown-item"><i class="fas fa-futbol fa-fw"></i> Sport / Fitness</a>
                                <a href="/en/events?category=cinema" class="dropdown-item"><i class="fas fa-film fa-fw"></i> Cinema</a>
                                <a href="/en/events?category=museum-monument" class="dropdown-item"><i class="fas fa-landmark fa-fw"></i> Museum / Monument</a>
                                <a href="/en/events?category=recreation-park-attraction" class="dropdown-item"><i class="fas fa-rocket fa-fw"></i> Recreation park / Attraction</a>
                                <a href="/en/events?category=theater" class="dropdown-item"><i class="fas fa-theater-masks fa-fw"></i> Theater</a>
                                <a href="/en/events?category=restaurant-gastronomy" class="dropdown-item"><i class="fas fa-utensils fa-fw"></i> Restaurant / Gastronomy</a>
                                <a href="/en/events?category=workshop-training" class="dropdown-item"><i class="fas fa-chalkboard-teacher fa-fw"></i> Workshop / Training</a>
                                <a href="/en/categories" class="dropdown-item"><i class="fas fa-folder-open fa-fw"></i> All categories</a>
                            </ul>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/en/dashboard/attendee/my-tickets">
                                <i class="fas fa-ticket-alt fa-fw"></i> My tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/en/dashboard/attendee/favorite-events">
                                <i class="fas fa-calendar-plus fa-fw"></i> My Favorit Event
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">
                                <i class="fas fa-ticket-alt fa-fw"></i> My tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">
                                <i class="fas fa-calendar-plus fa-fw"></i> My Favorit Event
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>
   
    @include('partials.flash')
    @yield('content')
    
    
    <footer class="section-footer bg-dark text-white pt-5 pb-4 position-bottom">
        <div class="container mt-5">
            <section class="footer-top">
                <div class="row text-lg-left">
                    <!-- Useful Links -->
                    <aside class="col-sm-6 col-lg-3 mb-4">
                        <h3 class="title text-light mb-3" >Useful Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="#" >About us</a></li>
                            <li><a href="#" >Help center</a></li>
                            <li><a href="#" >Blog</a></li>
                            <li><a href="#" >Venues</a></li>
                            <li><a href="#" >Send us an email</a></li>
                        </ul>
                    </aside>
    
                    <!-- My Account -->
                    <aside class="col-sm-6 col-lg-3 mb-4">
                        <h3 class="title text-light mb-3">My Account</h3>
                        <ul class="list-unstyled">
                            <li><a href="#" >Create an account</a></li>
                            <li><a href="#" >Sell tickets online</a></li>
                            <li><a href="#" >My tickets</a></li>
                            <li><a href="#" >Forgot your password?</a></li>
                            <li><a href="#" >Pricing and fees</a></li>
                        </ul>
                    </aside>
    
                    <!-- Event Categories -->
                    <aside class="col-sm-6 col-lg-3 mb-4">
                        <h3 class="title text-light mb-3">Event Categories</h3>
                        <ul class="list-unstyled">
                            <li><a href="#" >Concert / Music</a></li>
                            <li><a href="#" >Trip / Camp</a></li>
                            <li><a href="#" >Sport / Fitness</a></li>
                            <li><a href="#" >Cinema</a></li>
                            <li><a href="#" >All categories</a></li>
                        </ul>
                    </aside>
    
                    <!-- Contact Us -->
                    <aside class="col-sm-6 col-lg-3 mb-4">
                        <h3 class="title text-light mb-3">Contact Us</h3>
                        <p style="font-size: 1.5rem"><strong>Phone:</strong> +62 823-9331-8287</p>
                        <p style="font-size: 1.5rem"><strong>Phone:</strong> +62 895-3301-53087</p>
    
                        <div class="social-icons mt-3">
                            <a href="https://www.facebook.com" class="btn btn-facebook text-white btn-icon mr-2" title="Facebook" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com" class="btn btn-instagram text-white btn-icon mr-2" title="Instagram" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com" class="btn btn-youtube text-white btn-icon mr-2" title="YouTube" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="https://www.twitter.com" class="btn btn-twitter text-white btn-icon" title="Twitter" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
    
                        <h3 class="title mt-4"><i class="fas fa-globe"></i> Language  English</h3>
                       
                    </aside>
                </div>
            </section>
    
            <section class="footer-bottom">
                <div class="row">
                    <!-- Footer Links -->
                    <div class="col-12 text-center mb-3">
                        <p class="textTerm">
                            <a href="#">Terms of service</a> |
                            <a href="#">Privacy policy</a> |
                            <a href="#">Cookie policy</a> |
                            <a href="#">GDPR compliance</a>
                        </p>
                    </div>
    
                    <!-- Copyright -->
                    <div class="col-12 text-center">
                        <p class="text-light-50" style="font-size: 1.7rem">Copyright © 2024</p>
                    </div>
                </div>
            </section>
        </div>
    </footer>
    
    



    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

     <!-- jQuery (Required for Bootstrap) -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- Typed.js -->
     <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
 
    <script>
        function toggleLike(element) {
            // Toggle kelas 'liked' pada elemen
            element.classList.toggle("liked");

            // Periksa apakah elemen memiliki kelas 'liked'
            if (element.classList.contains("liked")) {
                // Jika di-like, ubah ikon menjadi hati penuh dan latar belakang hitam
                element.style.backgroundColor = "#000"; // Latar belakang hitam
                element.querySelector("i").className = 'bx bxs-heart'; // Hati penuh
                element.querySelector("i").style.color = "#ff0000"; // Warna merah untuk hati
                element.querySelector("i").style.transform = 'scale(1.2)';
            } else {
                // Jika di-unlike, ubah ikon kembali menjadi hati kosong dan tanpa latar belakang
                element.style.backgroundColor = "white"; // Latar belakang transparan
                element.querySelector("i").className = 'bx bx-heart'; // Hati kosong
                element.querySelector("i").style.color = ""; // Reset warna hati
                element.querySelector("i").style.transform = '';
            }
        }

        // Initialize Typed.js to rotate categories
        $(document).ready(function() {
        var options = {
            strings: ["theater", "music", "sports", "comedy", "workshops"], // List of words to rotate
            typeSpeed: 100, // Speed of typing (in milliseconds)
            backSpeed: 50, // Speed of deleting (in milliseconds)
            backDelay: 1000, // Delay before deleting starts
            startDelay: 500, // Delay before typing starts
            loop: true, // Loop indefinitely
            showCursor: true // Show blinking cursor
        };

        var typed = new Typed("#category-text", options); // Initialize the typing effect on the target element
        });

        // buat hapus filter saat button Apply Filters diklik
        function clearFilters() {
            // Menghapus semua nilai input
            window.location.href = window.location.pathname;
        }


        $('#favorite-form').on('submit', function (e) {
    e.preventDefault(); // Mencegah pengiriman form secara tradisional
    
    var formData = $(this).serialize(); // Mengambil data form
    var button = $(this).find('button'); // Tombol yang ditekan
    
    $.ajax({
        url: $(this).attr('action'), // URL tujuan form
        type: $(this).attr('method'), // Metode POST
        data: formData, // Data form yang dikirim
        success: function(response) {
            if (response.status === 'added') {
                button.text(response.button_text).removeClass('btn-outline-primary').addClass(response.button_class);
                alert(response.message);
            } else if (response.status === 'removed') {
                button.text(response.button_text).removeClass('btn-danger').addClass(response.button_class);
                alert(response.message);
            }
        },
        error: function() {
            alert('Terjadi kesalahan saat memproses favorit.');
        }
    });
});



$(document).ready(function () {
    $('#review-form').on('submit', function (e) {
        e.preventDefault(); // Mencegah reload halaman

        var formData = $(this).serialize(); // Ambil data dari form

        $.ajax({
            url: "{{ route('reviews.store') }}", // Endpoint untuk menyimpan review
            method: "POST",
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    alert('Review berhasil ditambahkan!');
                    loadReviews(); // Muat ulang daftar review
                    $('#review-form')[0].reset(); // Reset form
                }
            },
            error: function (xhr) {
                alert('Terjadi kesalahan saat menambahkan review.');
                console.error(xhr.responseText);
            }
        });
    });

    // Fungsi untuk memuat ulang review
    function loadReviews() {
        var eventId = $("input[name='event_id']").val();

        $.ajax({
            url: "/reviews/get/" + eventId, // Endpoint untuk mendapatkan review
            method: "GET",
            success: function (response) {
                if (response.html) {
                    $('#comments-container').html(response.html); // Perbarui container
                }
            },
            error: function (xhr) {
                alert('Gagal memuat review.');
                console.error(xhr.responseText);
            }
        });
    }
});

$('#cancel-review').on('click', function () {
    var reviewId = $(this).data('review-id'); // Ambil ID dari atribut data-review-id

    $.ajax({
        url: "/reviews/" + reviewId, // Endpoint untuk hapus review
        method: "DELETE",
        data: {
            _token: "{{ csrf_token() }}" // Sertakan token CSRF
        },
        success: function (response) {
            if (response.status === 'success') {
                alert('Review berhasil dihapus.');
                loadReviews(); // Muat ulang daftar review
                $('#cancel-review').addClass('d-none'); // Sembunyikan tombol Cancel
                $('#submit-review').removeClass('d-none'); // Tampilkan tombol Submit
            }
        },
        error: function (xhr) {
            alert('Terjadi kesalahan saat menghapus review.');
            console.error(xhr.responseText);
        }
    });
});


    </script>
  </body>
</html>