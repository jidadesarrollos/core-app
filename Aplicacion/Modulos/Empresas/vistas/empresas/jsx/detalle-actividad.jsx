class DetalleActividad extends React.Component {

    constructor(props) {

        super(props);

        this.state = {
            'fecha_inicio': !props.actividad.fecha_inicio ? '' : props.actividad.fecha_inicio,
            'fecha_entrega': !props.actividad.fecha_entrega ? '' : props.actividad.fecha_entrega,
            'id_estatus': !props.actividad.id_estatus ? '' : props.actividad.id_estatus,
            'comentario': ''
        };

        this.listenStartDate = this.listenStartDate.bind(this);
        this.listenEndDate = this.listenEndDate.bind(this);
        this.listenStatus = this.listenStatus.bind(this);
        this.listenComment = this.listenComment.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);

    }

    listenStartDate(event) {
        const target = event.currentTarget;
        this.setState({'fecha_inicio': target.value});
    }

    listenEndDate(event) {
        const target = event.currentTarget;
        this.setState({'fecha_entrega': target.value});
    }

    listenStatus(statusId) {
        this.setState({'id_estatus': statusId});
    }

    listenComment(event) {
        const target = event.currentTarget;
        this.setState({'comentario': target.value});
    }

    async handleSubmit(event) {

        try {

            event.preventDefault();

            const {fecha_inicio, fecha_entrega, id_estatus, comentario} = this.state;
            const target = event.currentTarget;
            const id = target.dataset.id;
            const url = '/jadmin/actividades/actualizar';
            const data = {
                'id_actividad': id,
                'fecha_inicio': fecha_inicio,
                'fecha_entrega': fecha_entrega,
                'id_estatus': id_estatus,
                'comentario': comentario
            };

            const response = await fetch(url, {
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

        let {actividad, statusActividades} = this.props;

        console.log(1, this.state, actividad);

        let statusClass = 'badge mb-2 p-2 ';

        switch (actividad.id_prioridad) {
            case '1':
                statusClass += 'badge-info';
                break;
            case '2':
                statusClass += 'badge-success';
                break;
            case '3':
                statusClass += 'badge-warning';
                break;
            case '4':
                statusClass += 'badge-danger';
                break;
            default:
                statusClass += 'badge-primary';
        }

        return (
            <div className="card">
                <div className="card-body">
                    <span className={statusClass}>{actividad.prioridad}</span>
                    <h3 className="mb-3">{actividad.actividad}</h3>
                    <p>{actividad.descripcion}</p>
                    <hr className="my-2"/>
                    <div className="row">
                        <div className="col-md-6">
                            <label className="text-primary">Fecha de Inicio:</label>
                            <input type="date"
                                   className="form-control mb-3"
                                   value={this.state.fecha_inicio}
                                   onChange={this.listenStartDate}/>
                        </div>
                        <div className="col-md-6">
                            <label className="text-primary">Fecha de Entrega:</label>
                            <input type="date"
                                   className="form-control mb-3"
                                   value={this.state.fecha_entrega}
                                   onChange={this.listenEndDate}/>
                        </div>
                        <StatusActividades
                            statusList={statusActividades}
                            statusSelected={this.state.id_estatus}
                            listenStatus={this.listenStatus}/>
                    </div>
                    <hr className="my-2"/>
                    <label className="text-primary">Escriba un comentario:</label>
                    <textarea className="form-control mb-3"
                              onChange={this.listenComment}>
                    </textarea>
                    <button className="btn btn-primary"
                            data-id={actividad.id_actividad}
                            onClick={this.handleSubmit}>
                        Actualizar
                    </button>
                </div>
            </div>
        );

    }

}