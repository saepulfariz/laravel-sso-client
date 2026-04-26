<!-- view login email dan password and link auth sso -->
<h1>SSO Client</h1>
<form action="{{ route('auth.index') }}" method="post">
    @csrf
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
    <!-- link auth sso -->
    <br>
    <br>
    <a href="{{ route('auth.index') }}">Login with SSO</a>

    <br>
    <br>
    <a href="{{ route('login.sso') }}">
        <button type="button">Login with SSO Test</button>
    </a>
</form>