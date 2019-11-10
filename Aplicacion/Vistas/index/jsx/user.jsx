function User({user}) {
    return (
        <section>
            <h3>{user.usuario}</h3>
            <h4>Ultima sesión: {user.ultima_sesion}</h4>
        </section>
    )
}