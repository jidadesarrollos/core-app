class Formulario extends React.Component {

    constructor(props) {

        super(props);

        this.state = {
            'actividad': '',
            'descripcion': '',
            'userId': '',
            'priorityId': '',
            'incompleto': true
        };

        this.activityValue = this.activityValue.bind(this);
        this.descriptionValue = this.descriptionValue.bind(this);
        this.listenUser = this.listenUser.bind(this);
        this.listenPriority = this.listenPriority.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);

    }

    activityValue(event) {
        const target = event.currentTarget;
        this.setState({'actividad': target.value});
    }

    descriptionValue(event) {
        const target = event.currentTarget;
        this.setState({'descripcion': target.value});
    }

    listenUser(userId) {
        this.setState({'userId': userId});
    }

    listenPriority(priorityId) {
        this.setState({'priorityId': priorityId});
    }

    async handleSubmit(event) {

        try {

            event.preventDefault();

            let {actividad, userId, priorityId, descripcion} = this.state;
            let url = '/jadmin/actividades/procesar';
            let data = {
                'id_usuario': userId,
                'actividad': actividad,
                'descripcion': descripcion,
                'id_prioridad': priorityId
            };

            let response = await fetch(url, {
                method: 'post',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });

            return response.json();

        }
        catch (e) {
            console.error(e);
        }

    }

    render() {

        let {users, prioridades} = this.props;
        let {actividad, userId, descripcion} = this.state;
        let properties = {};

        if (!actividad || !userId) {
            properties.disabled = true;
        }

        return (
            <form onSubmit={this.handleSubmit}>
                <div className="form-row">
                    <div className="col-md-12">
                        <input
                            type="text"
                            className="form-control mb-3"
                            value={actividad}
                            placeholder="Escriba el nombre de la actividad(*)"
                            onChange={this.activityValue}
                            required/>
                    </div>
                </div>
                <div className="form-row">
                    <Usuarios
                        users={users}
                        listenUser={this.listenUser}
                    />
                    <Prioridades
                        prioridades={prioridades}
                        listenPriority={this.listenPriority}
                    />
                </div>
                <div className="form-row">
                    <div className="col-md-12">
                        <textarea
                            className="form-control mb-3"
                            placeholder="Descripción"
                            onChange={this.descriptionValue}
                            value={descripcion}/>
                    </div>
                </div>
                <button
                    className="btn btn-primary"
                    {...properties}
                    type="submit">
                    Guardar Actividad
                </button>
            </form>
        )

    }

}
