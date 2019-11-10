class App extends React.Component {

    constructor() {
        super();
        this.state = {'showMore': 0};
        this.click = this.click.bind(this);
        this.remover = this.remover.bind(this);
    }

    click() {
        this.setState({'showMore': this.state.showMore + 1});
    }

    remover() {
        this.setState({'showMore': this.state.showMore - 1});
    }

    render() {

        let output = [];

        const {users} = this.props;

        users.map(user => output.push(<User user={user} key={user.id}/>));

        return (
            <div>
                <Second/>
                <hr/>
                <button
                    onClick={this.click}
                    className="btn primary">Cargar mas
                </button>
                <button
                    onClick={this.remover}
                    className="btn primary">Remover
                </button>
                {output}
            </div>
        );
    }
}





