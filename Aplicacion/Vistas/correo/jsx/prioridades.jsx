class Prioridades extends React.Component {

    constructor(props) {
        super(props);
        this.priorityValue = this.priorityValue.bind(this);
    }

    priorityValue(event) {
        const target = event.currentTarget;
        this.props.listenPriority(target.value);
    }

    render() {

        let {prioridades} = this.props;

        return (
            <div className="col-md-6">
                <select className="form-control mb-3"
                        onChange={this.priorityValue}>
                    <option>- Seleccione una Prioridad -</option>
                    {
                        prioridades.map(key =>
                            <option key={key.id_prioridad}
                                    value={key.id_prioridad}>
                                {key.prioridad}
                            </option>
                        )
                    }
                </select>
            </div>
        );

    }

}