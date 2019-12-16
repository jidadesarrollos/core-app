class StatusActividades extends React.Component {

    constructor(props) {
        super(props);
        this.statusValue = this.statusValue.bind(this);
    }

    statusValue(event) {
        const target = event.currentTarget;
        this.props.listenStatus(target.value);
    }

    render() {

        let {statusList, statusSelected} = this.props;

        return (
            <div className="col-md-6">
                <label className="text-primary">Avance:</label>
                <select className="form-control mb-3"
                        value={statusSelected}
                        onChange={this.statusValue}>
                    {
                        statusList.map(status =>
                            <option key={status.id_estatus_actividad}
                                    value={status.id_estatus_actividad}>
                                {status.descripcion}
                            </option>
                        )
                    }
                </select>
            </div>
        );

    }

}