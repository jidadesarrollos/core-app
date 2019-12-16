class Bandeja extends React.Component {

    constructor(props) {

        super(props);

        const activities = new Activities();
        activities.registerBinder(this.setState.bind(this));
        this.setActividad = this.setActividad.bind(this);

        this.state = {};

    }

    setActividad(objActividad) {
        this.setState({'actividad': objActividad});
    }

    render() {

        let {statusActividades} = this.props;
        let {ready, actividades, actividad} = this.state;

        if (!ready) return null;

        return (
            <div className="row">
                <div className="col-md-6">
                    <div className="card">
                        <div className="card-body">
                            <h2 className="mb-3">Bandeja de Actividades</h2>
                            <ListaActividades
                                actividades={actividades}
                                setActividad={this.setActividad}
                            />
                        </div>
                    </div>
                </div>
                <div className="col-md-6">
                    {
                        !!actividad &&
                        <DetalleActividad
                            actividad={actividad}
                            statusActividades={statusActividades}
                        />
                    }
                </div>
            </div>
        );

    }

}
