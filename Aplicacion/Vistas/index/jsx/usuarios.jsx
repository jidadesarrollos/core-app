class Usuarios extends React.Component {

    constructor(props) {

        super(props);

        this.state = {'searched': '', 'user': {}};
        this.handleValue = this.handleValue.bind(this);
        this.setUser = this.setUser.bind(this);
        this.clean = this.clean.bind(this);

    }

    handleValue(event) {
        const target = event.currentTarget;
        this.setState({'searched': target.value});
    }

    setUser(id, name) {
        this.setState({
            'user': {'id': id, 'name': name}
        });
        this.props.listenUser(id);
    }

    clean() {
        this.setState({'user': {}});
        this.props.listenUser(undefined);
    }

    render() {

        let {users} = this.props;
        let {id, name} = this.state.user;

        if (id) {
            return (
                <div className="col-md-6">
                    <div className="input-group mb-3">
                        <input
                            type="text"
                            className="form-control"
                            value={name}
                            readOnly/>
                        <div className="input-group-append">
                            <button
                                className="btn btn-secondary"
                                onClick={this.clean}>&times;</button>
                        </div>
                    </div>
                </div>
            );
        }

        return (
            <div className="col-md-6">
                <input
                    type="text"
                    className="form-control mb-3"
                    placeholder="Responsable(*)"
                    value={this.state.searched}
                    onChange={this.handleValue}
                    required/>
                {
                    !!this.state.searched &&
                    <ListaUsuarios
                        searched={this.state.searched}
                        users={users}
                        bindUser={this.setUser}
                    />
                }
            </div>
        );

    }

}