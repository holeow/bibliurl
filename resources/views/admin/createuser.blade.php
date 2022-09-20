
<form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus />
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required />
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required />
        </div>

        <div>
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required />
        </div>

        <a href="{{ route('login') }}">Déjà enregistré ?</a>

        <div>
            <button type="submit">Enregistrer</button>
        </div>
    </form>