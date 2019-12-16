class ListaActividades extends React.Component {

    constructor(props) {

        super(props);

        this.state = {};

        this.listenActivity = this.listenActivity.bind(this);

    }

    listenActivity(event) {
        const target = event.currentTarget;
        const key = target.dataset.id;
        const {actividades} = this.props;
        this.props.setActividad(actividades[key]);
    }

    render() {

        let output = [];
        let {actividades} = this.props;

        actividades.forEach((actividad, key) => {

            const name = `${actividad.nombres} ${actividad.apellidos}`;

            output.push(
                <li key={actividad.id_actividad}
                    className="list-group-item">
                    <p className="m-0 d-flex align-items-center">
                        <span>{name}</span>
                        <span className="badge badge-pill badge-primary ml-1 mr-1">
                            {!!actividad.centro_costo && actividad.centro_costo}
                        </span>
                        <span className="flex-grow-1"></span>
                        <span className="text-small text-muted ml-auto">Fecha: {actividad.fecha_inicio}</span>
                    </p>
                    <h5 className="text-primary mt-3 mb-0">{actividad.actividad}</h5>
                    <p className="text-small text-muted">{actividad.descripcion}</p>
                    <button className="btn btn-primary"
                            data-id={key}
                            onClick={this.listenActivity}>
                        Ver detalle
                    </button>
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