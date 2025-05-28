<x-guest-layout>
    <div class="mb-4 text-sm" style="color:#2D8C8C; font-weight:600;">
        ¿Olvidaste tu contraseña? <br>
        <span style="color:#444; font-weight:400;">No te preocupes, ingresa tu correo y te enviaremos un enlace para restablecerla.</span>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" style="max-width:400px; margin:auto;">
        @csrf
        <div class="container-input" style="position:relative; margin-bottom:1.2rem; background:#f2f7fd; border-radius:8px; display:flex; align-items:center; padding:0.2rem 0.7rem;">
            <ion-icon name="mail-outline" style="font-size:1.2rem; color:#888; margin-right:0.5rem;"></ion-icon>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electrónico" style="background:transparent; border:none; outline:none; flex:1; font-size:1rem; color:#222; padding:0.7rem 0;">
        </div>
        @error('email')
            <div style="color:#d32f2f; font-size:0.95em; margin-bottom:0.8rem;">{{ $message }}</div>
        @enderror
        <button type="submit" class="button w-100" style="width:100%; background:linear-gradient(90deg,#3AB397 0%,#2D8C8C 100%); border:none; border-radius:8px; font-weight:600; letter-spacing:0.5px; color:#fff; padding:0.7rem 0; box-shadow:0 2px 8px 0 rgba(58,179,151,0.10); transition:background 0.2s, box-shadow 0.2s, transform 0.1s;">
            Enviar enlace de recuperación
        </button>
    </form>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</x-guest-layout>
