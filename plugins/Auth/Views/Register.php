<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">
    <title>&#10084; Mhhhh, Catnip! &#10084; - Register</title>
  </head>
  
  <body>
    <div class="container">
        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <strong>Register your Account</strong>
                </div>
                <div class="card-body">
                    <form action="./register" method="post">
                    @isset($message)
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <p class="text-danger"><strong>{{$message}}</strong></p>
                        </div>
                    </div>
                    @endset

                    @formtoken
                        <div class="row justify-content-center">
                            <div class="col-4">
                            <label for="register_name">Username:</label> <input type="text" id="register_name" name="register_name" class="form-control" placeholder="Username" required> 
                            </div>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <div class="col-4">
                            <label for="register_mail">E-Mail:</label> <input type="email" id="register_mail" name="register_mail" class="form-control" placeholder="E-Mail" required>
                            </div>     
                        </div>
                        <div class="row justify-content-center mt-2">
                            <div class="col-4">
                            <label for="register_pass">Password:</label> <input type="password" id="register_pass" name="register_pass" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="d-grid gap-2 col-4 mx-auto mt-3">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </div>     
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

      
    <!-- Bootstrap & Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
  </html>