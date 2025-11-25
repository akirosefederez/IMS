<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Arial Narrow:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    <style>
        body {
            background: url(/uploads/globalbg2.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(/uploads/global_2.png); background-size:90%;">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4 h3-login">Login</h3>
                                </div>

                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror" hidden
                                        placeholder="Email">
                                    @error('email')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label class="label h3-login" for="email">Email</label>
                                    <input type="email" id="email" name="email" :value="old('email')"
                                        class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label h3-login" for="password">Password</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="form-control btn btn-primary rounded submit px-3">Login</button>
                                </div>
                            </form>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
