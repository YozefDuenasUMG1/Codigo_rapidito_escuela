<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="container-form">
            <form method="POST" action="{{ route('login') }}" id="loginForm" aria-label="Formulario de inicio de sesión">
                @csrf
                <h2>Inicio de sesión</h2>
                <div class="social-networks">
                    <ion-icon name="logo-facebook"></ion-icon>
                    <ion-icon name="logo-github"></ion-icon>
                    <ion-icon name="logo-microsoft"></ion-icon>
                    <ion-icon name="logo-google"></ion-icon>
                </div>
                <span>Use su correo y su contraseña</span>
                <div class="container-input" style="position:relative;">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-required="true" aria-describedby="emailHelp" placeholder="Correo electrónico" style="border:none; background:#f2f7fd; padding-left:2.2rem;">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="container-input" style="position:relative;">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" placeholder="Contraseña" required id="login-password">
                    <button type="button" class="toggle-password" data-target="login-password" style="background:none; border:none; position:absolute; right:10px; top:8px; cursor:pointer;">
                        <ion-icon name="eye-outline"></ion-icon>
                    </button>
                </div>
                @error('password')
                    <div class="error" style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Recuérdame
                    </label>
                </div>
                <button type="submit" class="button w-100" id="loginBtn" aria-busy="false">
                    <span id="loginBtnText">Iniciar sesión</span>
                    <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </form>
        </div>
        <div class="container-form">
            <form class="sign-up" method="POST" action="{{ route('register') }}">
                @csrf
                <h2>Registrarse</h2>
                <div class="social-networks">
                    <ion-icon name="logo-facebook"></ion-icon>
                    <ion-icon name="logo-github"></ion-icon>
                    <ion-icon name="logo-microsoft"></ion-icon>
                    <ion-icon name="logo-google"></ion-icon>
                </div>
                <span>Use su correo para registrarse</span>
                <div class="container-input">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" name="name" placeholder="Nombre de usuario" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <div class="error" style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
                <div class="container-input">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="error" style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
                <div class="container-input" style="position:relative;">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" placeholder="Contraseña" required id="register-password">
                    <button type="button" class="toggle-password" data-target="register-password" style="background:none; border:none; position:absolute; right:10px; top:8px; cursor:pointer;">
                        <ion-icon name="eye-outline"></ion-icon>
                    </button>
                </div>
                @error('password')
                    <div class="error" style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
                <div class="container-input" style="position:relative;">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required id="register-password-confirmation">
                    <button type="button" class="toggle-password" data-target="register-password-confirmation" style="background:none; border:none; position:absolute; right:10px; top:8px; cursor:pointer;">
                        <ion-icon name="eye-outline"></ion-icon>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="error" style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
                <div class="container-input">
                    <ion-icon name="people-outline"></ion-icon>
                    <select name="role" required>
                        <option value="alumno" {{ old('role') == 'alumno' ? 'selected' : '' }}>Alumno</option>
                        <option value="profesor" {{ old('role') == 'profesor' ? 'selected' : '' }}>Profesor</option>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            @endif
                        @endauth
                    </select>
                </div>
                @error('role')
                    <div class="error" style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
                <button class="button" type="submit">REGISTRARSE</button>
            </form>
        </div>
        <div class="container-welcome">
            <div class="welcome-sign-up welcome">
                <h3>¡Bienvenido!</h3>
                <p>Ingrese sus datos para ingresar a la Academia Código Rapidito</p>
                <button class="button" id="btn-sign-up">Registrarse</button>
            </div>
            <div class="welcome-sign-in welcome">
                <h3>¡Hola!</h3>
                <p>Regístrese con sus datos para ingresar a la Academia Código Rapidito</P>
                <button class="button" id="btn-sign-in">Iniciar sesión</button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/loginjs.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const target = document.getElementById(this.getAttribute('data-target'));
                if (target.type === 'password') {
                    target.type = 'text';
                    this.querySelector('ion-icon').setAttribute('name', 'eye-off-outline');
                } else {
                    target.type = 'password';
                    this.querySelector('ion-icon').setAttribute('name', 'eye-outline');
                }
            });
        });
        document.getElementById('loginForm').addEventListener('submit', function() {
            var btn = document.getElementById('loginBtn');
            var spinner = document.getElementById('spinner');
            var btnText = document.getElementById('loginBtnText');
            btn.setAttribute('aria-busy', 'true');
            btn.disabled = true;
            spinner.classList.remove('d-none');
            btnText.textContent = 'Ingresando...';
        });
    </script>
    <style>
        /* Accesibilidad: alto contraste para errores */
        .invalid-feedback { color: #d32f2f; font-size: 0.95em; }
        .form-label { font-weight: 600; }
        /* Spinner centrado en el botón */
        #spinner { margin-left: 8px; }
        /* Estilo personalizado para input de correo */
        #email.form-control {
            border: 2px solid #3AB397;
            border-radius: 8px;
            box-shadow: 0 1px 6px rgba(58,179,151,0.07);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        #email.form-control:focus {
            border-color: #2D8C8C;
            box-shadow: 0 2px 12px rgba(58,179,151,0.18);
            outline: none;
        }
        /* Estilo personalizado para el botón de iniciar sesión */
        #loginBtn.btn-primary {
            background: linear-gradient(90deg, #3AB397 0%, #2D8C8C 100%);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px 0 rgba(58,179,151,0.10);
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
        }
        #loginBtn.btn-primary:hover {
            background: linear-gradient(90deg, #2D8C8C 0%, #3AB397 100%);
            box-shadow: 0 4px 16px 0 rgba(58,179,151,0.18);
            transform: translateY(-2px) scale(1.03);
        }
        .container-input {
            display: flex;
            align-items: center;
            background: #f2f7fd;
            border-radius: 8px;
            padding: 0.2rem 0.7rem;
            margin-bottom: 1.1rem;
        }
        .container-input ion-icon {
            font-size: 1.2rem;
            color: #888;
            margin-right: 0.5rem;
        }
        .container-input input[type="email"] {
            background: transparent;
            border: none;
            outline: none;
            flex: 1;
            font-size: 1rem;
            color: #222;
            padding: 0.7rem 0;
        }
        .container-input input[type="email"]:focus {
            background: #eaf2fb;
        }
        .button, #loginBtn.button {
            background: linear-gradient(90deg, #3AB397 0%, #2D8C8C 100%);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #fff;
            padding: 0.7rem 0;
            box-shadow: 0 2px 8px 0 rgba(58,179,151,0.10);
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
        }
        .button:hover, #loginBtn.button:hover {
            background: linear-gradient(90deg, #2D8C8C 0%, #3AB397 100%);
            box-shadow: 0 4px 16px 0 rgba(58,179,151,0.18);
            transform: translateY(-2px) scale(1.03);
        }
    </style>
    @if (session('status'))
        @php echo "<script>document.addEventListener('DOMContentLoaded', function() {Swal.fire({icon: 'success',title: '¡Listo!',text: ".json_encode(session('status')).",confirmButtonColor: '#3AB397',timer: 2500,timerProgressBar: true,showConfirmButton: false});});</script>"; @endphp
    @endif
</body>
</html>
