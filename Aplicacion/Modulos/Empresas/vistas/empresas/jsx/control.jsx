class Control extends React.Component {

    constructor(props) {
        super(props);
    }

    render() {
        let {usuarios, prioridades} = this.props;
        return (
            <div>
                <h2 className="mb-3">Asignar Actividad</h2>
                <Formulario users={usuarios} prioridades={prioridades}/>
            </div>
        );
    }

}

