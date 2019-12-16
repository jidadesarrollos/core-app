class ListaUsuarios extends React.Component {

    constructor(props) {
        super(props);
        this.state = {};
        this.selectUser = this.selectUser.bind(this);
    }

    selectUser(event) {

        const target = event.currentTarget;
        let {id, name} = target.dataset;

        this.setState({'selected': id, 'name': name});
        this.props.bindUser(id, name);

    }

    render() {

        let output = [];
        let {selected} = this.state;
        let {searched, users} = this.props;

        users.forEach(user => {

            const name = `${user.nombres} ${user.apellidos}`;

            if (!name.toLowerCase().includes(searched.toLowerCase())) {
                return;
            }

            const cls = user.id_usuario === selected ? 'list-group-item active' : 'list-group-item';

            output.push(
                <li key={user.id_usuario}
                    data-id={user.id_usuario}
                    data-name={name}
                    className={cls}
                    onClick={this.selectUser}>
                    {name}
                </li>
            );

        });

        return (
            <ul className="list-group">
                {output}
            </ul>
        );

    }

}