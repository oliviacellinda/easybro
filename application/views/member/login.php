<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=no">
	<title>Login</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.8/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.8/bower_components/font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.8/dist/css/AdminLTE.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/Source_Sans_Pro/font.css');?>">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- Judul -->
        <div class="login-logo">
            <p>Easybro</p>
        </div>

        <!-- Kotak Login -->
        <div class="login-box-body">
            <!-- Subjudul -->
            <p class="login-box-msg">Masuk</p>

            <form autocomplete="off">
                <div class="form-group has-feedback" id="username">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback" id="password">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <button id="btnLogin" class="btn btn-primary btn-block btn-flat">Masuk</button>
            </form>
        </div> <!-- End login-box-body -->
    </div> <!-- End login-box -->

    <script src="<?php echo base_url('assets/AdminLTE-2.4.8/bower_components/jquery/dist/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/AdminLTE-2.4.8/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/AdminLTE-2.4.8/dist/js/adminlte.min.js');?>"></script>

    <script>
        function prosesLogin() {
            var username = $('input[name="username"]').val().trim();
            var password = $('input[name="password"]').val().trim();

            if(username != '' && password != '') {
                $.ajax({
                    type    : 'post',
                    url     : '<?=base_url('member/loginProcess');?>',
                    dataType: 'json',
                    data    : {
                        username : username,
                        password : password
                    },
                    success : function(response) {
                        if(response == 'no match') {
                            $('.help-block').remove();
                            $('form').append('<span class="help-block" style="color:#a94442">Username atau password Anda salah!</span>');
                            $('#username').addClass('has-error');
                            $('#password').addClass('has-error');
                            $('input[name="username"]').focus();
                            $('#btnLogin').html('Masuk');
                            $('#btnLogin').removeClass('disabled');
                        }
                        else if(response == 'found a match') {
                            window.location = '<?=base_url('dashboard');?>';
                        }
                    },
                    error : function(response) {
                        console.log(response.responseText);
                    }
                });
            }
        }

        $(document).ready(function() {
            $('input[name="username"]').keypress(function(event) {
                $('#username').removeClass('has-error');
                if(event.keyCode === 13) {
                    event.preventDefault();
                    $('input[name="password"]').focus();
                }
            });

            $('input[name="password"]').keypress(function(event) {
                $('#password').removeClass('has-error');
            });
            
            $('form').submit(function(event) {
                event.preventDefault();
                $('#btnLogin').html('<i class="fa fa-refresh fa-spin"></i>');
                $('#btnLogin').addClass('disabled');
                prosesLogin();
            });
        });
    </script>
</body>
</html>