<!-- view login email dan password and link auth sso -->

<form action="{{ route('auth.index') }}" method="post">
    @csrf
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
    <!-- link auth sso -->
    <a href="{{ route('auth.index') }}">Login with SSO</a>
</form>